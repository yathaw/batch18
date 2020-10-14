<?php 
	
	echo "<h1> Function </h1>";

	$name = "Ya Thaw";

	function showName(){
		echo 'Myat Noe';
	}

	showName();

	//--------------------------------------------------

	echo "<br> <hr>";

	echo "<h1> Argument </h1>";

	function showfirstName($n){
		echo $n;
	}

	showfirstName($name);

	//--------------------------------------------------

	echo "<br> <hr>";

	echo "<h1> Argument Function </h1>";

	function sum($num1, $num2){
		$sumResult = $num1 + $num2;

		echo "First Number :".$num1."<br>";

		echo "Second Number :".$num2."<br>";

		echo "Result :".$sumResult."<br>";
	}

	sum(4, 5);

	//--------------------------------------------------


	echo "<br> <hr>";

	echo "<h1> Array Argument Function </h1>";

	$numbers = array(5, 6, 7, 3, 4, 2, 9, 1);

	function array_plus($nums){

		$num1 = $nums[4];
		$num2 = $nums[0];

		$sumResult = $num1 + $num2;

		echo "First Number :".$num1."<br>";

		echo "Second Number :".$num2."<br>";

		echo "Result :".$sumResult."<br>";
	}


	array_plus($numbers);






















	
?>