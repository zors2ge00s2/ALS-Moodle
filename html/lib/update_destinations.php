<?php
require_once('../config.php');
$context = context_system::instance();
//maybe change to a different capability, but for now this is a good proxy for "has admin privileges"
require_capability('mod/assign:addinstance', $context);
// configuration
$url = 'https://mindful.rc.fas.harvard.edu/lib/update_destinations.php';
$file = '/var/www/html/lib/dest/assign_destinations.txt';

// check if form has been submitted
$test = $_POST['text'];
echo $test;
echo "<br>";
echo var_dump($_POST);
if (isset($_POST['text']))
{
    // save the text contents
	$a = file_put_contents($file, $_POST['text']);
    // redirect to form again
    header(sprintf('Location: %s', $url));
    printf('<a href="%s">Updated</a>.', htmlspecialchars($url));
    exit();
}

// read the textfile
$text = file_get_contents($file);

?>
origin, destination, Bulbar Involvement Y/N, Upper Limb Impairment Y/N, Wheelchair Y/N, Cane/Walker Y/N, Non-invasive Ventilation Y/N, day, role
<!-- HTML form -->
<form action="" method="post">
<textarea name="text" style="width: 50%; height:75%;"><?php echo htmlspecialchars($text) ?></textarea>
<input type="submit" />
<input type="reset" />
</form>
The button below will update the linking of the assignments, click it sparingly and only once you're done editing and have already submitted.
<br>
<a href="https://mindful.rc.fas.harvard.edu/lib/upload_destinations.php">Press to upload </a>
