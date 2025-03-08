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
    <title>蔵書登録確認画面</title>
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

    <div class="top_image">
        <div class="main">
            <p>登録内容はこちらでよろしいですか？
                <br>よければ「登録する」ボタンを押してください。
            </p>
            
             <p>非公開/公開
                <br>
                <?php if(!empty($_POST['private'])){
                $option=['1'=>'非公開',
                        '2'=>'公開'];
                $private=$_POST['private'] ;
                $privatedisp=$option[$_POST['private']];
                 echo $privatedisp; }?>
            </p>

            <p>タイトル
                <br>
                <?php if(!empty($_POST['title'])){echo $_POST['title'];} ?>
            </p>

            <p>著者
                <br>
                <?php if(!empty($_POST['author'])){echo $_POST['author'];} ?>
            </p>

            <p>ISBN/ISSN
                <br>
                <?php if(!empty($_POST['isbn'])){echo $_POST['isbn'];} ?>
            </p>

            <p>出版者
                <br>
                <?php if(!empty($_POST['publisher'])){echo $_POST['publisher'];} ?>
            </p>

            <p>出版日
                <br>
                <?php if(!empty($_POST['publication_date'])){
                echo $_POST['publication_date'];} ?>
            </p>


            <p>未読/既読
                <br>
                <?php if(!empty($_POST['unread'])){
            $option=['1'=>'未読',
                    '2'=>'既読'];
            $unread=$_POST['unread'] ;
            $unreaddisp=$option[$_POST['unread']];
             echo $unreaddisp; }?>
            </p>

            <p>memo
                <br>
                <?php if(!empty($_POST['memo'])){echo $_POST['memo'];} ?>
            </p>

            <div class="button_container">
                <form method="POST" action="newbook.php">
                    <input type="submit" class="button" value="前に戻る">
                    <input type="hidden" value="<?php if(!empty($_POST['private'])){echo $_POST['private'];}?>" name="private">
                    <input type="hidden" value="<?php if(!empty($_POST['title'])){echo $_POST['title'];}?>" name="title">
                    <input type="hidden" value="<?php if(!empty($_POST['author'])){echo $_POST['author'];}?>" name="author">
                    <input type="hidden" value="<?php if(!empty($_POST['isbn'])){echo $_POST['isbn'];}?>" name="isbn">
                    <input type="hidden" value="<?php if(!empty($_POST['publisher'])){echo $_POST['publisher'];}?>" name="publisher">
                    <input type="hidden" value="<?php if(!empty($_POST['publication_date'])){echo $_POST['publication_date'];}?>" name="publication_date">
                    <input type="hidden" value="<?php if(!empty($_POST['unread'])){echo $_POST['unread'];}?>" name="unread">
                    <input type="hidden" value="<?php if(!empty($_POST['memo'])){echo $_POST['memo'];}?>" name="memo">

                </form>
                
                <form action="newbook_complete.php" method="post">
                    <input type="submit" class="button" value="登録する">
                    <input type="hidden" value="<?php if(!empty($_POST['private'])){echo $_POST['private'];}?>" name="private">
                    <input type="hidden" value="<?php if(!empty($_POST['title'])){echo $_POST['title'];}?>" name="title">
                    <input type="hidden" value="<?php if(!empty($_POST['author'])){echo $_POST['author'];}?>" name="author">
                    <input type="hidden" value="<?php if(!empty($_POST['isbn'])){echo $_POST['isbn'];}?>" name="isbn">
                    <input type="hidden" value="<?php if(!empty($_POST['publisher'])){echo $_POST['publisher'];}?>" name="publisher">
                    <input type="hidden" value="<?php if(!empty($_POST['publication_date'])){echo $_POST['publication_date'];}?>" name="publication_date">
                    <input type="hidden" value="<?php if(!empty($_POST['unread'])){echo $_POST['unread'];}?>" name="unread">
                    <input type="hidden" value="<?php if(!empty($_POST['memo'])){echo $_POST['memo'];}?>" name="memo">

                </form>
            </div>
        </div>


    </div>


</body>

</html>
