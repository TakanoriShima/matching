<?php
    // 外部ファイルの読み込み
    require_once 'UserDAO.php';
    session_start();
    
    // セッション情報から会員番号を復元
    $user_id = $_SESSION['user_id'];
    
    // ログインフラッグをOFFに
    UserDAO::logout($user_id);
    
    $_SESSION['flash_message'] = 'ログアウトしました';
    
    header('Location: index.php');
    exit;