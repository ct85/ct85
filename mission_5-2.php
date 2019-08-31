<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
     <?php
//4-1データベース接続
$dsn = 'mysql:dbname=******;host=localhost';
$user = '*********';
$password = '**********';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
//4-2もしなかったらテーブルを作成する
$sql = "CREATE TABLE IF NOT EXISTS mission52"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name TEXT,"
	. "comment TEXT,"
	. "time TEXT,"
	. "password TEXT"
	.");";
	$stmt = $pdo->query($sql);

      if(isset($_POST["chan"])){
      $sql = 'SELECT * FROM mission52'; 
      $stmt = $pdo->query($sql);
      $results=$stmt->fetchAll();
       foreach((array)$results as $row){
        if($row["id"]==$_POST["chan"]){
         if($row["password"]==$_POST["cpassword"]){
         $edinum=$_POST["chan"];
         $channame=$row["name"];
         $chancomment=$row["comment"];
         $chanpassword=$row["password"];
         }
        }
       }
      }
      if(!isset($channame)){
      $edinum="";
      $channame="";
      $chancomment="";
      $chanpassword="";
      }
     ?>
<body>
<h1>掲示板</h1>
<h2>投稿</h2>
    <form method="POST" action="mission_5-2.php">
    <label for="name">名前：</label>
    <input id="name" type="text" name="name" size="15" value=<?php echo $channame;?>>
    <label for="comment">　コメント：</label>
    <input id="comment" type="text" name="comment" size="15" value=<?php echo $chancomment;?>>
    <input id="edi" type="hidden" name="edi" size="5" value=<?php echo $edinum;?>>
    <label for="password">　パスワードを設定してください：</label>
    <input id="password" type="text" name="password" size="15" value=<?php echo $chanpassword;?>>
    <input type="submit" value="送信" />
    </form>
<br>
<h3>削除</h3>
    <form method="POST" action="mission_5-2.php">
    <label for="del">削除対象番号：</label>
    <input id="del" type="text" name="del" size="5" />
    <label for="dpassword">　送信時に設定したパスワードを入力してください：</label>
    <input id="dpassword" type="text" name="dpassword" size="15">
    <input type="submit" value="送信" />
    </form>
<br>
<h3>編集</h3>
    <form method="POST" action="mission_5-2.php">
    <label for="chan">編集対象番号：</label>
    <input id="chan" type="text" name="chan" size="5" />
    <label for="cpassword">　送信時に設定したパスワードを入力してください：</label>
    <input id="cpassword" type="text" name="cpassword" size="15">
    <input type="submit" value="送信" />
    </form>
<br>
すでに投稿した内容を編集したいときは、編集対象番号と、送信時に設定したパスワードを入力して、横の送信ボタンを押してください。<br>
その後、投稿フォームにその内容が出てくるので、訂正して、新規投稿と同じ要領で投稿してください。<br>
新規投稿にならず、編集されます。<br>
</body>
<br>

     <?php
      if(isset($_POST["comment"])){;//投稿・編集モードについて
      $na=$_POST["name"];
      $com=$_POST["comment"];
      $nowtime=new DateTime();
      $pass=$_POST["password"]; 
       if($_POST["edi"]==""){  //編集モードじゃないとき
       $sql = 'SELECT * FROM mission52';
       $stmt = $pdo->query($sql);
       $results = $stmt->fetchAll();
        if(count($results)>0){
        $lastline=$results[count($results)-1];//これだと0のとき困っちゃう
        $nu=(int)$lastline["id"];
        $nu+=1;
        }else{
        $nu=1;
        }
          //3-5new
       $sql = $pdo -> prepare("INSERT INTO mission52 (id,name,comment,time,password) VALUES (:id,:name,:comment,:time,:password)");
       $sql -> bindParam(':id', $id, PDO::PARAM_STR);
       $sql -> bindParam(':name', $name, PDO::PARAM_STR);
       $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
       $sql -> bindParam(':time', $time, PDO::PARAM_STR); //timeのフォーマットこれであってる？
       $sql -> bindParam(':password', $password, PDO::PARAM_STR);
       $id = $nu;
       $name = $na;
       $comment = $com;
       $time=(string)$nowtime->format('Y/m/d H:i:s');
       $password=$pass;
       $sql -> execute();
	
       }else{                         //編集モードのとき・全削除しなくていい！
       $id = $_POST["edi"]; //変更する投稿番号
       $name = $na;
       $comment = $com;
       $time=(string)$nowtime->format('Y/m/d H:i:s');
       $password=$pass;
       $sql = 'update mission52 set name=:name,comment=:comment,time=:time,password=:password where id=:id';
       $stmt = $pdo->prepare($sql);
       $stmt->bindParam(':name', $name, PDO::PARAM_STR);
       $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
       $stmt->bindParam(':time', $time, PDO::PARAM_STR);
       $stmt->bindParam(':password', $password, PDO::PARAM_STR);
       $stmt->bindParam(':id', $id, PDO::PARAM_INT);
       $stmt->execute();
       }
      }
     //削除
      if(isset($_POST["del"])){//パスワード処理が必要！！
      $password=$_POST["dpassword"];
      $id = $_POST["del"];
      $sql = 'delete from mission52 where id=:id and password=:password';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':password', $password, PDO::PARAM_STR);
      $stmt->execute();
      }
     
      $sql = 'SELECT * FROM mission52';     //最後に掲示板表示
      $stmt = $pdo->query($sql);
      $results = $stmt->fetchAll();
      foreach ($results as $row){
      echo $row['id'].' ';
      echo $row['name'].' ';
      echo $row['comment'].' ';
      echo $row['time'].'<br>';
      }

    ?>
    
  </body>
</html>
