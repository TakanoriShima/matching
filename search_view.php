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
        <title>プロフィール検索</title>
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
                    <h1 class="col-sm-12 text-center">プロフィール検索</h1>
                </div>
                <?php if(count($errors) !== 0): ?>
                <ul class="row mt-2">
                    <?php foreach($errors as $error):?>
                    <li class="error col-sm-12 mb-2 text-center"><?= $error ?></li>        
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <form action="profile_search.php" method="GET" class="mt-5">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">年齢</label>
                        <div class="col-sm-4 pt-2">
                            <select name="age_lower" class="form-control">
                                <option value="0">未設定</option>
                            <?php for($i = 16; $i <= 80; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?>歳</option>
                            <?php endfor;?>
                            </select>
                        </div>
                        <div class="col-sm-2 text-center mt-3">～</div>
                        <div class="col-sm-4 pt-2">
                            <select name="age_upper" class="form-control">
                                <option value="0">未設定</option>
                            <?php for($i = 16; $i <= 80; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?>歳</option>
                            <?php endfor;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">都道府県</label>
                        <div class="col-sm-4 pt-2">
                            <select name="prefecture" class="form-control">
                                <option value="0">未設定</option>
                                <option value="北海道">北海道</option>
                                <option value="青森県">青森県</option>
                                <option value="岩手県">岩手県</option>
                                <option value="宮城県">宮城県</option>
                                <option value="秋田県">秋田県</option>
                                <option value="山形県">山形県</option>
                                <option value="福島県">福島県</option>
                                <option value="茨城県">茨城県</option>
                                <option value="栃木県">栃木県</option>
                                <option value="群馬県">群馬県</option>
                                <option value="埼玉県">埼玉県</option>
                                <option value="千葉県">千葉県</option>
                                <option value="東京都">東京都</option>
                                <option value="神奈川県">神奈川県</option>
                                <option value="新潟県">新潟県</option>
                                <option value="富山県">富山県</option>
                                <option value="石川県">石川県</option>
                                <option value="福井県">福井県</option>
                                <option value="山梨県">山梨県</option>
                                <option value="長野県">長野県</option>
                                <option value="岐阜県">岐阜県</option>
                                <option value="静岡県">静岡県</option>
                                <option value="愛知県">愛知県</option>
                                <option value="三重県">三重県</option>
                                <option value="滋賀県">滋賀県</option>
                                <option value="京都府">京都府</option>
                                <option value="大阪府">大阪府</option>
                                <option value="兵庫県">兵庫県</option>
                                <option value="奈良県">奈良県</option>
                                <option value="和歌山県">和歌山県</option>
                                <option value="鳥取県">鳥取県</option>
                                <option value="島根県">島根県</option>
                                <option value="岡山県">岡山県</option>
                                <option value="広島県">広島県</option>
                                <option value="山口県">山口県</option>
                                <option value="徳島県">徳島県</option>
                                <option value="香川県">香川県</option>
                                <option value="愛媛県">愛媛県</option>
                                <option value="高知県">高知県</option>
                                <option value="福岡県">福岡県</option>
                                <option value="佐賀県">佐賀県</option>
                                <option value="長崎県">長崎県</option>
                                <option value="熊本県">熊本県</option>
                                <option value="大分県">大分県</option>
                                <option value="宮崎県">宮崎県</option>
                                <option value="鹿児島県">鹿児島県</option>
                                <option value="沖縄県">沖縄県</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">身長</label>
                        <div class="col-sm-4 pt-2">
                            <select name="height_lower" class="form-control">
                                <option value="0">未設定</option>
                            <?php for($i = 150; $i <= 200; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?>cm</option>
                            <?php endfor;?>
                            </select>
                        </div>
                        <div class="col-sm-2 mt-3 text-center">～</div>
                        <div class="col-sm-4 pt-2">
                            <select name="height_upper" class="form-control">
                                <option value="0">未設定</option>
                            <?php for($i = 150; $i <= 200; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?>cm</option>
                            <?php endfor;?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">体重</label>
                        <div class="col-sm-4 pt-2">
                            <select name="weight_lower" class="form-control">
                                <option value="0">未設定</option>
                            <?php for($i = 40; $i <= 100; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?>kg</option>
                            <?php endfor;?>
                            </select>
                        </div>
                        <div class="col-sm-2 mt-3 text-center">～</div>
                        <div class="col-sm-4 pt-2">
                            <select name="weight_upper" class="form-control">
                                <option value="0">未設定</option>
                            <?php for($i = 40; $i <= 100; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?>kg</option>
                            <?php endfor;?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">職業</label>
                        <div class="col-sm-4 pt-2">
                            <select name="profession" class="form-control">
                                <option value="0">未設定</option>
                                <option value="公務員">公務員</option>
                                <option value="経営者・役員">経営者・役員</option>
                                <option value="会社員">会社員</option>
                                <option value="自営業">自営業</option>
                                <option value="自由業">自由業</option>
                                <option value="専業主婦">専業主婦</option>
                                <option value="パート・アルバイト">パート・アルバイト</option>
                                <option value="学生">学生</option>
                                <option value="その他">その他</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">年収</label>
                        <div class="col-sm-4 pt-2">
                            <select name="income" class="form-control">
                                <option value="0">未設定</option>
                                <option value="~100">100万円未満</option>
                                <option value="100~200">100万円以上200万円未満</option>
                                <option value="200~300">200万円以上300万円未満</option>
                                <option value="300~400">300万円以上400万円未満</option>
                                <option value="400~500">400万円以上500万円未満</option>
                                <option value="500~600">500万円以上600万円未満</option>
                                <option value="600~700">600万円以上700万円未満</option>
                                <option value="700~800">700万円以上800万円未満</option>
                                <option value="800~900">800万円以上900万円未満</option>
                                <option value="900~1000">900万円以上100万円未満</option>
                                <option value="1000~">1000万円以上</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">飲酒</label>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="0" name="drink" id="drink_no" checked>
                            <label for="drink_no" col-form-label>未設定</label>
                        </div>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="飲まない" name="drink" id="drink_no">
                            <label for="drink_no" col-form-label>飲まない</label>
                        </div>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="普通に飲む" name="drink" id="drink_medium">
                            <label for="drink_medium" col-form-label>普通に飲む</label>
                        </div>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="大好き" name="drink" id="drink_large">
                            <label for="drink_large" col-form-label>大好き</label>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">喫煙</label>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="0" name="smoking" id="smoke_no" checked>
                            <label for="smoke_no" col-form-label>未設定</label>
                        </div>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="吸わない" name="smoking" id="smoke_no">
                            <label for="smoke_no" col-form-label>吸わない</label>
                        </div>
                        <div class="col-sm-2 pt-2">
                            <input type="radio" value="たまに吸う" name="smoking" id="smoke_meduim">
                            <label for="smoke_meduim" col-form-label>たまに吸う</label>
                        </div>
                          <div class="col-sm-2 pt-2">
                            <input type="radio" value="吸う" name="smoking" id="smoke_large">
                            <label for="smoke_large" col-form-label>吸う</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">相手の希望</label>
                        <div class="col-sm-4 pt-2">
                            <select name="favorite_type" class="form-control">
                                <option value="0">未設定</option>
                            <?php if($me->gender === '男性'): ?>
                                <option value="かっこいい系">かわいい系</option>
                                <option value="きさくで話しやすい系">きさくで話しやすい系</option>
                                <option value="さわやか系">さわやか系</option>
                                <option value="頭脳明晰系">頭脳明晰系</option>
                                <option value="セクシー系">セクシー系</option>
                                <option value="その他">その他</option>
                            <?php else: ?>
                                <option value="かっこいい系">かっこいい系</option>
                                <option value="きさくで話しやすい系">きさくで話しやすい系</option>
                                <option value="さわやか系">さわやか系</option>
                                <option value="頭脳明晰系">頭脳明晰系</option>
                                <option value="マッチョ系">マッチョ系</option>
                                <option value="その他">その他</option>
                            <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="keyword">キーワード</label>
                         <div class="col-sm-10">
                            <input type="search" class="form-control" name="keyword" id="keyword" placeholder="フリーキーワードを入力してください">
                        </div>
                    </div>
                
                    <!-- 1行 -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-3 mb-3">
                            <button type="submit" name="btn_type" value="search" class="btn btn-primary col-sm-12 profile_btn">検索</button>
                        </div>
                        <div class="offset-sm-2 col-sm-3">
                            <button type="submit" name="btn-type" value="reset" class="btn btn-danger col-sm-12 profile_btn">リセット</button>
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
                // alert("a");
                $('#introduction').keyup(function() {
                    let cnt = $(this).val().length;
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
