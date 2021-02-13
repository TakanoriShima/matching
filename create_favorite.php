<?php
    require_once 'UserDAO.php';
    require_once 'FavoriteDAO.php';
    
    session_start();
    
    // セッションから会員番号取得
    $user_id = $_SESSION['user_id'];
    // show_user.php から 飛んできたいいね対象の会員番号取得
    $favorited_user_id = $_POST['favorited_user_id'];
    
    $favorite = new Favorite($user_id, $favorited_user_id);
    
    FavoriteDAO::insert($favorite);
    $_SESSION['flash_message'] = 'いいねを追加しました';
    
    header('Location: show_user.php?id=' . $favorited_user_id);
    exit;
    
    
    