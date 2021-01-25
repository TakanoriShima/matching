<?php
    session_start();
    require_once 'ProfileDAO.php';
    require_once 'UserDAO.php';
    
    // セッションから会員番号取得
    $user_id = $_SESSION['user_id'];
    $user = UserDAO::get_user_by_id($user_id);
    $profile = ProfileDAO::get_profile_by_id($user_id);
    // var_dump($profile);
    include_once 'edit_profile_view.php';
    