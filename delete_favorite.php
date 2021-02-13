<?php
    // 不正アクセス防止
    require_once 'login_filter.php';
    require_once 'post_filter.php';
    
    require_once 'FavoriteDAO.php';
    
    session_start();
    
    // var_dump($_POST);
    $user_id = $_SESSION['user_id'];
    $favorited_user_id = $_POST['favorited_user_id'];
    // var_dump($user_id);
    
    FavoriteDAO::delete($user_id, $favorited_user_id);
    $_SESSION['flash_message'] = 'いいねを解除しました';
    header('Location: show_user.php?id=' . $favorited_user_id);
    exit;