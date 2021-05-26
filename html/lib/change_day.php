<?php
	
	require('../config.php');
	global $USER;
	$PAGE->set_context(context_system::instance());
	echo $OUTPUT->header();

	
	$courseid = required_param('id', PARAM_INT); //change this	
	echo "<h2> This is the page for changing what day you're on in the course. It is available for testing purposes only. </h2>";
	echo "<form action=\"day_changer.php?id=$courseid\" method=\"post\">";

	echo "<label for=\"day\">Choose a day to change to: </label>
		<select name=\"day\" id=\"day\"'>
		<option value='1'> 1</option>
		<option value='2'> 2</option>
		<option value='3'> 3</option>
 		<option value='4'> 4</option>
 		<option value='5'> 5</option>
 		<option value='6'> 6</option>
 		<option value='7'> 7</option>
		<option value='8'> 8</option>
		<option value='9'> 9</option>
		<option value='10'> 10</option>
		<option value='11'> 11</option>
		<option value='12'> 12</option>
		<option value='13'> 13</option>
		<option value='14'> 14</option>
		<option value='15'> 15</option>
		<option value='16'> 16</option>
		<option value='17'> 17</option>
		<option value='18'> 18</option>
	 	<option value='19'> 19</option>
		<option value='20'> 20</option>
		<option value='21'> 21</option>
		<option value='22'> 22</option>
		</select>";
	echo "<input type='submit' value='Submit'>";
	echo "</form>";
	//$sql = 'SELECT user.icq as uedate FROM {user} user WHERE user.id = :userid';
	//$user_icq = $DB->get_field("user", "icq", array('id'=>$USER->id));
 	//echo $user_icq;
	//echo $DB->set_field("user", "icq", 1, array('confirmed'=>1));
