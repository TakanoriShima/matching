<?php
    // 不正アクセス防止
    require_once 'login_filter.php';
    require_once 'post_filter.php';
    
    require_once 'ProfileDAO.php';
    
    session_start();
    // セッションから会員番号取得
    $user_id = $_SESSION['user_id'];
    
    // プロフィールインスタンスの取得
    $my_profile = UserDAO::get_profile_by_id($user_id);
    
    // 入力値を取得
    $nickname = $_POST['nickname'];
    $prefecture = $_POST['prefecture'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $profession = $_POST['profession'];
    $income = $_POST['income'];
    $drink = $_POST['drink'];
    $smoking = $_POST['smoking'];
    $my_type = $_POST['my_type'];
    $favorite_type = $_POST['favorite_type'];
    $introduction = $_POST['introduction'];
    
    // プロフィールインスタンスの生成
    $profile = new Profile($user_id, $nickname, $prefecture, $height, $weight, $profession, $income, $drink, $smoking, $my_type, $favorite_type, $introduction);
    
    // 入力チェック
    $errors = ProfileDAO::validate($profile, 0);
    
    //入力エラーが無ければ
    if(count($errors) === 0){
        // プロフィール登録実行
        ProfileDAO::update($profile);
        //フラッシュメッセージをセッションに保存
        $_SESSION['flash_message'] = 'プロフィールの編集を完了しました';
        // 画面遷移
        header('Location: top.php');
        exit;
    }else{ // 入力エラーがあれば
        //エラーメッセージ配列をセッションの保存
        $_SESSION['errors'] = $errors;
        // 入力値をセッションに保存
        // $_SESSION['input_values'] = $_POST;
        // $_SESSION['']
        // 画面遷移
        header('Location: edit_profile.php');
        exit;
    }
    
