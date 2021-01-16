<?php
    session_start();
    require_once 'UserDAO.php';
    
    // 入力フォームから値を取得
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 入力チェック
    $errors = UserDAO::check_new_user($email, $password);
    
    // 入力エラーが無ければ
    if(count($errors) === 0){
        // パスワードの暗号化
        $password_digest = password_hash($password, PASSWORD_BCRYPT);
        
        // Userインスタンス生成
        $user = new User($email, $password_digest);
        
        // テーブルに新規追加
        UserDAO::sign_up($user);
        
        // フラッシュメッセージのセット
        $_SESSION['flash_message'] = '会員登録が完了しました';
        header('Location: index.php');
        exit;
    }else{ // 入力エラーがあれば
        // エラーメッセージのセット
        $_SESSION['errors'] = $errors;
        header('Location: signup.php');
        exit;
    }
    
