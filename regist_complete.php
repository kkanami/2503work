<?php
mb_internal_encoding("utf8");
try{
$pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","collection");
$sql="insert into login_user(family_name,last_name,nick_name,mail,password,gender,postal_code,prefecture,address_1,address_2)
values(:family_name,:last_name,:nick_name,:mail,:password,:gender,:postal_code,:prefecture,:address_1,:address_2)";
if(!empty($_POST)) {
$stmt=$pdo->prepare($sql);
$stmt->bindValue(":family_name",$_POST['family_name'],PDO::PARAM_STR);
$stmt->bindvalue(":last_name",$_POST['last_name'],PDO::PARAM_STR);
$stmt->bindvalue(":nick_name",$_POST['nick_name'],PDO::PARAM_STR);
$stmt->bindvalue(":mail",$_POST['mail'],PDO::PARAM_STR);
$stmt->bindvalue(":password",password_hash($_POST['password'],PASSWORD_DEFAULT),PDO::PARAM_STR);
$gender=(int) $_POST['gender'];
$stmt->bindvalue(":gender",$gender,PDO::PARAM_INT);
$stmt->bindvalue(":postal_code",$_POST['postal_code'],PDO::PARAM_STR);
$stmt->bindvalue(":prefecture",$_POST['prefecture'],PDO::PARAM_STR);
$stmt->bindvalue(":address_1",$_POST['address_1'],PDO::PARAM_STR);
$stmt->bindvalue(":address_2",$_POST['address_2'],PDO::PARAM_STR);
$stmt->bindvalue(":address_2",$_POST['address_2'],PDO::PARAM_STR);

$stmt->execute();
}
}catch(Exception $e){
	echo '<span style="color:#FF0000">エラーが発生したためアカウント登録できません。</span>';

	exit();
}
?>


<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>登録完了画面</title>
        <link rel="stylesheet"type="text/css"href="css/regist.css">
    </head>
    <body>
       <div class="top_image">
        <h1>アカウント登録</h1>
        <div class="main">
            <p><span>登録完了しました</span></p>
             <form action="index.php">
           <input type="submit" class="button" value="TOPページへ戻る">
       </form>
        </div>
         </div>
    </body>
</html>


