<?php
    class User{
        // プロパティ
        public $id;
        public $email;
        public $password;
        public $created_at;
        public $last_login_at;
    
        // コンストラクタ
        public function __construct($email="", $password=""){
            $this->email = $email;
            $this->password = $pasword;
        }
    
    }