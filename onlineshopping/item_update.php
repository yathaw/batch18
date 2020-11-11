<?php 
	
	require 'db_connect.php';

	$id = $_POST['id'];
	$oldphoto = $_POST['oldphoto'];
	$codeno = $_POST['codeno'];

	$name=$_POST['name'];
	$newphoto=$_FILES['image'];

	$unitprice=$_POST['unitprice'];
	$discount=$_POST['discount'];
	$description=$_POST['description'];
	$brand=$_POST['brand'];
	$subcategory=$_POST['category'];

	$codeno = "OP_".mt_rand(100000, 999999);

	$source_dir="image/item/";
	$file_name = mt_rand(100000, 999999);
  	$file_exe_array = explode('.', $newphoto['name']);
  	$file_exe = $file_exe_array[1];


	$file_path=$source_dir.$file_name.'.'.$file_exe;
	
	move_uploaded_file($newphoto['tmp_name'],$file_path);


	$sql="INSERT into items (codeno, name, photo, price, discount, description, brand_id, subcategory_id) VALUES(:value1, :value2, :value3, :value4, :value5, :value6, :value7, :value8)";
	$stmt= $pdo->prepare($sql);
	$stmt->bindParam(':value1',$codeno);
	$stmt->bindParam(':value2',$name);
	$stmt->bindParam(':value3',$file_path);
	$stmt->bindParam(':value4',$unitprice);
	$stmt->bindParam(':value5',$discount);
	$stmt->bindParam(':value6',$description);
	$stmt->bindParam(':value7',$brand);
	$stmt->bindParam(':value8',$subcategory);

	$stmt->execute();

    // $last_id = $pdo->lastInsertId();

	if($stmt->rowCount()){
		header("location:item_list.php");
	}
	else{
		echo " Error !";
	}



?>