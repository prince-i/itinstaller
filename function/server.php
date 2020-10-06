<?php
	require "config.php";
	session_start();
	if(isset($_POST['login_btn'])){
		$username = $_POST['username'];
		$password = $_POST['pwd'];
		if(empty($username) || empty($password)){
			echo "<script>alert('Please complete the credentials')</script>";	
		}else{
			$check = "SELECT *from user where username = '$username' and password = '$password' LIMIT 1";
			$stmt = $conn->prepare($check);
			$stmt->execute();
			$result = $stmt->fetchALL();
			if($stmt->rowCount() > 0){

				$_SESSION['username'] = $username;
				header('location: admin/dashboard.php');
 			}else{
 				echo "<script>alert('Incorrect login credentials')</script>";
 			}
		}
	}

	if(isset($_POST['logout_btn'])){
		session_unset();
		session_destroy();
		header('location: ../index.php');
	}
?>