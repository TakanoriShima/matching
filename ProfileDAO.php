<?php
    require_once 'config.php';
    require_once 'User.php';
    require_once 'Profile.php';
    
    class ProfileDAO{
        // データベースと接続
        private static function get_connection(){
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 失敗したら例外を投げる
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,   //デフォルトのフェッチモードはクラス
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   //MySQL サーバーへの接続時に実行するコマンド
              );
            $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $options);
            return $pdo;
        }
        
        // データベースとの切断
        private static function close_connection($pdo, $stmt){
            $pdo = null;
            $stmt = null;
        }
        
        // profilesテーブルに新規にデータを追加
        public static function insert($profile){
            $avatar = "";
            try{
                try{
                    $avatar = self::upload();
                }catch(Exception $e){
                    
                }
                // データベースに接続
                $pdo = self::get_connection();
                // INSERT文準備
                $stmt = $pdo->prepare('INSERT INTO profiles(user_id, nickname, avatar, prefecture, height, weight, profession, income, drink, smoking, my_type, favorite_type, introduction) VALUES(:user_id, :nickname, :avatar, :prefecture, :height, :weight, :profession, :income, :drink, :smoking, :my_type, :favorite_type, :introduction)');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':user_id', $profile->user_id, PDO::PARAM_INT);
                $stmt->bindParam(':nickname', $profile->nickname, PDO::PARAM_STR);
                $stmt->bindParam(':avatar', $avatar, PDO::PARAM_STR);
                $stmt->bindParam(':prefecture', $profile->prefecture, PDO::PARAM_STR);
                $stmt->bindParam(':height', $profile->height, PDO::PARAM_INT);
                $stmt->bindParam(':weight', $profile->weight, PDO::PARAM_INT);
                $stmt->bindParam(':profession', $profile->profession, PDO::PARAM_STR);
                $stmt->bindParam(':income', $profile->income, PDO::PARAM_STR);
                $stmt->bindParam(':drink', $profile->drink, PDO::PARAM_STR);
                $stmt->bindParam(':smoking', $profile->smoking, PDO::PARAM_STR);
                $stmt->bindParam(':my_type', $profile->my_type, PDO::PARAM_STR);
                $stmt->bindParam(':favorite_type', $profile->favorite_type, PDO::PARAM_STR);
                $stmt->bindParam(':introduction', $profile->introduction, PDO::PARAM_STR);
                
                // INSERT本番実行
                $stmt->execute();
                    
            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // 入力チェック
        public static function validate($profile, $image_check_flag){
            $errors = array();
            
            if($profile->nickname === ''){
                $errors[] = 'ニックネームを入力してください';
            }
            
            if($image_check_flag === 1){
                if (empty($_FILES['avatar']['name'])) {
                    $errors[] = 'アバター画像を選択してください';     
                }
            }
            
            if($profile->prefecture === '0'){
                $errors[] = '都道府県を選択してください';
            }
            if($profile->height === '0'){
                $errors[] = '身長を選択してください';
            }
            if($profile->weight === '0'){
                $errors[] = '体重を選択してください';
            }
            if($profile->profession === '0'){
                $errors[] = '職業を選択してください';
            }
            if($profile->income === '0'){
                $errors[] = '年収を選択してください';
            }
            if($profile->my_type === '0'){
                $errors[] = '私のタイプを選択してください';
            }
            if($profile->favorite_type === '0'){
                $errors[] = '相手の希望を選択してください';
            }
            if($profile->introduction === ''){
                $errors[] = '自己紹介文を入力してください';
            }

            return $errors;
        }
        
        // profilesテーブル情報を更新
        public static function update($profile){
            $avatar = "";
            try{
                try{
                    $avatar = self::upload();
                }catch(Exception $e){
                    
                }
                // データベースに接続
                $pdo = self::get_connection();
                
                // INSERT文準備
                $sql = 'UPDATE profiles SET nickname=:nickname, prefecture=:prefecture, height=:height, weight=:weight, profession=:profession, income=:income, drink=:drink, smoking=:smoking, my_type=:my_type, favorite_type=:favorite_type, introduction=:introduction ';
                // 画像を更新するのであれば
                if($avatar !== null){
                    $sql .= ', avatar=:avatar ';
                }
                $sql .= 'WHERE user_id=:user_id';
                // print $sql;
                
                $stmt = $pdo->prepare($sql);
                // // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':user_id', $profile->user_id, PDO::PARAM_INT);
                $stmt->bindParam(':nickname', $profile->nickname, PDO::PARAM_STR);
                if($avatar !== null){
                    $stmt->bindParam(':avatar', $avatar, PDO::PARAM_STR);
                }
                $stmt->bindParam(':prefecture', $profile->prefecture, PDO::PARAM_STR);
                $stmt->bindParam(':height', $profile->height, PDO::PARAM_INT);
                $stmt->bindParam(':weight', $profile->weight, PDO::PARAM_INT);
                $stmt->bindParam(':profession', $profile->profession, PDO::PARAM_STR);
                $stmt->bindParam(':income', $profile->income, PDO::PARAM_STR);
                $stmt->bindParam(':drink', $profile->drink, PDO::PARAM_STR);
                $stmt->bindParam(':smoking', $profile->smoking, PDO::PARAM_STR);
                $stmt->bindParam(':my_type', $profile->my_type, PDO::PARAM_STR);
                $stmt->bindParam(':favorite_type', $profile->favorite_type, PDO::PARAM_STR);
                $stmt->bindParam(':introduction', $profile->introduction, PDO::PARAM_STR);
                
                // UPDATE本番実行
                $stmt->execute();
                    
            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        
        // ファイルをアップロード
        public static function upload(){
            // ファイルを選択していれば
            if (!empty($_FILES['avatar']['name'])) {
                // ファイル名をユニーク化
                $avatar_name = uniqid(mt_rand(), true); 
                // アップロードされたファイルの拡張子を取得
                $avatar_name .= '.' . substr(strrchr($_FILES['avatar']['name'], '.'), 1);
    
                $file = AVATAR_IMG_DIR . $avatar_name;
    
                // uploadディレクトリにファイル保存
                move_uploaded_file($_FILES['avatar']['tmp_name'], $file);
                
                return $avatar_name;
                
            }else{
                return null;
            }
        }
        
        // 会員番号からプロフィール情報を取得
        public static function get_profile_by_id($user_id){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $stmt = $pdo->prepare('SELECT * FROM profiles WHERE user_id=:user_id');
                // バインド処理
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Profileクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Profile', array("", "", "", "", "", "", "", "", "", "", "", "", ""));
                // プロフィールを取得
                $profile = $stmt->fetch();

            }catch(PDOException $e){
                $profile =  null;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // プロフィールデータを返す
            return $profile;  
        }
        
        // 異性の全会員のプロフィールを取得
        public static function get_all_partners($my_gender){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $stmt = $pdo->prepare('SELECT * FROM profiles INNER JOIN users ON profiles.user_id = users.id WHERE users.gender != :gender ORDER BY users.created_at DESC');
                // バインド処理
                $stmt->bindParam(':gender', $my_gender, PDO::PARAM_STR);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Profileクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Profile', array("", "", "", "", "", "", "", "", "", "", "", "", ""));
                // プロフィールを取得
                $partners = $stmt->fetchAll();

            }catch(PDOException $e){
                $partners = null;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // プロフィールデータを返す
            return $partners;  
        }
        
        // ログイン中の異性の全会員情報を取得
        public static function get_login_partners($my_gender){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $stmt = $pdo->prepare('SELECT * FROM profiles JOIN users ON profiles.user_id = users.id WHERE users.gender != :gender AND users.login_flag=1 ORDER BY users.created_at DESC');
                // バインド処理
                $stmt->bindParam(':gender', $my_gender, PDO::PARAM_STR);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Profileクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Profile', array("", "", "", "", "", "", "", "", "", "", "", "", ""));
                // プロフィールを取得
                $partners = $stmt->fetchAll();

            }catch(PDOException $e){
                $partners = null;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // プロフィールデータを返す
            return $partners;  
        }
        
        // 異性のプロフィール検索
        public static function search_profiles($conditions, $my_gender){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $sql = "SELECT * FROM profiles INNER JOIN users ON profiles.user_id = users.id WHERE users.gender != '{$my_gender}'";
                
                // 年齢下限
                if($conditions['age_lower'] !== '0'){
                    $sql .= " AND {$conditions['age_lower']} <= users.age";
                }
                // 年齢上限
                if($conditions['age_upper'] !== '0'){
                    $sql .= " AND users.age <= {$conditions['age_upper']}";
                }
                
                // 都道府県
                if($conditions['prefecture'] !== '0'){
                    $sql .= " AND profiles.prefecture = '{$conditions['prefecture']}'";
                }
                
                // 身長下限
                if($conditions['height_lower'] !== '0'){
                    $sql .= " AND {$conditions['height_lower']} <= profiles.height";
                }
                // 身長上限
                if($conditions['height_upper'] !== '0'){
                    $sql .= " AND profiles.height <= {$conditions['height_upper']}";
                }
                
                // 体重下限
                if($conditions['weight_lower'] !== '0'){
                    $sql .= " AND {$conditions['weight_lower']} <= profiles.weight";
                }
                // 体重上限
                if($conditions['weight_upper'] !== '0'){
                    $sql .= " AND profiles.weight <= {$conditions['weight_upper']}";
                }
                
                // 職業
                if($conditions['profession'] !== '0'){
                    $sql .= " AND profiles.profession = '{$conditions['profession']}'";
                }
                
                // 収入
                if($conditions['income'] !== '0'){
                    $sql .= " AND profiles.income = '{$conditions['income']}'";
                }
                
                // 飲酒
                if($conditions['drink'] !== '0'){
                    $sql .= " AND profiles.drink = '{$conditions['drink']}'";
                }
                
                // 喫煙
                if($conditions['smoking'] !== '0'){
                    $sql .= " AND profiles.smoking = '{$conditions['smoking']}'";
                }
                
                // 希望のタイプ
                if($conditions['favorite_type'] !== '0'){
                    $sql .= " AND profiles.favorite_type = '{$conditions['favorite_type']}'";
                }
                
                // フリーキーワード
                if($conditions['keyword'] !== '0'){
                    $sql .= " AND profiles.introduction LIKE '%{$conditions['keyword']}%'";
                }
                
                $sql .= " ORDER BY users.created_at DESC";
                // print $sql;
                
                // SELECT文実行
                $stmt = $pdo->query($sql);
                
                // フェッチの結果を、Profileクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Profile', array("", "", "", "", "", "", "", "", "", "", "", "", ""));
                // プロフィールを取得
                $partners = $stmt->fetchAll();

            }catch(PDOException $e){
                $partners = null;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // プロフィールデータを返す
            return $partners;  
        }
    
    }
    