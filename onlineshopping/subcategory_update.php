<?php 
	
	require('db_connect.php');

	$name = $_POST['name'];
	$categoryid = $_POST['categoryid'];
	$id = $_POST['id'];

	$sql = "UPDATE subcategories SET name=:value1, category_id=:value2 WHERE id=:value3";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1',$name);
	$stmt->bindParam(':value2',$categoryid);
	$stmt->bindParam(':value3',$id);	

	$stmt->execute();

	header('location: subcategory_list.php');


?>