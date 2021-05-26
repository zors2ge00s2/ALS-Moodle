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
global $USER;


//echo $OUTPUT->header();
$PAGE->set_context(context_system::instance());

$params = array('userid' => $USER->id);
$sql = "SELECT ue.id, e.courseid, ue.timestart
                FROM {enrol} e
                JOIN {user_enrolments} ue ON (ue.enrolid = e.id AND ue.userid = :userid)";
$enrolments = $DB->get_records_sql($sql, $params, 0, 0);
$enrolldate = date_create(date('Y-m-d', array_values($enrolments)[0]->timestart));
//echo "<br>";
$currdate =  date_create(date('Y-m-d', time()));
$interval = date_diff($enrolldate, $currdate);
$days= $interval->format('%a');
$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($days %100) >= 11 && ($days%100) <= 13)
   $abbreviation = $days. 'th';
else
	$abbreviation = $days. $ends[$days % 10];
//echo $abbreviation;
$arr = array(
	1 => "Welcome to your $abbreviation day of Mindfulness!",
	2 => "Greetings, hope you're excited for your $abbreviation day of Mindfulness!",
	3 => "There's some great exercises lined up for your $abbreviation day of Mindfulness!",
);
$greeting = $arr[array_rand($arr)];
echo $greeting;

?>
