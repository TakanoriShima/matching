<?php
    session_start();
    
    $_SESSION['user_id'];
    $_SESSION['flash_message'] = 'ログアウトしました';
    
    header('Location: index.php');
    exit;