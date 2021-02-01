<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="favicon.ico">
        <title>プロフィール変更</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-1 mb-2">
                    <a href="top.php" class="home-link"><img src="home.png" class="home"></a>
                </div>
            </div>
           <header class="row">
               <div class="col-sm-2">
                   <a href="" class="text-center">検索</a>
               </div>
               <div class="col-sm-2">
                   <a href="" class="text-center">メッセージ</a>
               </div>
               <div class="col-sm-2">
                   <a href="" class="text-center">掲示板</a>
               </div>
               <div class="col-sm-2">
                   <a href="" class="text-center">お気に入り</a>
               </div>
               <div class="col-sm-2">
                   <a href="setting.php" class="text-center">設定</a>
               </div>
               <div class="col-sm-2">
                   <a href="logout.php" class="text-center">ログアウト</a>
               </div>
           </header>
           <div class="wrapper mt-3">
                <div class="row mt-3">
                    <h1 class="col-sm-12 text-center">プロフィール編集</h1>
                </div>
                <?php if(count($errors) !== 0): ?>
                <ul class="row mt-2">
                    <?php foreach($errors as $error):?>
                    <li class="error col-sm-12 mb-2 text-center"><?= $error ?></li>        
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <form action="update_profile.php" method="POST" class="mt-5" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">年齢</label>
                        <div class="col-sm-10">
                            <input type="text" name="age" class="form-control" value="<?= $user->age ?>歳" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="nickname">ニックネーム</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nickname" id="nickname" value="<?= $profile->nickname ?>" placeholder="ニックネームを入力してください">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">アバター画像</label>
                        <div class="col-sm-2">
                            <img src="<?= AVATAR_IMG_DIR . $profile->avatar ?>" class="edit_avatar">
                        </div>
                        <div class="offset-sm-1 col-sm-2">
                            <input type="file" name="avatar" accept='image/*' onchange="previewImage(this);">
                        </div>
                        <div class="col-sm-5">
                            <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:100px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">都道府県</label>
                        <div class="col-sm-4 pt-2">
                            <select name="prefecture" class="form-control">
                                <option value="0">選択してください</option>
                                <option value="北海道" <?php if($profile->prefecture === '北海道'): ?>selected<?php endif; ?>>北海道</option>
                                <option value="青森県" <?php if($profile->prefecture === '青森県'): ?>selected<?php endif; ?>>青森県</option>
                                <option value="岩手県" <?php if($profile->prefecture === '岩手県'): ?>selected<?php endif; ?>>岩手県</option>
                                <option value="宮城県" <?php if($profile->prefecture === '宮城県'): ?>selected<?php endif; ?>>宮城県</option>
                                <option value="秋田県" <?php if($profile->prefecture === '秋田県'): ?>selected<?php endif; ?>>秋田県</option>
                                <option value="山形県" <?php if($profile->prefecture === '山形県'): ?>selected<?php endif; ?>>山形県</option>
                                <option value="福島県" <?php if($profile->prefecture === '福島県'): ?>selected<?php endif; ?>>福島県</option>
                                <option value="茨城県" <?php if($profile->prefecture === '茨城県'): ?>selected<?php endif; ?>>茨城県</option>
                                <option value="栃木県" <?php if($profile->prefecture === '栃木県'): ?>selected<?php endif; ?>>栃木県</option>
                                <option value="群馬県" <?php if($profile->prefecture === '群馬県'): ?>selected<?php endif; ?>>群馬県</option>
                                <option value="埼玉県" <?php if($profile->prefecture === '埼玉県'): ?>selected<?php endif; ?>>埼玉県</option>
                                <option value="千葉県" <?php if($profile->prefecture === '千葉県'): ?>selected<?php endif; ?>>千葉県</option>
                                <option value="東京都" <?php if($profile->prefecture === '東京都'): ?>selected<?php endif; ?>>東京都</option>
                                <option value="神奈川県" <?php if($profile->prefecture === '神奈川県'): ?>selected<?php endif; ?>>神奈川県</option>
                                <option value="新潟県" <?php if($profile->prefecture === '新潟県'): ?>selected<?php endif; ?>>新潟県</option>
                                <option value="富山県" <?php if($profile->prefecture === '富山県'): ?>selected<?php endif; ?>>富山県</option>
                                <option value="石川県" <?php if($profile->prefecture === '石川県'): ?>selected<?php endif; ?>>石川県</option>
                                <option value="福井県" <?php if($profile->prefecture === '福井県'): ?>selected<?php endif; ?>>福井県</option>
                                <option value="山梨県" <?php if($profile->prefecture === '山梨県'): ?>selected<?php endif; ?>>山梨県</option>
                                <option value="長野県" <?php if($profile->prefecture === '長野県'): ?>selected<?php endif; ?>>長野県</option>
                                <option value="岐阜県" <?php if($profile->prefecture === '岐阜県'): ?>selected<?php endif; ?>>岐阜県</option>
                                <option value="静岡県" <?php if($profile->prefecture === '静岡県'): ?>selected<?php endif; ?>>静岡県</option>
                                <option value="愛知県" <?php if($profile->prefecture === '愛知県'): ?>selected<?php endif; ?>>愛知県</option>
                                <option value="三重県" <?php if($profile->prefecture === '三重県'): ?>selected<?php endif; ?>>三重県</option>
                                <option value="滋賀県" <?php if($profile->prefecture === '滋賀県'): ?>selected<?php endif; ?>>滋賀県</option>
                                <option value="京都府" <?php if($profile->prefecture === '京都府'): ?>selected<?php endif; ?>>京都府</option>
                                <option value="大阪府" <?php if($profile->prefecture === '大阪府'): ?>selected<?php endif; ?>>大阪府</option>
                                <option value="兵庫県" <?php if($profile->prefecture === '兵庫県'): ?>selected<?php endif; ?>>兵庫県</option>
                                <option value="奈良県" <?php if($profile->prefecture === '奈良県'): ?>selected<?php endif; ?>>奈良県</option>
                                <option value="和歌山県" <?php if($profile->prefecture === '和歌山県'): ?>selected<?php endif; ?>>和歌山県</option>
                                <option value="鳥取県" <?php if($profile->prefecture === '鳥取県'): ?>selected<?php endif; ?>>鳥取県</option>
                                <option value="島根県" <?php if($profile->prefecture === '島根県'): ?>selected<?php endif; ?>>島根県</option>
                                <option value="岡山県" <?php if($profile->prefecture === '岡山県'): ?>selected<?php endif; ?>>岡山県</option>
                                <option value="広島県" <?php if($profile->prefecture === '広島県'): ?>selected<?php endif; ?>>広島県</option>
                                <option value="山口県" <?php if($profile->prefecture === '山口県'): ?>selected<?php endif; ?>>山口県</option>
                                <option value="徳島県" <?php if($profile->prefecture === '徳島県'): ?>selected<?php endif; ?>>徳島県</option>
                                <option value="香川県" <?php if($profile->prefecture === '香川県'): ?>selected<?php endif; ?>>香川県</option>
                                <option value="愛媛県" <?php if($profile->prefecture === '愛知県'): ?>selected<?php endif; ?>>愛媛県</option>
                                <option value="高知県" <?php if($profile->prefecture === '高知県'): ?>selected<?php endif; ?>>高知県</option>
                                <option value="福岡県" <?php if($profile->prefecture === '福岡県'): ?>selected<?php endif; ?>>福岡県</option>
                                <option value="佐賀県" <?php if($profile->prefecture === '佐賀県'): ?>selected<?php endif; ?>>佐賀県</option>
                                <option value="長崎県" <?php if($profile->prefecture === '長崎県'): ?>selected<?php endif; ?>>長崎県</option>
                                <option value="熊本県" <?php if($profile->prefecture === '熊本県'): ?>selected<?php endif; ?>>熊本県</option>
                                <option value="大分県" <?php if($profile->prefecture === '大分県'): ?>selected<?php endif; ?>>大分県</option>
                                <option value="宮崎県" <?php if($profile->prefecture === '宮崎県'): ?>selected<?php endif; ?>>宮崎県</option>
                                <option value="鹿児島県" <?php if($profile->prefecture === '鹿児島県'): ?>selected<?php endif; ?>>鹿児島県</option>
                                <option value="沖縄県" <?php if($profile->prefecture === '沖縄県'): ?>selected<?php endif; ?>>沖縄県</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">身長</label>
                        <div class="col-sm-4 pt-2">
                            <select name="height" class="form-control">
                                <option value="0">選択してください</option>
                            <?php for($i = 150; $i <= 200; $i++): ?>
                                <option value="<?= $i ?>" <?php if($i === (int)$profile->height): ?>selected<?php endif; ?>><?= $profile->height ?>cm</option>
                            <?php endfor;?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">体重</label>
                        <div class="col-sm-4 pt-2">
                            <select name="weight" class="form-control">
                                <option value="0">選択してください</option>
                            <?php for($i = 40; $i <= 100; $i++): ?>
                                <option value="<?= $i ?>" <?php if($i === (int)$profile->weight): ?>selected<?php endif; ?>><?= $profile->weight ?>kg</option>
                            <?php endfor;?>
                            </select>
                        </div>
                    </div>
                    
                           
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">職業</label>
                        <div class="col-sm-4 pt-2">
                            <select name="profession" class="form-control">
                                <option value="0">選択してください</option>
                                <option value="公務員" <?php if($profile->profession === '公務員'): ?>selected<?php endif; ?>>公務員</option>
                                <option value="経営者・役員" <?php if($profile->profession === '経営者・役員'): ?>selected<?php endif; ?>>経営者・役員</option>
                                <option value="会社員" <?php if($profile->profession === '会社員'): ?>selected<?php endif; ?>>会社員</option>
                                <option value="自営業" <?php if($profile->profession === '自営業'): ?>selected<?php endif; ?>>自営業</option>
                                <option value="自由業" <?php if($profile->profession === '自由業'): ?>selected<?php endif; ?>>自由業</option>
                                <option value="専業主婦" <?php if($profile->profession === '専業主婦'): ?>selected<?php endif; ?>>専業主婦</option>
                                <option value="パート・アルバイト" <?php if($profile->profession === 'パート・アルバイト'): ?>selected<?php endif; ?>>パート・アルバイト</option>
                                <option value="学生" <?php if($profile->profession === '学生'): ?>selected<?php endif; ?>>学生</option>
                                <option value="その他" <?php if($profile->profession === 'その他'): ?>selected<?php endif; ?>>その他</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">年収</label>
                        <div class="col-sm-4 pt-2">
                            <select name="income" class="form-control">
                                <option value="0">選択してください</option>
                                <option value="~100">100万円未満</option>
                                <option value="100~200" <?php if($profile->income === '100~200'): ?>selected<?php endif; ?>>100万円以上200万円未満</option>
                                <option value="200~300" <?php if($profile->income === '200~300'): ?>selected<?php endif; ?>>200万円以上300万円未満</option>
                                <option value="300~400" <?php if($profile->income === '300~400'): ?>selected<?php endif; ?>>300万円以上400万円未満</option>
                                <option value="400~500" <?php if($profile->income === '400~500'): ?>selected<?php endif; ?>>400万円以上500万円未満</option>
                                <option value="500~600" <?php if($profile->income === '500~600'): ?>selected<?php endif; ?>>500万円以上600万円未満</option>
                                <option value="600~700" <?php if($profile->income === '600~700'): ?>selected<?php endif; ?>>600万円以上700万円未満</option>
                                <option value="700~800" <?php if($profile->income === '700~800'): ?>selected<?php endif; ?>>700万円以上800万円未満</option>
                                <option value="800~900" <?php if($profile->income === '800~900'): ?>selected<?php endif; ?>>800万円以上900万円未満</option>
                                <option value="900~1000" <?php if($profile->income === '900~1000'): ?>selected<?php endif; ?>>900万円以上100万円未満</option>
                                <option value="1000~" <?php if($profile->income === '1000~'): ?>selected<?php endif; ?>>1000万円以上</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">飲酒</label>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="飲まない" name="drink" id="drink_no" <?php if($profile->drink === '飲まない'): ?>checked<?php endif; ?>>
                            <label for="drink_no" col-form-label>飲まない</label>
                        </div>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="普通に飲む" name="drink" id="drink_medium" <?php if($profile->drink === '普通に飲む'): ?>checked<?php endif; ?>>
                            <label for="drink_medium" col-form-label>普通に飲む</label>
                        </div>
                          <div class="col-sm-2 pt-2">
                            <input type="radio" value="大好き" name="drink" id="drink_large" <?php if($profile->drink === '大好き'): ?>checked<?php endif; ?>>
                            <label for="drink_large" col-form-label>大好き</label>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">喫煙</label>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="吸わない" name="smoking" id="smoke_no" <?php if($profile->smoking === '吸わない'): ?>checked<?php endif; ?>>
                            <label for="smoke_no" col-form-label>吸わない</label>
                        </div>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="たまに吸う" name="smoking" id="smoke_meduim" <?php if($profile->smoking === 'たまに吸う'): ?>checked<?php endif; ?>>
                            <label for="smoke_meduim" col-form-label>たまに吸う</label>
                        </div>
                          <div class="col-sm-2 pt-2">
                            <input type="radio" value="吸う" name="smoking" id="smoke_large" <?php if($profile->smoking === '吸う'): ?>checked<?php endif; ?>>
                            <label for="smoke_large" col-form-label>吸う</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">私のタイプ</label>
                        <div class="col-sm-4 pt-2">
                            <select name="my_type" class="form-control">
                                <option value="0">選択してください</option>
                            <?php if($user->gender === '男性'): ?>
                                <option value="かっこいい系" <?php if($profile->my_type === 'かっこいい系'): ?>selected<?php endif; ?>>かっこいい系</option>
                                <option value="きさくで話しやすい系" <?php if($profile->my_type === 'きさくで話しやすい系'): ?>selected<?php endif; ?>>きさくで話しやすい系</option>
                                <option value="さわやか系" <?php if($profile->my_type === 'さわやか系'): ?>selected<?php endif; ?>>さわやか系</option>
                                <option value="頭脳明晰系" <?php if($profile->my_type === '頭脳明晰系'): ?>selected<?php endif; ?>>頭脳明晰系</option>
                                <option value="マッチョ系" <?php if($profile->my_type === 'マッチョ系'): ?>selected<?php endif; ?>>マッチョ系</option>
                                <option value="その他" <?php if($profile->my_type === 'その他'): ?>selected<?php endif; ?>>その他</option>
                            <?php else: ?>
                                <option value="かわいい系" <?php if($profile->my_type === 'かわいい系'): ?>selected<?php endif; ?>>かわいい系</option>
                                <option value="きさくで話しやすい系" <?php if($profile->my_type === 'きさくで話しやすい系'): ?>selected<?php endif; ?>>きさくで話しやすい系</option>
                                <option value="さわやか系" <?php if($profile->my_type === 'さわやか系'): ?>selected<?php endif; ?>>さわやか系</option>
                                <option value="頭脳明晰系" <?php if($profile->my_type === '頭脳明晰系'): ?>selected<?php endif; ?>>頭脳明晰系</option>
                                <option value="セクシー系" <?php if($profile->my_type === 'セクシー系'): ?>selected<?php endif; ?>>セクシー系</option>
                                <option value="その他" <?php if($profile->my_type === 'その他'): ?>selected<?php endif; ?>>その他</option>
                            <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">相手の希望</label>
                        <div class="col-sm-4 pt-2">
                            <select name="favorite_type" class="form-control">
                                <option value="0">選択してください</option>
                            <?php if($user->gender === '男性'): ?>
                                <option value="かわいい系" <?php if($profile->favorite_type === 'かわいい系'): ?>selected<?php endif; ?>>かわいい系</option>
                                <option value="きさくで話しやすい系" <?php if($profile->favorite_type === 'きさくで話しやすい系'): ?>selected<?php endif; ?>>きさくで話しやすい系</option>
                                <option value="さわやか系" <?php if($profile->favorite_type === 'さわやか系'): ?>selected<?php endif; ?>>さわやか系</option>
                                <option value="頭脳明晰系" <?php if($profile->favorite_type === '頭脳明晰系'): ?>selected<?php endif; ?>>頭脳明晰系</option>
                                <option value="セクシー系" <?php if($profile->favorite_type === 'セクシー系'): ?>selected<?php endif; ?>>セクシー系</option>
                                <option value="その他" <?php if($profile->favorite_type === 'その他'): ?>selected<?php endif; ?>>その他</option>
                            <?php else: ?>
                                <option value="かっこいい系" <?php if($profile->favorite_type === 'かっこいい系'): ?>selected<?php endif; ?>>かっこいい系</option>
                                <option value="きさくで話しやすい系" <?php if($profile->favorite_type === 'きさくで話しやすい系'): ?>selected<?php endif; ?>>きさくで話しやすい系</option>
                                <option value="さわやか系" <?php if($profile->favorite_type === 'さわやか系'): ?>selected<?php endif; ?>>さわやか系</option>
                                <option value="頭脳明晰系" <?php if($profile->favorite_type === '頭脳明晰系'): ?>selected<?php endif; ?>>頭脳明晰系</option>
                                <option value="マッチョ系" <?php if($profile->favorite_type === 'マッチョ系'): ?>selected<?php endif; ?>>マッチョ系</option>
                                <option value="その他" <?php if($profile->favorite_type === 'その他'): ?>selected<?php endif; ?>>その他</option>
                            <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="introduction">自己紹介</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="introduction" id="introduction" rows="20" placeholder="1000文字以内のプロフィールを入力してください"><?= $profile->introduction ?></textarea>
                            <small>現在<span class="showCnt">0</span>文字、残り<span class="remainCnt">1000</span>文字</small>
                        </div>
                    </div>
                
                    <!-- 1行 -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary col-sm-12 profile_btn">プロフィール登録</button>
                        </div>
                    </div>
                </form>
           </div>
        </div>
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script>
            function previewImage(obj)
            {
            	var fileReader = new FileReader();
            	fileReader.onload = (function() {
            		document.getElementById('preview').src = fileReader.result;
            	});
            	fileReader.readAsDataURL(obj.files[0]);
            }
            
            $(function(){
                $('#introduction').keyup(function() {
                    let cnt = (this).val().length;
                    $('.showCnt').text(cnt);
                    $('.remainCnt').text(1000 - cnt);
                    if(cnt >= 1000){
                        $('.showCnt').css('color','red');
                        $('.remainCnt').css('color','red');
                        $('.profile_btn').prop('disabled', true);
                        $('.profile_btn').removeClass("btn-primary").addClass("btn-danger");
                    }else{
                        $('.showCnt').css('color','black');
                        $('.remainCnt').css('color','black');
                        $('.profile_btn').prop('disabled', false);
                        $('.profile_btn').removeClass("btn-danger").addClass("btn-primary");
                    }
                });
            });
            
        </script>
    </body>
</html>
