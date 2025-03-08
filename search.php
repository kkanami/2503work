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
    <title>蔵書検索画面</title>
    <link rel="stylesheet" type="text/css" href="css/search.css">
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

            <form method="post" class="main" action="#">
                <h1>蔵書検索画面</h1>
                <table class="search">
                    <tr>
                        <th>タイトル</th>
                        <td><input type="text" class="text" id="title" name="title" value=""></td>
                        <th>著者</th>
                        <td><input type="text" class="text" id="author" name="author" value=""></td>
                    </tr>
                    <tr>
                        <th>ISBN/ISSN</th>
                        <td> <input type="text" id="isbn" name="isbn" value=""></td>
                        <th>出版者</th>
                        <td><input type="text" class="text" id="publisher" name="publisher" value=""></td>
                    </tr>
                    <tr>
                        <th>出版日</th>
                        <td> <input type="text" class="text" id="publication_date" name="publication_date" value=""></td>
                        <th>未読/既読</th>
                        <td> <input type="radio" id="1" name="unread" value="1" >
                            <label for="1">未読</label>
                            <input type="radio" id="2" name="unread" value="2">
                            <label for="2">既読</label>
                            <input type="radio" id="3" name="unread" value="3" checked>
                            <label for="3">未選択</label>
                        </td>
                    </tr>
                    <tr>
                        <th>memo</th>
                        <td> <input type="text" class="text" id="memo" name="memo" value=""></td>
                        <th>非公開/公開</th>
                        <td> <input type="radio" id="1" name="private" value="1" >
                            <label for="1">非公開</label>
                            <input type="radio" id="2" name="private" value="2">
                            <label for="2">公開</label>
                            <input type="radio" id="3" name="private" value="3" checked>
                            <label for="3">未選択</label>
                        </td>
                    </tr>
                </table>

                <div class="search_submit">
                    <input type="submit" class="button" value="検索">
                </div>

            </form>

            <?php
        mb_internal_encoding("utf8");
        $pdo=new PDO("mysql:dbname=kkanami;host=localhost;","kkanami","collection");
        $sql="select*from collection_book 
        where title like ? and author like ? and isbn like ? and publisher like ? and publication_date like ? and memo like ? and (unread=? or unread=?) and (private=? or private=?) and owner like ?";
            
      if(!empty($_POST)) {
        $stmt = $pdo->prepare($sql);
        $unread=isset($_POST['unread']) && ($_POST['unread']<=2)? $_POST['unread']:"1";
        $unread2=isset($_POST['unread']) && ($_POST['unread']<=2)? $_POST['unread']:"2";
          
        $private=isset($_POST['private']) && ($_POST['private']<=2)? $_POST['private']:"1";
        $private2=isset($_POST['private']) && ($_POST['private']<=2)? $_POST['private']:"2";
        
        $stmt->bindValue(1,'%'.$_POST['title'].'%',PDO::PARAM_STR);
        $stmt->bindValue(2,'%'.$_POST['author'].'%',PDO::PARAM_STR);
        $stmt->bindValue(3,'%'.$_POST['isbn'].'%',PDO::PARAM_STR);
        $stmt->bindValue(4, '%'.$_POST['publisher'].'%',PDO::PARAM_STR);
        $stmt->bindValue(5, '%'.$_POST['publication_date'].'%',PDO::PARAM_STR);
        $stmt->bindValue(6,'%'.$_POST['memo'].'%',PDO::PARAM_STR);
        $stmt->bindValue(7,$unread);
        $stmt->bindValue(8,$unread2);
        $stmt->bindValue(9,$private);
        $stmt->bindValue(10,$private2);
        $stmt->bindValue(11,'%'.$_SESSION['user'].'%',PDO::PARAM_STR);
          
        $stmt->execute();
      }
              
                
 if(!empty($_POST)){
     
  
        echo  '<table class="result" border="1">' ;
        echo  "<tr>";
        echo  " <th>非公開/公開</th>";
        echo  " <th>タイトル</th>";
        echo  "<th>著者</th>";
        echo  "  <th>ISBN/ISSN</th>";
        echo  "<th>出版者</th>";
        echo  " <th>出版日</th>";
        echo  "<th>未読/既読</th>";
        echo  " <th>memo</th>";
        echo  " <th>登録日</th>";
        echo  " <th>更新日</th>";
        echo  '<th colspan="2">操作</th>';
        echo  "</tr>";
     
     
     
     while($row=$stmt->fetch()){
                
        echo "<tr>";
        $result= $row['id'];
        $option=['1'=>'非公開',
                 '2'=>'公開'];
            $private=$row['private'] ;
            $privatedisp=$option[$row['private']];
        echo "<td>".$privatedisp."</td>";

        echo "<td>". $row['title']."</td>";
        echo "<td>". $row['author']."</td>";
        echo "<td>". $row['isbn']."</td>";
        echo "<td>". $row['publisher']."</td>";
        echo "<td>". $row['publication_date']."</td>";

        $option=['1'=>'未読',
                 '2'=>'既読'];
            $unread=$row['unread'] ;
            $unreaddisp=$option[$row['unread']];
        echo "<td>".$unreaddisp."</td>";
         
        echo "<td>".$row['memo']."</td>";

        $regist=$row['registered_time'];
       if(empty($row['registered_time'])){
           echo "<td>".''."</td>" ; 
       } else{ 
            echo "<td>". date('Y/m/d', strtotime($regist))."</td>";
       }

        $update=$row['update_time'];
      if(empty($row['update_time'])){
           echo "<td>".''."</td>" ; 
       } else { 
            echo "<td>". date('Y/m/d', strtotime($update))."</td>";
       }

        echo "<td>";
        echo '<form method="post" class="back" action="update.php" >';
        echo"<input type='hidden' value={$result} name='resultid1' id='resultid1'>";
        echo'<input type="submit" class="button" value="更新">';
        echo"</form>";
        echo"</td>";

        echo "<td>";
        echo '<form  method="post" class="back" action="delete.php">';
        echo"<input type='hidden' value={$result} name='resultid2' id='resultid2'>";
        echo"<input type='submit' class='button' value='削除'>";

        echo"</form>";
        echo"</td>";
        echo" </tr>";
    }
       }
 
         echo  " </table>";
   ?>

        </div>

    </main>

</body>

</html>
