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
        <title>あしあと一覧</title>
    </head>
    <body>
        <div class="container">
            <header class="navbar navbar-expand-sm navbar-light bg-light row col-sm-12">
                <!-- ホームへ戻るリンク。ブランドロゴなどを置く。 -->
                <a href="top.php" class="home-link col-sm-2 mb-1 mr-1"><img src="home.png" class="home"></a>
    
                <!-- 横幅が狭いときに出るハンバーガーボタン -->
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <!-- メニュー項目 -->
                <div class="collapse navbar-collapse col-sm-10 row" id="nav-bar">
                    <ul class="navbar-nav col-sm-12">
                        <li class="nav-item active col-sm-2"><a href="search.php" class="text-center">検索</a></li>
                        <li class="nav-item col-sm-2"><a href="" class="text-center">メッセージ</a></li>
                        <li class="nav-item col-sm-2"><a href="" class="text-center">掲示板</a></li>
                        <li class="nav-item col-sm-2"><a href="" class="text-center">お気に入り</a></li>
                        <li class="nav-item col-sm-2"><a href="footprints.php" class="text-center">あしあと</a></li>
                        <li class="nav-item col-sm-2"><a href="logout.php" class="text-center">ログアウト</a></li>
                    </ul>
                </div>
            </header>
            <div class="row">
                <h2 class="col-sm-12 text-center mt-5">あしあと一覧</h2>
            </div>
            <?php if(count($footprints) !== 0): ?>
            <div class="row">
                <div class="col-sm-12 mb-3">総アクセス回数：　<?= count($footprints) ?>回</div>
            </div>
            <div class="row">
               <table class="table table-bordered table-striped">
                   <tr>
                       <th>訪問日時</th>
                       <th>名前</th>
                       <th>画像</th>
                   </tr>
                   <?php foreach($footprints as $footprint): ?>
                   <tr>
                       <td><?= $footprint->created_at ?></td>
                       <td><a href="show_user.php?id=<?= $footprint->get_visitor()->id ?>"><?= $footprint->get_visitor()->get_profile()->nickname ?></a></td>
                       <td> <img src="<?= AVATAR_IMG_DIR . $footprint->get_visitor()->get_profile()->avatar ?>" class="partner_avatar"></td>
                   </tr>
                   <?php endforeach; ?>
               </table>
           </div>
           <?php else: ?>
           <div class="row">
               <div class="col-sm-12 text-center">あしあとはありません</div>
           </div>
           <?php endif; ?>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>
