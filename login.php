<?php
    session_start();
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
    $input_error = $_SESSION['input_error'];
    $_SESSION['input_error'] = null;
    
    include_once 'login_view.php';