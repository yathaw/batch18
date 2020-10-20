<?php 
	
	require('db_connect.php');

	$id = $_POST['id'];

	$sql = "DELETE FROM subcategories WHERE id=:value1";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1', $id);
	$stmt->execute();

	header("location:subcategory_list.php");

?>