<?php
    require_once 'UserDAO.php';
    class Profile{
        // プロパティ
        public $id;
        public $user_id;
        public $nickname;
        public $avatar;
        public $prefecture;
        public $height;
        public $weight;
        public $profession;
        public $income;
        public $drink;
        public $smoking;
        public $my_type;
        public $favorite_type;
        public $introduction;
        public $created_at;
        public $updated_at;
        
        // コンストラクタ
        public function __construct($user_id, $nickname, $prefecture, $height, $weight, $profession, $income, $drink, $smoking, $my_type, $favorite_type, $introduction){
            $this->user_id =  $user_id;
            $this->nickname = $nickname;
            $this->avatar = "";
            $this->prefecture = $prefecture;
            $this->height = $height;
            $this->weight = $weight;
            $this->profession = $profession;
            $this->income = $income;
            $this->drink = $drink;
            $this->smoking = $smoking;
            $this->my_type = $my_type;
            $this->favorite_type = $favorite_type;
            $this->introduction = $introduction;
        }
        
        // prifileを作成した会員のインスタンスを取得
        public function get_user(){
            $user = UserDAO::get_user_by_id($this->id);
            return $user;
        }
        // アバター画像のサイズ取得
        // ref) https://webkaru.net/php/function-getimagesize/
        public function get_avatar_info(){
            $avatar_filename = AVATAR_IMG_DIR .  $this->avatar;
            $avatar_info = getimagesize($avatar_filename);
            return $avatar_info;
        }
    }