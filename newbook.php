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
    <title>蔵書登録画面</title>
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

    <div class="top_image">

        <form method="post" class="main" action="newbook_confirm.php" 　name="form" id="form" onsubmit="return check()">
            <h1>蔵書登録</h1>
             
              <div>
                <label>非公開/公開</label>
                <br>
                <input type="radio" id="1" name="private" value="1" <?php if(empty($_POST['private']) || $_POST['private']=== "1" ){ echo 'checked';} ?>>
                <label for="1">非公開</label>

                <input type="radio" id="2" name="private" value="2" <?php if(!empty($_POST['private']) && $_POST['private']=== "2" ){ echo 'checked';} ?>>
                <label for="2">公開</label>
            </div>

            <div>
                <label>タイトル</label>
                <br>
                <input type="text" class="text" size="30" maxlength="30" id="title" name="title" value="<?php if(!empty($_POST['title'])){echo $_POST['title'];}?>">
                <br>
            </div>
            <p style="color:#FF0000" id="title_msg"></p>

            <div>
                <label>著書</label>
                <br>
                <input type="text" class="text" size="30" maxlength="30" id="author" name="author" value="<?php if(!empty($_POST['author'])){echo $_POST['author'];}?>">
            </div>

            <div>
                <label>ISBN/ISSN</label>
                <br>
                <input type="text" pattern="^[-0-9]+$" class="text" size="13" maxlength="13" id="isbn" name="isbn" value="<?php if(!empty($_POST['isbn'])){echo $_POST['isbn'];}?>">
            </div>
            
            <div>
                <label>出版者</label>
                <br>
                <input type="text" class="text" size="30" maxlength="30" id="publisher" name="publisher" value="<?php if(!empty($_POST['publisher'])){echo $_POST['publisher'];}?>">
            </div>

            <div>
                <label>出版日</label>
                <br>
                <input type="text" pattern="^[0-9]{4}/(0[1-9]|1[0-2])/(0[1-9]|[12][0-9]|3[01])$" class="text" size="10" maxlength="10" id="publication_date" name="publication_date" placeholder="yyyy/mm/dd" value="<?php if(!empty($_POST['publication_date'])){echo $_POST['publication_date'];}?>">
            </div>

            <div>
                <label>未読/既読</label>
                <br>
                <input type="radio" id="1" name="unread" value="1" <?php if(empty($_POST['unread']) || $_POST['unread']=== "1" ){ echo 'checked';} ?>>
                <label for="1">未読</label>

                <input type="radio" id="2" name="unread" value="2" <?php if(!empty($_POST['unread']) && $_POST['unread']=== "2" ){ echo 'checked';} ?>>
                <label for="2">既読</label>
            </div>

            <div>
                <label>memo</label>
                <br>
                <textarea rows="5" cols="50" maxlength="200" id="memo" name="memo" value="<?php if(!empty($_POST['memo'])){echo $_POST['memo'];}?>"></textarea>
            </div>

            <div>
                <input type="submit" class="button" value="確認する">
            </div>

        </form>

    </div>
   
</body>

</html>
