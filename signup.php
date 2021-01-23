<?php
    session_start();

    // セッション情報取得
    $errors = $_SESSION['errors'];
    
    $_SESSION['errors'] = null;
    
    $gender = $_SESSION['gender'];
    $_SESSION['gender'] = null;
    
    if($gender === null){
        $gender = '男性';
    }
    
    $age = $_SESSION['age'];
    $_SESSION['age'] = null;
    
    $email = $_SESSION['email'];
    $_SESSION['email'] = null;
    
    // View の表示
    include_once 'new_user.php';
    
    