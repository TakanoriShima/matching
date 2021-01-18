<?php
    session_start();
    // print $_SESSION['user_id'];
    
    $flash_message = $_SESSION['flash_message'];
    
    $_SESSION['flash_message'] = null;

    session_destroy();
    
    include_once 'top_view.php';