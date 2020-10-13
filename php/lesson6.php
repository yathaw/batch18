<?php 
	
	echo "<h1> Array Key Exists </h1>";

	$meals =array(
		"Walnut Bun" => 1,
		"Cashew Nuts and White Mushrooms" => 4.95,
		"Dried Mulberries" => 3.00,
		"Eggplant with Chili Sauce" => 6.50,
		"Shrimp Puffs" => 0
	);

	if (array_key_exists('Shrimp Puffs',$meals)) {
		echo "Yes, we have Shrimp Puffs";
	}
	else{
		echo "No, we haven't.";
	}

	echo "<br>";

	if (array_key_exists('6.50',$meals)) {
		echo "Yes, we have Shrimp Puffs";
	}
	else{
		echo "No, we haven't.";
	}

	echo "<br> <hr>";

	echo "<h1> In Array </h1>";


	if (in_array('Shrimp', $meals)) {
		echo "Yes, we have Shrimp Puffs";
	}
	else{
		echo "No, we haven't.";
	}
	echo "<br>";

	if (in_array(6.50, $meals)) {
		echo "Yes, we have.";
	}
	else{
		echo "No, we haven't.";
	}


	echo "<br> <hr>";

	echo "<h1> Unset </h1>";


	$results = array(10, 20, 30, 40, 50, 60);

	unset($results[4]);


	foreach ($results as $result) {
		echo $result."<br>";
	}

	echo "<br> <hr>";
	echo "<h1> Implode </h1>";


	$dimsum = array('Chicken Bun', 'Stuffed Duck Web', 'Turnip Cake');

	$dimsum_menu =  implode(',',$dimsum);

	echo $dimsum_menu;

	echo "<br> <hr>";
	echo "<h1> Explode </h1>";

	$fish = 'Bass,Crab,Pike,Flounder';

	$fish_list = explode(',',$fish);

	foreach($fish_list as $value) {
		echo $value."<br>";
	}













	
?>