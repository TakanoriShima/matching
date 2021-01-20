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
        <title>My Page</title>
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
                <?php if($my_profile !== false): ?>
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <?= $my_profile->nickname ?>さん のマイページ
                    </div>
                    <div class="card-body row">
                        <div class="col-sm-4">
                            <img src="<?= AVATAR_IMG_DIR . $my_profile->avatar ?>" class="my_avatar">
                        </div>
                        <div class="col-sm-2 text-center mt-3">
                            <?= $my_profile->nickname ?>
                        </div>
                        <div class="col-sm-6">
                            <ul class="my_profile">
                                <li><?= $my_profile->get_user()->age ?>歳</li>
                                <li><?= $my_profile->prefecture ?></li>
                                <li><?= $my_profile->height ?>cm</li>
                                <li><?= $my_profile->weight ?>kg</li>
                                <li><?= $my_profile->profession ?></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <?php else: ?>
                <div class="row mt-5">
                    <div class="col-sm-12 text-center">
                        <a href="setting.php">プロフィールが、未設定です</a>
                    </div>
                </div>   
                <?php endif; ?>
            </div>
            <div class="row">
                <h2 class="col-sm-12 text-center mt-5">会員一覧</h2>
            </div>
            <div class="row">
                <?php foreach($partners as $profile): ?>
                <div class="col-sm-3 card mb-2">
                    <div class="card-header mt-3">
                        <img src="<?= AVATAR_IMG_DIR . $profile->avatar ?>" class="partner_avatar">
                    </div>
                    <div class="card-body">
                        <a href="show_user.php?id=<?= $profile->id ?>" class="text-center"><?= $profile->nickname ?></a><br />
                        <p class="text-center"><?= $profile->get_user()->age ?>歳</p>
                        <p class="text-center"><?= $profile->prefecture ?></p>
                        <p class="text-center"><?= substr($profile->get_user()->created_at, 0, 10) ?> 入会</p>
                        <?php if($profile->get_user()->login_flag == 0): ?>
                        <p class="text-center">最終ログイン</p>
                        <p class="text-center"><?= substr($profile->get_user()->last_login_at, 0, 16) ?> </p>
                        <?php else: ?>
                        <p class="text-center"><span class="login">●</span>ログイン中</p>
                        <?php endif; ?>
                    </div>
               </div>
               <?php endforeach; ?>
           </div>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>
