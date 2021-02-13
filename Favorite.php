<?php
    // 外部ファイルの読みこみ
    require_once 'UserDAO.php';
    
    // いいね情報を格納するDTO
    class Favorite{
        public $id;
        public $favorite_user_id;
        public $favorited_user_id;
        public $created_at;
        
        public function __construct($favorite_user_id="", $favorited_user_id=""){
            $this->favorite_user_id = $favorite_user_id;
            $this->favorited_user_id = $favorited_user_id;
        }
        
        //いいねをしてしてくれた会員情報を取得するメソッド
        public function get_favorite_user(){
            $favorite_user = UserDAO::get_user_by_id($this->favorite_user_id);
            return $favorite;
        }
        
        // いいねをされた会員情報を取得するメソッド
        public function get_favorited_user(){
            $favorited_user = UserDAO::get_user_by_id($this->favorited_user_id);
            return $favorited_user;
        }
    
    }