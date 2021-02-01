<?php
    require_once 'config.php';
    require_once 'FootPrint.php';
    // DAO
    class FootPrintDAO{
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
 
        // あしあとを保存するメソッド
        public static function insert($footprint){
            try{
                // データベースに接続
                $pdo = self::get_connection();
                // INSERT文準備
                $stmt = $pdo->prepare('INSERT INTO footprints(visit_user_id, visited_user_id) VALUES(:visit_user_id, :visited_user_id)');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':visit_user_id', $footprint->visit_user_id, PDO::PARAM_INT);
                $stmt->bindParam(':visited_user_id', $footprint->visited_user_id, PDO::PARAM_INT);
                // INSERT本番実行
                $stmt->execute();
                
            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // ログインしたユーザ番号を指定し、足跡一覧を取得するメソッド
        public static function get_my_all_footprints($user_id){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $stmt = $pdo->prepare('SELECT * FROM footprints WHERE visited_user_id=:visited_user_id ORDER BY created_at DESC');
                // バインド処理
                $stmt->bindParam(':visited_user_id', $user_id, PDO::PARAM_INT);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'FootPrint', array("", "", "", ""));
                // 会員を取得
                $footprints = $stmt->fetchAll();

            }catch(PDOException $e){
                $footprints =  null;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // 全あしあと情報を返す
            return $footprints;  
        }
 
    }