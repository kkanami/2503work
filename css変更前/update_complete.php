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
    <title>蔵書更新完了画面</title>

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

            <?php
        //PDO
        mb_internal_encoding("utf8");
     
        try{
            $pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","collection");
            $sql="update collection_book set private= :private , title= :title , author= :author , isbn= :isbn , publisher= :publisher , publication_date= :publication_date , unread= :unread , memo= :memo , update_time= now() where id = :id";

            $stmt=$pdo->prepare($sql);
        if(!empty($_POST)) {
            $private=(int) $_POST['private'];
            $stmt->bindvalue(':private',$private,PDO::PARAM_STR);
            $stmt->bindValue(':title',$_POST['title'],PDO::PARAM_STR);
            $stmt->bindvalue(':author',$_POST['author'],PDO::PARAM_STR);
            $stmt->bindvalue(':isbn',$_POST['isbn'],PDO::PARAM_STR);
            $stmt->bindvalue(':publisher',$_POST['publisher'],PDO::PARAM_STR);
            $stmt->bindvalue(':publication_date',$_POST['publication_date'],PDO::PARAM_STR);
            $unread=(int) $_POST['unread'];
            $stmt->bindvalue(':unread',$unread,PDO::PARAM_STR);
            $stmt->bindvalue(':memo',$_POST['memo'],PDO::PARAM_STR);
            $stmt->bindvalue(':id',$_POST['resultid1'],PDO::PARAM_STR);

            $stmt->execute();
            }
        
        }catch(Exception $e){
           echo '<span style="color:#FF0000">エラーが発生したため更新できません。</span>' . $e->getMessage();

            exit();
        }    
        
        ?>

            <form action="mypage.php" class="main">
                <h1>蔵書更新完了画面</h1>
                <p><span>更新完了しました</span></p>
                <input type="submit" class="button" value="マイページへ戻る">
            </form>

        </div>


    </main>

</body>

</html>
