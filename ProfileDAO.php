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
        public static function validate($profile){
            $errors = array();
            
            if($profile->nickname === ''){
                $errors[] = 'ニックネームを入力してください';
            }
            if (empty($_FILES['avatar']['name'])) {
                $errors[] = 'アバター画像を選択してください';     
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
            if($profile->introduction === '0'){
                $errors[] = '自己紹介文を入力してください';
            }

            return $errors;
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
        
        public static function get_all_partners($my_gender){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $stmt = $pdo->prepare('SELECT * FROM profiles JOIN users ON profiles.user_id = users.id WHERE users.gender != :gender ORDER BY users.created_at DESC');
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
    
    }
    