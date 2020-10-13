<?php 
	
	echo "<h1> Sort </h1>";

	$dinner = array(
		'Sweet Corn and Asparagus', 
       	'Lemon Chicken',
       	'Braised Bamboo Fungus'
	);

	sort($dinner);

	foreach ($dinner as $dinner_value) {
		echo $dinner_value."<br>";
	}

	echo "<hr>";
	echo "<h1> Rsort </h1>";

	rsort($dinner);
	foreach ($dinner as $dinner_value) {
		echo $dinner_value."<br>";
	}

	

	$ass_dinner = array( 
        'breakfast' => 'Walnut Bun',
      	'lunch' 	=> 'Cashew Nuts and White Mushrooms',
      	'snack' 	=> 'Dried Mulberries',
      	'dinner' 	=> 'Eggplant with Chili Sauce'
    );

	echo "<hr>";
	echo "<h1> Asort </h1>";

	asort($ass_dinner);

	foreach ($ass_dinner as $value) {
		echo $value."<br>";
	}


	echo "<hr>";
	echo "<h1> Ksort </h1>";

	ksort($ass_dinner);

	foreach ($ass_dinner as $value) {
		echo $value."<br>";
	}


	echo "<hr>";
	echo "<h1> Arsort </h1>";

	arsort($ass_dinner);

	foreach ($ass_dinner as $value) {
		echo $value."<br>";
	}


	echo "<hr>";
	echo "<h1> Krsort </h1>";

	krsort($ass_dinner);

	foreach ($ass_dinner as $value) {
		echo "$value <br>";
	}











?>