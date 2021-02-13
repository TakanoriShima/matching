<?php
    session_start();
    
    $user_id = $_SESSION['user_id'];
    
    if($user_id === null){
        $_SESSION['error_message'] = 'ログインしてください';
        header('Location: index.php');
        exit;
    }