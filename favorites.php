<?php
    // 不正アクセス防止
    require_once 'login_filter.php';
    
    require_once 'FavoriteDAO.php';
    
    session_start();
    
    $user_id = $_SESSION['user_id'];
    
    // ログインしている人をいいねした情報一覧
    $all_favorited = FavoriteDAO::get_my_all_favorited($user_id);
    
    // ログインしている人がいいねした情報一覧
    $all_favorites = FavoriteDAO::get_my_all_favorite($user_id);
    
    // ログインしている人がマッチングしている全情報一覧
    $my_all_matchings = FavoriteDAO::matching_now($user_id);
    include_once 'favorites_view.php';