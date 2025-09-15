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
    <title>蔵書更新確認画面</title>

    <link rel="stylesheet" type="text/css" href="css/regist.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet">
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
                <h1>蔵書更新確認画面</h1>
                <table class="update">

                    <?php
            //PDO
            mb_internal_encoding("utf8");
            $pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","collection");
            if(!empty($_POST['resultid1'])){
            $stmt=$pdo->query("select*from collection_book where id = '". $_SESSION['user']."'");
            $row=$stmt->fetch();
            }
            ?>
                    <tr>
                        <th>非公開/公開
                        </th>
                        <td>
                            <?php if(!empty($_POST['private'])){
                            $option=['1'=>'非公開',
                                    '2'=>'公開'];
                            $private=$_POST['private'] ;
                            $privatedisp=$option[$_POST['private']];
                             echo $privatedisp; }?>
                        </td>
                    </tr>

                    <tr>
                        <th>タイトル
                        </th>
                        <td>
                            <?php if(!empty($_POST['title'])){echo $_POST['title'];}?></td>
                    </tr>

                    <tr>
                        <th>著書
                        </th>
                        <td>
                            <?php if(!empty($_POST['author'])){echo $_POST['author'];}?>
                        </td>
                    </tr>

                    <tr>
                        <th>ISBN/ISSN
                        </th>
                        <td>
                            <?php if(!empty($_POST['isbn'])){echo $_POST['isbn'];}?>
                        </td>
                    </tr>

                    <tr>
                        <th>出版者
                        </th>
                        <td>
                            <?php if(!empty($_POST['publisher'])){echo $_POST['publisher'];}?>
                        </td>
                    </tr>

                    <tr>
                        <th>出版日
                        </th>
                        <td>
                            <?php if(!empty($_POST['publication_date'])){echo $_POST['publication_date'];}?>
                        </td>
                    </tr>

                    <tr>
                        <th>未読/既読
                        </th>
                        <td>
                            <?php if(!empty($_POST['unread'])){
                            $option=['1'=>'未読',
                                    '2'=>'既読'];
                            $unread=$_POST['unread'] ;
                            $unreaddisp=$option[$_POST['unread']];
                             echo $unreaddisp; }?>
                        </td>
                    </tr>

                    <tr>
                        <th>memo
                        </th>
                        <td>
                            <?php if(!empty($_POST['memo'])){echo $_POST['memo'];}?>
                        </td>
                    </tr>
                </table>
                <div class="button_container">
                    <form action="update.php" method="post">
                        <input type='hidden' value='<?php echo $_POST["resultid1"];?>' name='resultid1' id='resultid1'>
                        <input type="submit" class="button" value="前に戻る">
                        <input type="hidden" value="<?php if(!empty($_POST['private'])){echo $_POST['private'];}?>" name="private">
                        <input type="hidden" value="<?php if(!empty($_POST['title'])){echo $_POST['title'];}?>" name="title">
                        <input type="hidden" value="<?php if(!empty($_POST['author'])){echo $_POST['author'];}?>" name="author">
                        <input type="hidden" value="<?php if(!empty($_POST['isbn'])){echo $_POST['isbn'];}?>" name="isbn">
                        <input type="hidden" value="<?php if(!empty($_POST['publisher'])){echo $_POST['publisher'];}?>" name="publisher">
                        <input type="hidden" value="<?php if(!empty($_POST['titpublication_datele'])){echo $_POST['publication_date'];}?>" name="publication_date">
                        <input type="hidden" value="<?php if(!empty($_POST['unread'])){echo $_POST['unread'];}?>" name="unread">
                        <input type="hidden" value="<?php if(!empty($_POST['memo'])){echo $_POST['memo'];}?>" name="memo">
                    </form>

                    <form action="update_complete.php" method="post">
                        <input type='hidden' value='<?php echo $_POST["resultid1"];?>' name='resultid1' id='resultid1'>
                        <input type="submit" class="button" value="更新する">
                        <input type="hidden" value="<?php if(!empty($_POST['private'])){echo $_POST['private'];}?>" name="private">
                        <input type="hidden" value="<?php if(!empty($_POST['title'])){echo $_POST['title'];}?>" name="title">
                        <input type="hidden" value="<?php if(!empty($_POST['author'])){echo $_POST['author'];}?>" name="author">
                        <input type="hidden" value="<?php if(!empty($_POST['isbn'])){echo $_POST['isbn'];}?>" name="isbn">
                        <input type="hidden" value="<?php if(!empty($_POST['publisher'])){echo $_POST['publisher'];}?>" name="publisher">
                        <input type="hidden" value="<?php if(!empty($_POST['titpublication_datele'])){echo $_POST['publication_date'];}?>" name="publication_date">
                        <input type="hidden" value="<?php if(!empty($_POST['unread'])){echo $_POST['unread'];}?>" name="unread">
                        <input type="hidden" value="<?php if(!empty($_POST['memo'])){echo $_POST['memo'];}?>" name="memo">
                    </form>
                </div>

            </div>
        </div>
    </main>


</body>

</html>
