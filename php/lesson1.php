<?php 
	echo "Hello";
	var_dump("Hello");


	$name = "Ya Thaw Myat Noe";
	$address = "Yangon";

	echo "<br>".$name;

	echo "I am $name. <br>";

	echo 'I am $name. <br>';

	echo 'I am '.$name.'. <br>';

	$name1 = '     Ko Ko ';

	$trim_name1 = trim($name1);

	var_dump($name1);

	var_dump($trim_name1);

	echo "<br>";

	echo strlen($name1)."<br>";

	echo strlen($trim_name1)."<br>";


	echo strcasecmp("Hello World!", "HELLO WORLD!");

	echo strcasecmp("Hello World!", "Hello");

	echo strcasecmp("Hello World!", "HELLO WORLD! HELLO!");


	echo "<br>";

	echo strtolower("HELLO woRld");


	echo strtoupper("hello world");


	echo "<br>";

	echo substr("Hello World", 6);


	echo "<br>";
	echo substr("Hello World", -2);


	echo str_replace("Bootcampers", "Batch 18 Students", "Hello Bootcampers");

























?>