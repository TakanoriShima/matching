<?php
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

    // プロフィール情報の取得
    $my_profile = ProfileDAO::get_profile_by_id($user_id); 
    
    // 異性の会員一覧取得
    $partners = ProfileDAO::get_all_partners($me->gender);
    // 現在ログイン中の異性の会員一覧取得
    // $partners = ProfileDAO::get_login_partners($me->gender);
    
    // Viewの読み込み
    include_once 'top_view.php';