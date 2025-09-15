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
    <title>アカウント登録確認画面</title>
    <link rel="stylesheet" type="text/css" href="css/regist.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet">
</head>


<body>
    <div class="top_image">
        <h1>アカウント登録確認</h1>
        <div class="main">
            <p>登録内容はこちらでよろしいでしょうか？
                <br>よろしければ「登録する」ボタンを押してください。
            </p>

            <p>名前（姓）
                <br>
                <?php if(!empty($_POST['family_name'])){echo $_POST['family_name'];} ?>
            </p>

            <p>名前（名）
                <br>
                <?php if(!empty($_POST['last_name'])){echo $_POST['last_name'];} ?>
            </p>

            <p>ニックネーム
                <br>
                <?php if(!empty($_POST['nick_name'])){echo $_POST['nick_name'];} ?>
            </p>

            <p>メールアドレス
                <br>
                <?php if(!empty($_POST['mail'])){echo $_POST['mail'];} ?>
            </p>

            <p>パスワード
                <br>
                <?php if(!empty($_POST['password'])){
                echo "セキリュティのため表示できません";} ?>
            </p>


            <p>性別
                <br>
                <?php if(!empty($_POST['gender'])){
            $option=['1'=>'男',
                    '2'=>'女',
                    '3'=>'未選択'];
            $gender=$_POST['gender'] ;
            $genderdisp=$option[$_POST['gender']];
             echo $genderdisp; }?>
            </p>

            <p>郵便番号
                <br>
                <?php if(!empty($_POST['postal_code'])){echo $_POST['postal_code'];} ?>
            </p>


            <p>住所（都道府県）
                <br>
                <?php 
           if(!empty($_POST['prefecture'])){echo $_POST['prefecture'];} ?>
            </p>

            <p>住所（市区町村）
                <br>
                <?php if(!empty($_POST['address_1'])){echo $_POST['address_1'];} ?>
            </p>

            <p>住所（番地）
                <br>
                <?php if(!empty($_POST['address_2'])){echo $_POST['address_2'];} ?>
            </p>
            <div class="button_container">

                <form method="POST" action="regist.php">
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


                <form action="regist_complete.php" method="post">
                    <input type="submit" class="button" value="登録する">
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
</body>

</html>
