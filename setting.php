<?php
    session_start();
    require_once 'UserDAO.php';
    
    // セッションから会員番号を取得
    $user_id = $_SESSION['user_id']; 
    
    // ログインしている会員のインスタンス取得
    $user = UserDAO::get_user_by_id($user_id);

    // セッションからエラーメッセージの取得、削除
    $errors = $_SESSION['errors'];
    // セッションから破棄
    $_SESSION['errors'] = null;
    
    // セッションから入力値一覧を取得
    $input_values = $_SESSION['input_values'];
    // セッションから破棄
    $_SESSION['input_values'] = null;
    
    // 入力値の分解
    $nickname = $input_values['nickname'];
    $prefecture = $input_values['prefecture'];
    $height = $input_values['height'];
    $weight = $input_values['weight'];
    $profession = $input_values['profession'];
    $income = $input_values['income'];

    $drink = "普通に飲む";
    if($input_values['drink'] !== null){
       $drink = $input_values['drink']; 
    }
    
    $smoking = "たまに吸う";
    if($input_values['smoking'] !== null){
       $smoking = $input_values['smoking']; 
    }
    
    $my_type = $input_values['my_type'];
    $favorite_type = $input_values['favorite_type'];
    $introduction = $input_values['introduction'];


    // Viewの読み込み
    include_once 'setting_view.php';