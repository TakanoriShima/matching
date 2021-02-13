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
        <title>会員のプロフィール</title>
        <style>
            .overlay {
                position: absolute;
                display: none;
                top: 0;
                width: 100%;
                z-index: 1;
                background-color: rgba(0,0,0,0.6);
            }
            .overlay img {
                display: inline-block;
                position: absolute;
                border: 5px solid #fff;
            }
        </style>
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
               <?php if($my_profile === false): ?>
               <div class="col-sm-2">
                   <a href="setting.php" class="text-center">設定</a>
               </div>
               <?php endif; ?>
               
               <div class="col-sm-2">
                   <a href="logout.php" class="text-center">ログアウト</a>
               </div>
           </header>
           <div class="wrapper">
                <?php if($flash_message): ?>
                <div class="row mt-2">
                    <p class="flash_message col-sm-12 mb-2 text-center"><?= $flash_message ?></p>        
                </div>
                <?php endif; ?>
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <?= $profile->nickname ?>さん のプロフィール
                    </div>
                    <div class="card-body row">
                        <div class="col-sm-5">
                            <a class="img_popup" width="<?= $profile->get_avatar_info()[0] ?>" height="<?= $profile->get_avatar_info()[1] ?>"><img src="<?= AVATAR_IMG_DIR . $profile->avatar ?>" class="avatar"></a></div>
                            <?php if($profile->get_user()->login_flag == 0): ?>
                            <p class="text-center">最終ログイン</p>
                            <p class="text-center"><?= substr($profile->get_user()->last_login_at, 0, 16) ?> </p>
                            <?php else: ?>
                            <p class="ml-3 mt-2 text-center"><span class="login">●</span>ログイン中</p>
                            <?php endif; ?>
                            <div class="col-sm-4">
                                <div class="offset-sm-2 col-sm-7">
                                    <?php if($favorite_flag === false): ?> 
                                    <form action="create_favorite.php" method="POST">
                                        <input type="hidden" name="favorited_user_id" value="<?= $profile->get_user()->id ?>">
                                        <button type="submit">いいね</button>
                                    </form>
                                    <?php else: ?>
                                    <form action="delete_favorite.php" method="POST">
                                        <input type="hidden" name="favorited_user_id" value="<?= $profile->get_user()->id ?>">
                                        <button type="submit">いいね解除</button>
                                    </form>
                                    <?php endif; ?>
                                    <p class="color-red"><?= count($profile->get_my_all_favorited()) ?>いいね</p>
                                </div>
                            </div>
                            <?php if($matching_flag): ?>
                            <a href="messages.php" class="offset-sm-6 btn btn-primary">メッセージ</a>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <ul class="my_profile">
                                <li><?= substr($profile->get_user()->created_at, 0, 10) ?> 入会</li>
                                <li><?= $profile->get_user()->age ?>歳</li>
                                <li><?= $profile->prefecture ?></li>
                                <li><?= $profile->height ?>cm</li>
                                <li><?= $profile->weight ?>kg</li>
                                <li><?= $profile->profession ?></li>
                                <li><?= $profile->income ?>万円</li>
                                <li>飲酒:　　<?= $profile->drink ?></li>
                                <li>喫煙:　　<?= $profile->smoking ?></li>
                                <li>私のタイプ:　　<?= $profile->my_type ?></li>
                                <li>好きな異性のタイプ:　　<?= $profile->favorite_type ?></li>
                                <li>自己紹介:　　<p><?= str_replace("\n", "<br>", $profile->introduction) ?></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script>
            $(function() {
                $('body').prepend('<div class="overlay"></div>');
                
                $('a.img_popup').click(function() {
                var left = ($(window).width() / 2) + $(window).scrollLeft() - ($(this).attr('width') / 2);
                var top = ($(window).height() / 2) + $(window).scrollTop() - ($(this).attr('height') / 2);
                
                $('div.overlay').css('height', $(document).height());
                $('.overlay').empty().append('<img src="' + $($(this).children('img')).attr('src') + '" />').css({display: 'block'});
                
               
                $('div.overlay img').css({left: left, top: top, opacity: '1'});
                    return false;
                });
                
                $('div.overlay').click(function() {
                    $('div.overlay').hide();
                });
            });
        </script>
    </body>
</html>
