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
    
    if($_GET['btn_type'] === 'search'){
        // 検索にヒットする異性の会員情報取得
        $partners = ProfileDAO::search_profiles($_GET, $me->gender);
        // var_dump($partners);
        
        // Viewの読み込み
        include_once 'top_view.php';
    }else{
        header('Location: search.php');
        exit;
    }

    
    
    