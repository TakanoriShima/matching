<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        // ログインしていれば
        if($_SESSION['user_id'] !== null){
            header('Location: top.php');
            exit;
        }else{
            header('Location: index.php');
            exit;
        }
    }