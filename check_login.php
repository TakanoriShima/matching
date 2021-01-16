<?php
    session_start();
    require_once 'UserDAO.php';

    
    // 入力フォームから値を取得
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 入力チェック
    $errors = UserDAO::check_login_input($email, $password);
    
    // 入力エラーが無ければ
    if(count($errors) === 0){
        
        // ログイン判定
        $user = UserDAO::login($email, $password);
        
        // 入力された情報の会員がいるのであれば
        if($user){
            // セッション情報にユーザIDを保存
            $_SESSION['user_id'] = $user->id;
            $_SESSION['flash_message'] = 'ログインしました';
            header('Location: top.php');
            exit;
        }else{
            $_SESSION['input_error'] = 'メールアドレスかパスワードが間違っています';
            header('Location: login.php');
            exit;
        }
        
    }else{ // 入力エラーがあれば
        // エラーメッセージのセット
        $_SESSION['errors'] = $errors;
        header('Location: login.php');
        exit;
    }
    
