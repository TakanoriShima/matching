<?php
    require_once 'config.php';
    require_once 'Favorite.php';
    // DAO
    class FavoriteDAO{
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
 
        // いいね情報を保存するメソッド
        public static function insert($favorite){
            try{
                // データベースに接続
                $pdo = self::get_connection();
                // INSERT文準備
                $stmt = $pdo->prepare('INSERT INTO favorites(favorite_user_id, favorited_user_id) VALUES(:favorite_user_id, :favorited_user_id)');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':favorite_user_id', $favorite->favorite_user_id, PDO::PARAM_INT);
                $stmt->bindParam(':favorited_user_id', $favorite->favorited_user_id, PDO::PARAM_INT);
                // INSERT本番実行
                $stmt->execute();
                
            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // 指定された会員が指定された会員にいいねをしたか判定するメソッド
        public static function is_favorite($favorite_user_id, $favorited_user_id){
            try{
                // データベースに接続
                $pdo = self::get_connection();
                // INSERT文準備
                $stmt = $pdo->prepare('SELECT * FROM favorites WHERE favorite_user_id=:favorite_user_id AND favorited_user_id=:favorited_user_id');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':favorite_user_id', $favorite_user_id, PDO::PARAM_INT);
                $stmt->bindParam(':favorited_user_id', $favorited_user_id, PDO::PARAM_INT);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Favoriteクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Favorite');
                // favorite情報を取得
                $favorite = $stmt->fetch();
  
                // いいね情報がテーブルに存在していれば
                if($favorite !== false){
                    return true;
                }else{
                    return false;
                }
                
            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // 注目する会員にいいねした全情報を取得
        public static function get_my_all_favorited($user_id){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $stmt = $pdo->prepare('SELECT * FROM favorites WHERE favorited_user_id=:favorited_user_id ORDER BY created_at DESC');
                // バインド処理
                $stmt->bindParam(':favorited_user_id', $user_id, PDO::PARAM_INT);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Favorite');
                // 会員を取得
                $my_all_favorited = $stmt->fetchAll();
                
            }catch(PDOException $e){
                $my_all_favorited =  false;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // 注目する会員にいいねした全情報を返す
            return $my_all_favorited;  
        }
        
        // ログインした会員がいいねした全情報を取得
        public static function get_my_all_favorite($user_id){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $stmt = $pdo->prepare('SELECT * FROM favorites WHERE favorite_user_id=:favorite_user_id ORDER BY created_at DESC');
                // バインド処理
                $stmt->bindParam(':favorite_user_id', $user_id, PDO::PARAM_INT);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Favorite');
                // 会員を取得
                $my_all_favorite = $stmt->fetchAll();
                
            }catch(PDOException $e){
                $my_all_favorite =  false;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // 注目する会員がいいねした全情報を返す
            return $my_all_favorite;  
        }
        
        // 指定された会員が指定された相手をいいねから外す
        public static function delete($favorite_user_id, $favorited_user_id){
            try{
                // データベースに接続
                $pdo = self::get_connection();
                // INSERT文準備
                $stmt = $pdo->prepare('DELETE FROM favorites WHERE favorite_user_id=:favorite_user_id AND favorited_user_id=:favorited_user_id');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':favorite_user_id', $favorite_user_id, PDO::PARAM_INT);
                $stmt->bindParam(':favorited_user_id', $favorited_user_id, PDO::PARAM_INT);
                // SELECT文本番実行
                $stmt->execute();
               
            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // 指定された会員が、マッチングしている全情報を取得
        public static function matching_now($user_id){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $stmt = $pdo->prepare('SELECT * FROM favorites WHERE favorite_user_id = :user_id and favorited_user_id in (SELECT favorite_user_id FROM favorites WHERE favorited_user_id=:user_id)');
                // バインド処理
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Favorite');
                // マッチング全情報を取得
                $my_all_matchings = $stmt->fetchAll();
                
                
               
            }catch(PDOException $e){
                $my_all_matchings =  false;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            
            // 全マッチング情報を返す
            return $my_all_matchings;
        }
 
    }