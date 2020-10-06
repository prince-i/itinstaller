<?php
	//connection
	$servername = "localhost";
	$username = "root";
	$password = "";
	try{
		$conn = new PDO("mysql:host=$servername;dbname=db_installer;charset=utf8",$username,$password);
	}catch(PDOException $e){
		echo $sql . "No connection".$e->getMessage();
		
	}

?>