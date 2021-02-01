<?php
    require_once 'UserDAO.php';
    require_once 'FootPrintDAO.php';
    session_start();
    
    // ログインユーザ情報取得
    $user_id = $_SESSION['user_id'];
    $user = UserDAO::get_user_by_id($user_id);
    
    // ログインしているユーザを訪問した人の足跡一覧取得
    $footprints = $user->get_all_my_footprints();
    
    // Viewの表示
    include_once 'footprints_view.php';
    