<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * user signup page.
 *
 * @package    core
 * @subpackage auth
 * @copyright  1999 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../config.php');
require_once($CFG->dirroot.'/group/lib.php');
global $USER;


$PAGE->set_context(context_system::instance());
echo $OUTPUT->header();

//$context = context_system::instance();
require_once($CFG->dirroot . '/mod/assign/locallib.php');
require_once($CFG->libdir . '/externallib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/lib/moodlelib.php');
$context = context_system::instance();
//maybe change to a different capability, but for now this is a good proxy for "has admin privileges"
require_capability('mod/assign:addinstance', $context);

//echo "hi2";
global $DB;
        //echo $DB->delete_records_select("assign_destination", "origin=35 OR origin=36");
        //echo $DB->delete_records_select("assign_destination", "TRUE");
	
	$file = fopen("/var/www/html/lib/dest/assign_destinations.txt", "r") or die("unable to open file");
	//print_r($file);
	$filez = fread($file, filesize("/var/www/html/lib/dest/assign_destinations.txt"));
	$strings = explode(PHP_EOL, $filez);
	//echo"strings:";
	//print_r($strings);
	//print_r($file);
	$DB->delete_records_select("assign_destination", "TRUE");
	$count = 0;
	foreach($strings as $str){
		//$str = '35, 37, "", "", "", "", "", true';
		$arr= explode(',', $str);
		//print_r($arr);
		//$data = stdClass();
		$data->origin = intval(trim($arr[0]));
		$data->destination = intval(trim($arr[1]));
		$data->groupa = trim($arr[2]);
		$data->groupb = trim($arr[3]);
		$data->groupc = trim($arr[4]);
		$data->groupd = trim($arr[5]);
		$data->groupe = trim($arr[6]);
		//$data->is_assign = trim($arr[7]);
		$data->day = intval(trim($arr[7]));
		$data->roleid = intval(trim($arr[8]));
		print_r($data);
		//don't need to check if the record exists if we're wiping it clean anyway
		//$a = $DB->get_record("assign_destination", get_object_vars($data));
		if(/*!$a &&*/ $data->origin){
			//echo "origin:" . $data->origin;
			//echo "<br>";
			if($DB->insert_record("assign_destination", $data)){
				$count++;
			}
		}
	}
	header("Location: /#");
	echo $count . " records updated";
	echo "<br>";
	echo '<a href="https://mindful.rc.fas.harvard.edu"><u> Return to home page</u></a>';
	//echo $DB->delete_records_select("assign_destination", "TRUE");
	//echo $DB->delete_records_select("assign_destination", "origin=35 OR origin=36";
