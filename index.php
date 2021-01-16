<?php
    session_start();
    // DAOの読み込み    
    require_once 'UserDAO.php';

    // フラッシュメッセージの取得
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;

    // 全会員データ取得
    $users = UserDAO::get_all_users();
    
    // viewの表示
    include_once 'index_view.php';