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
    <title>プロフィール更新確認画面</title>

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
                <h1>プロフィール更新確認画面</h1>
                <table class="profile">

                    <?php
                    mb_internal_encoding("utf8");
                    $pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","collection");
                    if(empty($_POST)) {
                        $stmt=$pdo->query("select*from login_user where id = 5");
                        $row=$stmt->fetch();
                    }
                    ?>
                    <tr>
                        <th>名前（姓）
                        </th>
                        <td>
                            <?php if(!empty($_POST['family_name'])){echo $_POST['family_name'];} ?></td>
                    </tr>

                    <tr>
                        <th>名前（名）
                        </th>
                        <td>
                            <?php if(!empty($_POST['last_name'])){echo $_POST['last_name'];} ?>
                        </td>
                    </tr>

                    <tr>
                        <th>ニックネーム
                        </th>
                        <td>
                            <?php if(!empty($_POST['nick_name'])){echo $_POST['nick_name'];} ?>
                        </td>
                    </tr>

                    <tr>
                        <th>メールアドレス
                        </th>
                        <td>
                            <?php if(!empty($_POST['mail'])){echo $_POST['mail'];} ?>
                        </td>
                    </tr>

                    <tr>
                        <th>パスワード
                        </th>
                        <td>
                            <?php if(!empty($_POST['password'])){
                echo "セキュリティのため表示できません。";}else{echo "パスワードは変更されません。";} ?>
                        </td>
                    </tr>


                    <tr>
                        <th>性別
                        </th>
                        <td>
                            <?php if(!empty($_POST['gender'])){
                            $option=['1'=>'男',
                                    '2'=>'女',
                                    '3'=>'未選択'];
                            $gender=$_POST['gender'] ;
                            $genderdisp=$option[$_POST['gender']];
                             echo $genderdisp; }?>
                        </td>
                    </tr>

                    <tr>
                        <th>郵便番号
                        </th>
                        <td>
                            <?php if(!empty($_POST['postal_code'])){echo $_POST['postal_code'];} ?>
                        </td>
                    </tr>


                    <tr>
                        <th>住所（都道府県）
                        </th>
                        <td>
                            <?php 
                            if(!empty($_POST['prefecture'])){echo $_POST['prefecture'];} ?>
                        </td>
                    </tr>

                    <tr>
                        <th>住所（市区町村）
                        </th>
                        <td>
                            <?php if(!empty($_POST['address_1'])){echo $_POST['address_1'];} ?>
                        </td>
                    </tr>

                    <tr>
                        <th>住所（番地）
                        </th>
                        <td>
                            <?php if(!empty($_POST['address_2'])){echo $_POST['address_2'];} ?>
                        </td>
                    </tr>
                </table>

                <div class="button_container">

                    <form method="POST" action="profile.php">
                        <input type="submit" class="button" value="前に戻る">
                        <input type="hidden" value="<?php if(!empty($_POST['family_name'])){echo $_POST['family_name'];}?>" name="family_name">
                        <input type="hidden" value="<?php if(!empty($_POST['last_name'])){echo $_POST['last_name'];}?>" name="last_name">
                        <input type="hidden" value="<?php if(!empty($_POST['nick_name'])){echo $_POST['nick_name'];}?>" name="nick_name">
                        <input type="hidden" value="<?php if(!empty($_POST['mail'])){echo $_POST['mail'];}?>" name="mail">
                        <input type="hidden" value="<?php if(!empty($_POST['password'])){echo $_POST['password'];}?>" name="password">
                        <input type="hidden" value="<?php if(!empty($_POST['gender'])){echo $_POST['gender'];}?>" name="gender">
                        <input type="hidden" value="<?php if(!empty($_POST['postal_code'])){echo $_POST['postal_code'];}?>" name="postal_code">
                        <input type="hidden" value="<?php if(!empty($_POST['prefecture'])){echo $_POST['prefecture'];}?>" name="prefecture">
                        <input type="hidden" value="<?php if(!empty($_POST['address_1'])){echo $_POST['address_1'];}?>" name="address_1">
                        <input type="hidden" value="<?php if(!empty($_POST['address_2'])){echo $_POST['address_2'];}?>" name="address_2">

                    </form>

                    <form method="post" action="profile_complete.php">
                        <input type="submit" class="button" value="更新する">
                        <input type="hidden" value="<?php if(!empty($_POST['family_name'])){echo $_POST['family_name'];}?>" name="family_name">
                        <input type="hidden" value="<?php if(!empty($_POST['last_name'])){echo $_POST['last_name'];}?>" name="last_name">
                        <input type="hidden" value="<?php if(!empty($_POST['nick_name'])){echo $_POST['nick_name'];}?>" name="nick_name">
                        <input type="hidden" value="<?php if(!empty($_POST['mail'])){echo $_POST['mail'];}?>" name="mail">
                        <input type="hidden" value="<?php if(!empty($_POST['password'])){echo $_POST['password'];}?>" name="password">
                        <input type="hidden" value="<?php if(!empty($_POST['gender'])){echo $_POST['gender'];}?>" name="gender">
                        <input type="hidden" value="<?php if(!empty($_POST['postal_code'])){echo $_POST['postal_code'];}?>" name="postal_code">
                        <input type="hidden" value="<?php if(!empty($_POST['prefecture'])){echo $_POST['prefecture'];}?>" name="prefecture">
                        <input type="hidden" value="<?php if(!empty($_POST['address_1'])){echo $_POST['address_1'];}?>" name="address_1">
                        <input type="hidden" value="<?php if(!empty($_POST['address_2'])){echo $_POST['address_2'];}?>" name="address_2">

                    </form>

                </div>
            </div>
        </div>
    </main>


</body>

</html>
