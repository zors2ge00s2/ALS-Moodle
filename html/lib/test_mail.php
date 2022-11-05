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
echo "hi1";
require_once($CFG->dirroot . '/mod/assign/locallib.php');
require_once($CFG->libdir . '/externallib.php');
require_once($CFG->libdir . '/editlib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/lib/moodlelib.php');
echo "hi2";
global $DB;
$courseid = 13;
        $context = \context_module::instance($courseid);
        echo print_r($context);
        $params = array(
                'userid' => 2,
                'context' => $context,
                'objectid' => 1,
	);
	echo "hi2";
	$admin_user = $DB->get_record("user", array('id'=>2));
	echo "hi";
	$emails = array(1=> "Here is your daily reminder to check out today's cool new exercises at http://mindful.rc.fas.harvard.edu! See you there!", 
			 2=> "Come visit http://mindful.rc.fas.harvard.edu to see today's mindfulness exercises.",
			 3=> "There is new content available at http://mindful.rc.fas.harvard.edu, come check it out.",
	); 
	//$sql = "SELECT user.id, user.email, user.firstaccess, user.username, user.firstname FROM mdl_user as user, mdl_role_assignments as role_assign WHERE user.id = role_assign.userid AND (role_assign.roleid = 9 OR role_assign.roleid = 10)";
	//$users = $DB->get_records_sql($sql, NULL, 0, 0);
	/*foreach($users as $user){
		$enrolldate = new DateTime(date('Y-m-d', $user-> firstaccess));
		$currdate = new DateTime(date('Y-m-d', time()));
		$interval = date_diff($enrolldate, $currdate);
		$days = $interval->format('%a');
		$days += 1;
		
		if ($days <= 21){
			print_r($user);
			echo "<br>";
			$num = rand(1,3);
			
			if($user->id == 14){
				echo "num: " . $num;
				echo "<br>";
				echo $emails[$num];
				echo email_to_user($user, $admin_user, "Daily Exercises available", $emails[$num]);
			}	
		}
	}
	
	 */
	$str = '35, 37, "", "", "", "", "", true';
	$arr= explode(',', $str);
	print_r($arr);
	//$data = stdClass();
	$data->origin = $arr[0];
	$data->destination = $arr[1];
	$data->groupa = $arr[2];
	$data->groupb = $arr[3];
	$data->groupc = $arr[4];
	$data->groupd = $arr[5];
	$data->groupe = $arr[6];
	$data->is_assign = $arr[7];
	//print_r($data);
	//echo $DB->insert_record("assign_destination", $data);
	//print_r(getenv('MOODLE_URL'));
	echo '<br>';
	print_r(useredit_get_required_name_fields());
	$namefields = array_diff(get_all_user_name_fields(), useredit_get_required_name_fields());
	echo '<br>';
	print_r($namefields);
	echo '<br>';
	print_r($CFG->fullnamedisplay);
