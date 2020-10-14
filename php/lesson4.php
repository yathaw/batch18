<?php 

	echo "<h1> For Loop </h1>";

	for ($i=1; $i < 19; $i++) { 
		echo "Batch  - ".$i."<br>";
	}

	echo "<br> <hr>";

	echo "<h1> While Loop </h1>";

	$a = 3;
	while ( $a <= 10) {
		echo "Student : $a <br>";
		$a++;
	}

	echo "<br> <hr>";

	echo "<h1> Do...while Loop </h1>";

	$b =1;
	do{
		echo "Batch - $b <br>";
		$b++;
	}while ( $b <= 10);

	echo "<br> <hr>";

	echo "<h1> Foreach Loop </h1>";

	$fruits = array("apple", "orange", "grape", "pineapple");


	foreach ($fruits as $fruit) {
		echo $fruit."<br>";
	}
























?>