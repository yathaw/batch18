<?php 
	
	echo "<h1> IF statement  </h1>";

	$x = 3;
	if ($x < 10) {
		echo "x is less than 10.";
	}

	echo "<br> <hr>";

	echo "<h1> If...else statement </h1>";

	$y = 12;
	if ($y < 10) {
		echo "y  is less than 10";
	}
	else{
		echo "y is $y.";
	}

	echo "<br> <hr>";

	echo "<h1> If...elseif...elseif...else statement </h1>";

	$z = 30;
	if ($z < 10) {
		echo "z is less than 10.";
	}

	elseif ($z == 20) {
		echo "z is 20.";
	}

	elseif ($z >50) {
		echo "z is greater than 50";
	}

	else{
		echo "z is $z.";
	}

	echo "<br> <hr>";

	echo "<h1> Switch statement </h1>";

	switch ($z) {
		case '$z < 10':
			echo "z is less than 10.";
			break;

		case '$z == 20':
			echo "z is 20.";
			break;

		case '$z > 50':
			echo "z is greater than 50.";
			break;
		
		default:
			echo "z is $z";
			break;
	}


















?>