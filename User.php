<?php
    class User{
        // プロパティ
        public $id;
        public $email;
        public $password_digest;
        public $created_at;
        public $last_login_at;
    
        // コンストラクタ
        public function __construct($email, $password){
            $this->email = $email;
            $this->password_digest = password_hash($password, PASSWORD_DEFAULT);
        }
    
    }