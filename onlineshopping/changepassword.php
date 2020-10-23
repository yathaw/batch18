<?php 
	
	require "db_connect.php";

	session_start();

	$changepassword = $_POST['changepassword'];
	$currentpassword = $_POST['currentpassword'];
	
	$id = $_SESSION['login_user']['id'];
	$oldpassword = $_SESSION['login_user']['password'];

	if ($currentpassword == $oldpassword) {
		$sql = "UPDATE users SET password=:value1 WHERE id=:value2";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':value2',$id);
		$stmt->bindParam(':value1',$changepassword);
		$stmt->execute();

		$_SESSION['chpassword_success'] = 'Please Login with new password!';

		session_destroy();

		header('location:login.php');
	}else{

		$_SESSION['chpassword_fail'] = 'Your Current Password is not same with old Password!';
		header('location:secret.php');
	}

	

?>