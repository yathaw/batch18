<?php 
	
	require('db_connect.php');	

	$id = $_POST['id'];
	$name = $_POST['name'];
	$oldphoto = $_POST['oldphoto'];

	$newphoto = $_FILES['newphoto'];

	if ($newphoto['size'] > 0) {

		$source_dir = 'image/category/';
		$filename = mt_rand(100000, 999999);
		$file_exe_array = explode('.', $newphoto['name']);
		$file_exe = $file_exe_array[1];

		$fullpath = $source_dir.$filename.'.'.$file_exe;
		move_uploaded_file($newphoto['tmp_name'], $fullpath);
	}
	else{
		$fullpath = $oldphoto;
	}


	$sql = "UPDATE categories SET name=:value1, logo=:value2 WHERE id=:value3";
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(':value1', $name);
	$stmt->bindParam(':value2', $fullpath);
	$stmt->bindParam(':value3', $id);
	$stmt->execute();

	header('location:category_list.php');





?>