<?php 
	
	$id = $_POST['sid'];

	// get jsonData from studentlist.json file

	$jsonData = file_get_contents('studentlist.json');

	// convert into array from json

	$data_arr = json_decode($jsonData);

	unset($data_arr[$id]);

	$jsonData = json_encode($data_arr, JSON_PRETTY_PRINT);

	file_put_contents('studentlist.json', $jsonData);

?>