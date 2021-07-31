<?php
	require_once('../config.php');
	$context = context_system::instance();
	require_capability('mod/assign:addinstance', $context);
	//$url = 'https://mindful.rc.fas.harvard.edu/lib/update_introduction.php';
	$day = $_GET['day'];
	//echo $day;
	//echo $OUTPUT->header();
	if(!$day){
		$day =1;
	}
	$day = trim($day);
	$url ='https://mindful.rc.fas.harvard.edu/lib/update_introduction.php?day=' . $day;
	$file = '/var/www/html/lib/daily_posts/day_'. $day . '_introduction.txt';
	//$test = $_POST['text'];
	//print_r($test);
	if (isset($_POST['text'])){
		echo "POSTED";
		//save the text contents
		$a = file_put_contents($file, $_POST['text']);
		//redirect to form again
		//print_r($a);
		//echo "\n";
		//print_r($file);	
		header(sprintf('Location: %s', $url));
		printf('<a href="%s"> Updated</a>.', htmlspecialchars($url));
		exit();
	}
	$text = file_get_contents($file);
	
	echo "<form action=\"update_introduction.php?id=$day\" method=\"get\">";
	echo "<label for=\"day\">Choose a day to edit the introduction for: </label>
	<select name=\"day\" id=\"day\">
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
	<option value='1_control'> 1 control</option>
	<option value='2_control'> 2 control</option>
	<option value='3_control'> 3 control</option>
	<option value='4_control'> 4 control</option>
	<option value='5_control'> 5 control</option>
	<option value='6_control'> 6 control</option>
	<option value='7_control'> 7 control</option>
	<option value='8_control'> 8 control</option>
	<option value='9_control'> 9 control</option>
	<option value='10_control'> 10 control</option>
	<option value='11_control'> 11 control</option>
	<option value='12_control'> 12 control</option>
	<option value='13_control'> 13 control</option>
	<option value='14_control'> 14 control</option>
	<option value='15_control'> 15 control</option>
	<option value='16_control'> 16 control</option>
	<option value='17_control'> 17 control</option>
	<option value='18_control'> 18 control</option>
	<option value='19_control'> 19 control</option>
	<option value='20_control'> 20 control</option>
	<option value='21_control'> 21 control</option>
	</select>";
		echo "<input type='submit' value='Choose day'>";
		echo "</form>";
?>

<!-- HTML form -->
<form action="" method="post">
<textarea name="text" style="width: 50%; height: 500px;">
<?php echo htmlspecialchars($text) ?>
</textarea>
<input type="submit" />
<input type="reset" />
</form>
<a href="/"> Return home</a>
<?php
		echo "<br><h2>Preview:</h2>";
		
		echo $text;

