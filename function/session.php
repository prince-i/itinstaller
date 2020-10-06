<?php
	
	require "server.php";
	require "config.php";
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];

		$fetch = "SELECT name from user where username ='$username' LIMIT 1";
		$stmt = $conn->prepare($fetch);
		$stmt->execute();
		$res = $stmt->fetchALL();
		foreach($res as $user){
			$name = $user['name'];
		}
	}else {
			session_unset();
			session_destroy();
			header('location: ../index.php');
		}
	
?>