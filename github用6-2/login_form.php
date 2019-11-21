<?php
$dsn = 'mysql:dbname=*****;host=localhost';
$user = '*****';
$password = '*****';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
//4-2もしなかったらテーブルを作成する
$sql =  "CREATE TABLE IF NOT EXISTS member2"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "account VARCHAR(50) NOT NULL,"//char(32),TEXTって何
	. "mail VARCHAR(50) NOT NULL,"
	. "password TEXT NOT NULL,"
	. "flag TINYINT(1) NOT NULL DEFAULT 0"
	.")ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;";
	$stmt = $pdo->query($sql);
	


?>
<?php
session_start();
 
header("Content-type: text/html; charset=utf-8");
 
//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
 
//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
 
?>
 
<!DOCTYPE html>
<html>
<head>
<title>ログイン画面</title>
<meta charset="utf-8">
</head>
<body>
<h1>ログイン画面</h1>
 
<form action="login_check.php" method="post">
 
<p>アカウント：<input type="text" name="account" size="50"></p>
<p>パスワード：<input type="text" name="password" size="50"></p>
 
<input type="hidden" name="token" value="<?=$token?>">
<input type="submit" value="ログインする">
 
</form>
 


</body>
</html>

 
