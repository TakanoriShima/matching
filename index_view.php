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
        <title>マッチングサイト</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-3 mb-2">
                <div class="col-sm-1 mb-2">
                    <img src="home.png" class="home">
                </div>
                <h1 class="col-sm-11 pt-2 text-center">マッチングサイト</h1>
            </div>
            <?php if($flash_message): ?>
            <div class="row mt-2">
                <p class="flash_message col-sm-12 mb-2 text-center"><?= $flash_message ?></p>        
            </div>
            <?php endif; ?>
            <?php if($error_message): ?>
            <div class="row mt-2">
                <p class="error_message col-sm-12 mb-2 text-center"><?= $error_message ?></p>        
            </div>
            <?php endif; ?>
            <?php if(count($users) !== 0){ ?>
            <h4>全会員数： <?= count($users) ?>&nbsp;人</h4>
            <div class="row mt-2">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>会員番号</th>
                        <th>年齢</th>
                        <th>性別</th>
                        <th>体型</th>
                    </tr>
                <?php foreach($users as $user){ ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->age ?>歳</td>
                        <td><?= $user->gender ?></td>
                        <td><?= $user->get_profile()->height?>cm / <?= $user->show_bmi() ?></td>
                    </tr>
                <?php } ?>
                </table>
            <?php }else{ ?>
                <h2 class="offset-sm-3 col-sm-6 text-center">会員はまだいません</h2>
            <?php } ?>

                <div class="row col-sm-12 mt-5">
                    <a href="signup.php" class="btn btn-primary offset-sm-3 col-sm-2">会員登録</a>
                    <a href="login.php" class="btn btn-primary offset-sm-2 col-sm-2">ログイン</a>
                </div> 
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
