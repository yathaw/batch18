<?php
	require "db_connect.php";

	$id = $_GET['id'];

	$status = "Confirm";

	$sql = "UPDATE orders SET status=:value1 WHERE id=:value2";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1',$status);
	$stmt->bindParam(':value2',$id);
	$stmt->execute();

	header('location:order_list.php');

?>