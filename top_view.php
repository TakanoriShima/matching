<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <title>My Page</title>
    </head>
    <body>
        <div class="container mt-3">
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
           <div class="wrapper">
                <?php if($flash_message): ?>
                <div class="row mt-2">
                    <p class="flash_message col-sm-12 mb-2 text-center"><?= $flash_message ?></p>        
                </div>
                <?php endif; ?>
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
