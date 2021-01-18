<?php
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
    }