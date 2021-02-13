<?php
    // 不正アクセス防止
    require_once 'login_filter.php';
    
    require_once 'ProfileDAO.php';
    require_once 'UserDAO.php';
    
    session_start();
    
    $user_id = $_SESSION['user_id'];
    $user = UserDAO::get_user_by_id($user_id);
    $profile = ProfileDAO::get_profile_by_id($user_id);
    // var_dump($profile);
    include_once 'edit_profile_view.php';
    