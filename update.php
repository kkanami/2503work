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
    <title>蔵書更新画面</title>

    <link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="css/regist.css">

    <script type="text/javascript">
        function check() {
            if (form.title.value == "") {
                document.getElementById("title_msg").innerHTML = "タイトルを入力してください。";
                return false;
            } else {
                return true;
            }
        }

    </script>

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
            <form method="post" class="main" action="update_confirm.php" 　name="form" id="form" onsubmit="return check()">

                <h1>蔵書更新画面</h1>
                <?php
                //PDO
                mb_internal_encoding("utf8");
                $pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","collection");
                if(!empty($_POST)){
                $stmt=$pdo->query("select*from collection_book where owner = '". $_SESSION['user']."' and id = '".$_POST['resultid1']."'");
                $row=$stmt->fetch() ;
                    }
                ?>

                <div>
                    <label>非公開/公開</label>
                    <br>
                    <input type="radio" id="1" name="private" value="1" <?php if(empty($_POST['private'])) { if($row['private']== "1" ){ echo 'checked';}} else{ if($_POST['private']== "1" ){ echo 'checked';}}?>>
                    <label for="1">非公開</label>

                    <input type="radio" id="2" name="private" value="2" <?php if(empty($_POST['private'])) { if($row['private']== "2" ){ echo 'checked';}} else{ if($_POST['private']== "2" ){ echo 'checked';}}?>>
                    <label for="2">公開</label>
                </div>

                <div>
                    <label>タイトル</label>
                    <br>
                    <input type="text" class="text" size="35" maxlength="10" id="title" name="title" value="<?php if(!empty($_POST['title'])){echo $_POST['title'];}else{echo $row['title'];}?>">
                    <br>
                </div>
                <p style="color:#FF0000" id="title_msg"></p>

                <div>
                    <label>著書</label>
                    <br>
                    <input type="text" class="text" size="35" maxlength="10" id="author" name="author" value="<?php if(!empty($_POST['author'])){echo $_POST['author'];}else{echo $row['author'];}?>">
                </div>

                <div>
                    <label>ISBN/ISSN</label>
                    <br>
                    <input type="text" pattern="^[-0-9]+$" class="text" size="35" maxlength="10" id="isbn" name="isbn" value="<?php if(!empty($_POST['isbn'])){echo $_POST['isbn'];}else{echo $row['isbn'];}?>">
                </div>

                <div>
                    <label>出版者</label>
                    <br>
                    <input type="text" 　inputmode="katakana" class="text" size="35" maxlength="10" id="publisher" name="publisher" value="<?php if(!empty($_POST['publisher'])){echo $_POST['publisher'];}else{echo $row['publisher'];}?>">
                </div>

                <div>
                    <label>出版日</label>
                    <br>
                    <input type="text" pattern="^[0-9]{4}/(0[1-9]|1[0-2])/(0[1-9]|[12][0-9]|3[01])$" class="text" size="10" maxlength="10" id="publication_date" name="publication_date" placeholder="yyyy/mm/dd" value="<?php if(!empty($_POST['publication_date'])){echo $_POST['publication_date'];}else{echo $row['publication_date'];}?>">
                </div>

                <div>
                    <label>未読/既読</label>
                    <br>
                    <input type="radio" id="1" name="unread" value="1" <?php if(empty($_POST['unread'])) { if($row['unread']== "1" ){ echo 'checked';}} else{ if($_POST['unread']== "1" ){ echo 'checked';}}?>>
                    <label for="1">未読</label>

                    <input type="radio" id="2" name="unread" value="2" <?php if(empty($_POST['unread'])) { if($row['unread']== "2" ){ echo 'checked';}} else{ if($_POST['unread']== "2" ){ echo 'checked';}}?>>
                    <label for="2">既読</label>
                </div>

                <div>
                    <label>memo</label>
                    <br>
                     <textarea rows="5" cols="50" maxlength="200" id="memo" name="memo"><?php if(!empty($_POST['memo'])){echo $_POST['memo'];}else{echo $row['memo'];}?></textarea>
                </div>

                <div>
                    <input type='hidden' value='<?php echo $_POST["resultid1"];?>' name='resultid1' id='resultid1'>
                    <input type="submit" class="button" value="確認する">
                </div>

            </form>

        </div>
    </main>

</body>

</html>
