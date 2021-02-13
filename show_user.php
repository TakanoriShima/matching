<?php
    // 不正アクセス防止
    require_once 'login_filter.php';
    
    require_once 'ProfileDAO.php';
    require_once 'FootPrintDAO.php';
    require_once 'FavoriteDAO.php';
    session_start();
    
    // ログインユーザのidを取得
    $visit_user_id = $_SESSION['user_id'];
    
    // 詳細を表示したい会員のプロフィール番号取得
    $id = $_GET['id'];
    
    // プロフィール番号から会員情報を取得
    $profile = ProfileDAO::get_profile_by_id($id);

    // あしあとを保存
    $footprint = new FootPrint($visit_user_id, $id);
    FootPrintDAO::insert($footprint);
    
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    // ログインしているユーザが、この人にいいねしているかどうか
    $favorite_flag = FavoriteDAO::is_favorite($visit_user_id, $id);
    
    // ログインしているユーザが、この人とマッチングしているかどうか
    $matching_flag = FavoriteDAO::is_matching($visit_user_id, $id);
    
    // View の表示
    include_once 'show_user_view.php';
    
