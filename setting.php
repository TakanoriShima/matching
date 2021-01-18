<?php
    session_start();
    require_once 'UserDAO.php';
    
    // セッションから会員番号を取得
    $user_id = $_SESSION['user_id']; 
    
    // ログインしている会員のインスタンス取得
    $user = UserDAO::get_user_by_id($user_id);

    // セッションからエラーメッセージの取得、削除
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;

    // Viewの読み込み
    include_once 'setting_view.php';