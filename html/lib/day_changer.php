<?php
	require('../config.php');

	$day = $_POST["day"];
	//echo $day;

	global $USER;
	//echo "<br>";
	//echo $USER->id;
	$DB->set_field("user", "icq", $day, array('id'=>$USER->id));
	$curr_user = $DB->get_record("user", array('id'=>$USER->id));
	//echo print_r($curr_user);
	
	header("Location: /");
?>
