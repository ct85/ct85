<?php
 
function db_connect(){
	$dsn = 'mysql:host=localhost;dbname=*****;charset=utf8';
	$user = '*****';
	$password = '*****';
	
	try{
		$dbh = new PDO($dsn, $user, $password);
		return $dbh;
	}catch (PDOException $e){
	    	print('Error:'.$e->getMessage());
	    	die();
	}
}
 
?>