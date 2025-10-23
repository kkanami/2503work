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
    <title>蔵書削除完了画面</title>

    <link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet"> 
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

        <?php
        //PDO
        mb_internal_encoding("utf8");
        try{
            $pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","collection");
            if(!empty($_POST['resultid2'])){
              $pdo->exec("update collection_book set delete_flag=1 , update_time= now() where id = '".$_POST['resultid2']."'");
            }
        }catch(Exception $e){
           echo '<span style="color:#FF0000">エラーが発生したため削除できません。</span>';

	       exit();
        }    
        ?>

        <div class="top_image">
            <form action="mypage.php" class="main">
                <h1>蔵書削除完了画面</h1>
                <p><span>削除完了しました</span></p>
                <input type="submit" class="button" value="マイページへ戻る">
            </form>
        </div>
    </main>

</body>

</html>
