<?php
    mb_internal_encoding("utf8");
    if(!isset($_SESSION)) {
        session_start();
     }

    if(empty($_SESSION['user'])) {
        echo "ログインしてください";
        echo' <form action="index.php"><input type="submit" class="button" value="ログイン"></form>';
        exit();
    }

    $pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","collection");
    $stmt=$pdo->query("select*from login_user where id = '". $_SESSION['user']."'");
    $row=$stmt->fetch();
    
    echo  "<p>". $row['nick_name']."さん"."</p>";


?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name=”description” content=”読書記録アプリケーション”>
    <meta property=”og:type” content=”website” />
    <meta property=”og:title” content=”Collection Of Book” />
    <meta property=”og:description” content=”読書記録アプリケーション” />
    <meta property=”og:site_name” content=”Collection Of Book” />
    <title>蔵書削除画面</title>
    <link rel="stylesheet" type="text/css" href="css/regist.css">
</head>

<body>
    <header>
        <div class="img_icon">
            <a href="index.php"><img src="img/library.png" title="TOPページへ" alt="TOPページへ"></a>
        </div>

        <div class="content">
            <ul class="menu">
                <li>
                    <h2>Collection Of Book</h2>
                </li>
                <li><a href="mypage.php">マイページ</a></li>
                <li> <a href="profile.php">プロフィール</a></li>
                <li> <a href="newbook.php">蔵書登録</a></li>
                <li> <a href="search.php">蔵書検索</a></li>
                <li> <a href="library.php">ライブラリー</a></li>
                <li><a href="logout.php">ログアウト</a></li>
            </ul>
        </div>
    </header>
    <main>
        <div class="top_image">
            <div class="main">
                <h1>蔵書削除画面</h1>



                <?php
                mb_internal_encoding("utf8");
                $pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","collection");
                  if(!empty($_POST['resultid2'])){
                $stmt=$pdo->query("select*from collection_book where id = '".$_POST['resultid2']."'");
                $row=$stmt->fetch(); }?>

                <table class="delete">
                    <tr>
                        <th>タイトル
                        </th>
                        <td>
                            <?php  if(isset($row['title'])){echo $row['title']; }?></td>
                    </tr>

                    <tr>
                        <th>著書
                        </th>
                        <td>
                            <?php if(isset($row['author'])){echo $row['author']; }?>
                        </td>
                    </tr>

                    <tr>
                        <th>ISBN/ISSN
                        </th>
                        <td>
                            <?php if(isset($row['isbn'])){echo $row['isbn']; } ?>
                        </td>
                    </tr>

                    <tr>
                        <th>出版者
                        </th>
                        <td>
                            <?php if(isset($row['publisher'])){echo $row['publisher']; } ?>
                        </td>
                    </tr>

                    <tr>
                        <th>出版日
                        </th>
                        <td>
                            <?php if(isset($row['publication_date'])){echo $row['publication_date']; } ?>
                        </td>
                    </tr>

                    <tr>
                        <th>未読/既読
                        </th>
                        <td>
                            <?php if(!empty($_POST['unread'])){
                            $option=['0'=>'未読',
                                    '1'=>'既読'];
                            $unread=$row['unread'] ;
                            $unreaddisp=$option[$row['unread']];
                             echo $unreaddisp;} ?>
                        </td>
                    </tr>

                    <tr>
                        <th>memo
                        </th>
                        <td>
                            <?php if(isset($row['memo'])){echo $row['memo']; } ?>
                        </td>
                    </tr>

                </table>

                <form method="post" action="delete_confirm.php">
                    <input type='hidden' value='<?php echo $_POST["resultid2"];?>' name='resultid2' id='resultid2'>
                    <input type="submit" class="button" value="確認する">
                </form>
            </div>
        </div>
    </main>


</body>

</html>
