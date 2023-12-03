<?php
	$ds = 'mysql:host=localhost;dbname=u787258236_troquei;charset=utf8';
	$user = 'root';
	$pass = '';
	$db = new PDO($ds, $user, $pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));



	//mysql
	$hostname='localhost';
	$username='root';
	$password='';
	$dbname='u787258236_troquei';
	$bd_mysql = mysqli_connect($hostname,$username, $password, $dbname);
?>	