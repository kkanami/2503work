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
    <title>library</title>
    <link rel="stylesheet" type="text/css" href="css/mypage.css">

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
                <h1>library</h1>
                <p>ここでは他のユーザーが公開している本を閲覧できます。<br>
                    気になる本は、コピーで自分の蔵書に追加できます。
                </p>
                <ul class="list">
                    <?php
        $pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","collection");
        $stmt=$pdo->query("select* from collection_book where private=2 order by id desc");

             while($row=$stmt->fetch()){
                echo '<li class="list-item"><table class="mypage">' ;
              
                $result= $row['id'];
                $option=['1'=>'未読',
                         '2'=>'既読'];
                $unread=$row['unread'] ;
                $unreaddisp=$option[$row['unread']];
                echo '<tr><th class="left">'.$unreaddisp.'</th><th class="center"></th><th class="right"></th></tr>';
         
                $option=['1'=>'非公開',
                         '2'=>'公開'];
                $private=$row['private'] ;
                $privatedisp=$option[$row['private']];
                echo '<tr><td>'.$privatedisp.'</td><td></td><td>'. $row['title'].'</td></tr>';
                echo '<tr><td></td><td><br></td><td>'. $row['author']."</td></tr>";
                echo '<tr><td>'. $row['isbn']."</td><td><br></td><td>". $row['publisher']."</td></tr>";
                echo '<tr><td></td><td><br></td><td>'. $row['publication_date']."</td></tr>";   
                 
                echo '<tr><td></td>';
                 
                echo '<td><form  method="post" action="copy.php">';
                echo "<input type='hidden' value={$result} name='resultid2' id='resultid2'>";
                echo "<input type='submit' class='button' value='コピー'>";
 
                echo "</form>";
                echo "</td><td>". $row['memo']."</td></tr>";
           
                echo "</table>";
                echo "<br></li>";
               } 
            ?>
                </ul>
                <div class="list-btn">
                    <button>もっと見る</button>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/mypage.js"></script>
</body>

</html>
