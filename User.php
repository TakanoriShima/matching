<?php
    require_once 'FootPrintDAO.php';
    require_once 'ProfileDAO.php';
    
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
        
        // 自分へのあしあと一覧を取得するメソッド
        public function get_all_my_footprints(){
            $footprints = FootPrintDAO::get_my_all_footprints($this->id);
            return $footprints;
        }
        
        // プロフィール情報を取得するメソッド
        public function get_profile(){
            $profile = UserDAO::get_profile_by_id($this->id);
            return $profile;
        }
        
        // BMI結果表示
        public function show_bmi(){
            $profile = ProfileDAO::get_profile_by_id($this->id);
            $bmi = $profile->calc_bmi();
            // 体型
            if($bmi < 18.5){
                return 'やや細め';
            }else if($bmi < 25){
                return '普通';
            }else if($bmi < 30){
                return 'やや太め';
            }else if($bmi < 35){
                return '太め';
            }else if($bmi < 40){
                return 'かなり太め';
            }else{
                return '肥満';
            }
        }
    
    }