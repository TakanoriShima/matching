<?php
    require_once 'config.php';
    require_once 'User.php';
    require_once 'ProfileDAO.php';
    
    // DAO
    class UserDAO{
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
        
        // 全会員情報を取得
        public static function get_all_users(){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行
                $stmt = $pdo->query('SELECT * FROM users');
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User', array("", "", "", ""));
                // 会員一覧を取得
                $users = $stmt->fetchAll();

            }catch(PDOException $e){
                $users =  null;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // 全会員データを返す
            return $users;  
        }
        
        // 会員番号から会員情報を取得
        public static function get_user_by_id($id){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $stmt = $pdo->prepare('SELECT * FROM users WHERE id=:id');
                // バインド処理
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User', array("", "", "", ""));
                // 会員を取得
                $user = $stmt->fetch();

            }catch(PDOException $e){
                $users =  null;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // 会員データを返す
            return $user;  
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
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Profile', array("", "", "", "", "", "", "", "", "", "", "", "", "", "", ""));
                // プロフィール情報を取得
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
        
        // usersテーブルに新規にデータを追加
        public static function sign_up($user){
            
            try{
                // データベースに接続
                $pdo = self::get_connection();
                // INSERT文準備
                $stmt = $pdo->prepare('INSERT INTO users(gender, age, email, password_digest) VALUES(:gender, :age, :email, :password_digest)');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':gender', $user->gender, PDO::PARAM_STR);
                $stmt->bindParam(':age', $user->age, PDO::PARAM_INT);
                $stmt->bindParam(':email', $user->email, PDO::PARAM_STR);
                $stmt->bindParam(':password_digest', $user->password_digest, PDO::PARAM_STR);
                // INSERT本番実行
                $stmt->execute();
                
            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // 会員登録入力チェック
        public static function check_new_user($age, $email, $password){
            $errors = array();
            
            if($age == 0){
                $errors[] = '年齢を選択してください';
            }
            if($email === ''){
                $errors[] = 'メールアドレスを入力してください';
            }else if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $email)){
                $errors[] = 'メールアドレスではありません';
            }else if(self::check_duplicate_email($email) === true){
                $errors[] = 'そのメールはすでに登録されています';
            }
            if(strlen($password) < 5){
                $errors[] = 'パスワードは5文字以上にしてください';
            }
            
            return $errors;
            
        }
        
        // ログイン入力チェック
        public static function check_login_input($email, $password){
            $errors = array();
            
            if($email === ''){
                $errors[] = 'メールアドレスを入力してください';
            }else if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $email)){
                $errors[] = 'メールアドレスではありません';
            }
            
            if(strlen($password) < 5){
                $errors[] = 'パスワードは5文字以上にしてください';
            }
            
            return $errors;
            
        }
        
        // メールアドレス重複チェック
        public static function check_duplicate_email($email){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行
                $stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User', array("", ""));
                
                // 会員を取得
                $user = $stmt->fetch();
                
                // 重複あり
                if($user){
                    return true;
                }else{ // 重複なし
                    return false;
                }

            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // ログイン処理
        public static function login($email, $password){
            
            try{
                // データベースに接続
                $pdo = self::get_connection();
                
                // SELECT文実行
                $stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User', array("", "", "", ""));
                
                // 会員を取得
                $user = $stmt->fetch();
                
                // 入力されたメールアドレスを持つ会員がいないのならば
                if(!$user){
                    return null;
                }else{ // 入力されたメールアドレスを持つ会員がいるのならば
                    // 入力されたパスワードとその会員のパスワードが一致するならば
                    if(password_verify($password, $user->password_digest)){
                        // 現在時刻の取得
                        date_default_timezone_set('Asia/Tokyo');
                        $now = date("Y-m-d H:i:s");
                        // UPDATE文実行準備（ログインフラグをONに）
                        $stmt = $pdo->prepare('UPDATE users SET last_login_at=:last_login_at, login_flag=1 WHERE id=:id');
                        // $stmt = $pdo->prepare('UPDATE users SET login_flag=1 WHERE id=:id');
                        // バインド処理（上のあやふやな部分は実はこれでした）
                        $stmt->bindValue(':last_login_at', $now, PDO::PARAM_STR);
                        $stmt->bindParam(':id', $user->id, PDO::PARAM_INT);
                        // SELECT文本番実行
                        $stmt->execute();
                        // 会員情報を返す
                        return $user;
                    }else{ // 一致しないのであれば
                        return null;
                    }
                }
                
            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // ログアウト（ログインフラッグをOFFにセット）
        public static function logout($user_id){
            
            try{
                // データベースに接続
                $pdo = self::get_connection();
                // UPDATE 文実行準備
                $stmt = $pdo->prepare('UPDATE users SET login_flag=0 WHERE id=:id');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
                // UPDATE文本番実行
                $stmt->execute();

            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        
    }