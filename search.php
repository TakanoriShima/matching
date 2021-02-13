<?php
    // 不正アクセス防止
    require_once 'login_filter.php';
    
    require_once 'UserDAO.php';
    require_once 'ProfileDAO.php';

    // セッション開始
    session_start();

    // フラッシュメッセージの取得と破棄    
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    // 会員番号の取得
    $user_id = $_SESSION['user_id'];
    
    // 会員情報の取得
    $me = UserDAO::get_user_by_id($user_id);

    // Viewの表示
    include_once 'search_view.php';