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
    <title>プロフィール更新完了画面</title>

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
            $pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","");
            if(!empty($_POST)) {
            $pdo->exec("update login_user set family_name='".$_POST['family_name']."' , last_name='".$_POST['last_name']."' , nick_name='".$_POST['nick_name']."' ,  mail='".$_POST['mail']."' , gender='".$_POST['gender']."' , postal_code='".$_POST['postal_code']."' , prefecture='".$_POST['prefecture']."' , address_1='".$_POST['address_1']."' , address_2='".$_POST['address_2']."' , update_time= now() where id = '". $_SESSION['user']."'");
            }

            if(!empty($_POST['password'])){
                $pdo->exec("update login_user set password='".password_hash($_POST['password'],PASSWORD_DEFAULT)."', update_time= now() where id ='". $_SESSION['user']."'");
            }

        }catch(Exception $e){
           echo '<span style="color:#FF0000">エラーが発生したためアカウント更新できません。</span>' . $e->getMessage();

           exit();
        }    
        
        ?>

        <div class="top_image">

            <form action="mypage.php" class="main">
                <h1>プロフィール更新完了画面</h1>
                <p><span>更新完了しました</span></p>
                <input type="submit" class="button" value="マイページへ戻る">
            </form>
        </div>

    </main>

</body>

</html>
