<?php 
	
	$name  =  $_POST['edit_name'];
	$email = $_POST['edit_email'];
	$gender = $_POST['edit_gender'];
	$address = $_POST['edit_address'];

	$id = $_POST['edit_id'];

	$oldprofile = $_POST['edit_oldprofile'];
	$newprofile = $_FILES['edit_newprofile'];

	if ($newprofile['size'] > 0) {
		$basepath = 'photo/';
				// photo/abc.jpg
		$fullpath = $basepath.$newprofile['name'];
		move_uploaded_file($newprofile['tmp_name'], $fullpath);
	}else{
		$fullpath =  $oldprofile;
	}

	$student = array(
		"name"		=>	$name,
		"email"		=>	$email,
		"gender"	=>	$gender,
		"address"	=>	$address,
		"profile"	=>	$fullpath
	);

	// get jsonData from studentlist.json file

	$jsonData = file_get_contents('studentlist.json');

	if (!$jsonData) {
		$jsonData = '[]';
	}

	// convert into array from json

	$data_arr = json_decode($jsonData);

	$data_arr[$id] = $student;

	$jsonData = json_encode($data_arr, JSON_PRETTY_PRINT);

	file_put_contents('studentlist.json', $jsonData);


	header("location:index.php");





















?>