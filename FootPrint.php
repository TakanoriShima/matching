<?php
    // あしあと情報を格納するDTO
    class FootPrint{
        public $id;
        public $visit_user_id;
        public $visited_user_id;
        public $created_at;
        
        public function __construct($visit_user_id="", $visited_user_id=""){
            $this->visit_user_id = $visit_user_id;
            $this->visited_user_id = $visited_user_id;
        }
        
        //足跡を残した会員情報を取得するメソッド
        public function get_visitor(){
            $visitor = UserDAO::get_user_by_id($this->visit_user_id);
            return $visitor;
        }
    
    }