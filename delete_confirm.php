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

    $pdo=new PDO("mysql:dbname=14_work;host=localhost;","kkanami","collection");
    $stmt=$pdo->query("select*from login_user where id = '". $_SESSION['user']."'");
    $row=$stmt->fetch();
    
    echo  "<p>". $row['nick_name']."さん"."</p>";

?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>蔵書削除確認画面</title>
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
                <h1>蔵書削除確認画面</h1>
                <p><span>本当に削除してよろしいですか？</span></p>

                <table class="delete">
                    <tr>
                        <td>
                            <form action="delete.php" method="post">
                                <input type='hidden' value='<?php echo $_POST["resultid2"];?>' name='resultid2' id='resultid2'>
                                <input type="submit" class="button" value="前に戻る">
                            </form>
                        </td>
                        <td>
                            <form action="delete_complete.php" method="post">
                                <input type='hidden' value='<?php echo $_POST["resultid2"];?>' name='resultid2' id='resultid2'>
                                <input type="submit" class="button" value="削除する">
                            </form>
                        </td>

                    </tr>
                </table>
            </div>
        </div>
    </main>


</body>

</html>
