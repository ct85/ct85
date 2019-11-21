<?php
$db = new PDO('mysql:host=localhost;dbname=*****' ,"*****",'*****' );
$stmt = $db->prepare('show tables from member like :tblname');
$stmt->execute(array(':tblname' => "member"));
if ($stmt->rowCount() > 0) {
  // テーブル名は有効なので、テーブル削除を実行
  $query = "drop table if exists "."member";
  $db->exec($query);
}
?>