<?php 
	
	echo "<h1> Indexed / Numeric Array </h1>";

	$fruits = array("apple", "orange", "grape", "pineapple");

	// $fruits = ["apple", "orange", "grape", "pineapple"];

	echo $fruits[0].' and '.$fruits[3];

	echo "<br> <hr>";

	echo "<h1> Associative Array </h1>";

	$results = array(
		'A'	=>	10,
		'B'	=>	20,
		'C'	=>	30
	);

	echo $results['B'];

	echo "<br> <hr>";

	echo "<h1> Multidimensional Array </h1>";


	$meals = array(
		'breakfast'	=>	['Coffee', 'Bread'],
		'lunch'		=>	['Fried Rice', 'Dumpling'],
		'dinner'	=>	['Fried Chicken', 'Coca Cola']
	);


	echo $meals['lunch'][1];
























	
?>