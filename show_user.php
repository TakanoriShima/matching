<?php
    require_once 'ProfileDAO.php';
    
    // 詳細を表示したい会員のプロフィール番号取得
    $id = $_GET['id'];
    
    // プロフィール番号から会員情報を取得
    $profile = ProfileDAO::get_profile_by_id($id);

    // View の表示
    include_once 'show_user_view.php';