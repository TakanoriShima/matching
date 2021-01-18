<?php
    class User{
        // プロパティ
        public $id;
        public $gender;
        public $age;
        public $email;
        public $password_digest;
        public $created_at;
        public $last_login_at;
    
        // コンストラクタ
        public function __construct($gender, $age, $email, $password_digest){
            $this->gender = $gender;
            $this->age = $age;
            $this->email = $email;
            $this->password_digest = $password_digest;
        }
    
    }