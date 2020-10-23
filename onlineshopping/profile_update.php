<?php 
	require('db_connect.php');
	session_start();


	$id = $_POST['id'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$address = $_POST['address'];
	$oldphoto = $_POST['oldphoto'];
	$newphoto = $_FILES['newphoto'];

	if ($newphoto['size'] > 0) {

		$source_dir = 'image/user/';
		$filename = mt_rand(100000, 999999);
		$file_exe_array = explode('.', $newphoto['name']);
		$file_exe = $file_exe_array[1];

		$fullpath = $source_dir.$filename.'.'.$file_exe;
		move_uploaded_file($newphoto['tmp_name'], $fullpath);
	}
	else{
		$fullpath = $oldphoto;
	}

	$sql = "UPDATE users SET name=:value1, profile=:value2, email=:value3, password=:value4, phone=:value5,  address=:value6, status=:value7 WHERE id=:value8";
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(':value1',$name);
	$stmt->bindParam(':value2',$fullpath);
	$stmt->bindParam(':value3',$email);
	$stmt->bindParam(':value4',$password);
	$stmt->bindParam(':value5',$phone);
	$stmt->bindParam(':value6',$address);
	$stmt->bindParam(':value7',$status);
	$stmt->bindParam(':value8',$id);
	$stmt->execute();

	unset($_SESSION['login_user']);

	$sql = "SELECT users.*, roles.name as rname FROM users 
			INNER JOIN model_has_roles 
			ON users.id = model_has_roles.user_id
			INNER JOIN roles
			ON model_has_roles.role_id = roles.id
			WHERE users.id = :v1";

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':v1', $id);
	$stmt->execute();

	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	$_SESSION['login_user'] = $user;

	header('location:profile.php');



?>