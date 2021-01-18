<?php
    require_once 'UserDAO.php';
    require_once 'ProfileDAO.php';

    // セッション開始
    session_start();

    // フラッシュメッセージの取得と破棄    
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    // Viewの読み込み
    include_once 'top_view.php';