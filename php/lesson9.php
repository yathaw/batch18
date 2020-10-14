<?php 
	
	echo "<h1> Date </h1>";

	echo "Today is ".date('Y-m-d')."<br>";

	echo "Today is ".date('Y.m.d')."<br>";

	echo "Today is ".date('d m y')."<br>";

	echo "Today is ".date('d M y')."<br>";

	echo "Today is ".date('D m y')."<br>";

	echo "Today is ".date('D')."<br>";

	echo "Today is ".date('l')."<br>";

	echo "<br> <hr>";

	echo "<h1> Time </h1>";

	echo "Time is ".date("h:i:sa");

	echo "<br>";

	date_default_timezone_set("Asia/Rangoon");

	echo "Yangon Time is ".date("h:i:sa");

	echo "<br> <hr>";

	echo "<h1> strtotime </h1>";

	$today = strtotime('today');
	echo "Today is ".date('M d, Y', $today)."<br>";

	$tomorrow = strtotime('tomorrow');
	echo "Tomorrow is ".date('M d, Y', $tomorrow)."<br>";

	$comingSaturday = strtotime('next Saturday');
	echo "Coming Saturday is ".date('M d, Y',$comingSaturday)."<br>";


	$nexttwoWeek = strtotime('+2 weeks');
	echo "Next Two Week is ".date('M d, Y',$nexttwoWeek)."<br>";


	$after3Months = strtotime('+3 months');
	echo "3 Months Later ".date('M d, Y',$after3Months)."<br>";


	$next1WeekSaturday = strtotime('next saturday +1 week');
	echo "Next 1 Week Saturday is ".date('M d, Y',$next1WeekSaturday)."<br>";














?>