<?php
namespace mod_assign\task;
defined('MOODLE_INTERNAL') || die();
use \Datetime;
/**
 * A schedule task for assignment cron.
 *
 * @package   mod_assign
 * @copyright 2019 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class fresh_assign_cron extends \core\task\scheduled_task {
    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */


    public function get_name() {
        return 'Checks whether users have new available assignments and triggers an event if they do';
    }

    /**
     * Run assignment cron.
     */
    public function execute() {
        global $CFG;
	global $DB;

echo "hi";
//$PAGE->set_context(context_system::instance());
//require_once($CFG-dirroot . 'config.php');
//$context = context_system::instance();
echo "hi";
require_once($CFG->dirroot . '/mod/assign/locallib.php');
echo "hi3";
require_once($CFG->libdir . '/externallib.php');
echo "$CFG->dirroot";
require_once($CFG->dirroot . '/course/lib.php');
echo "hi5";
//require_once($CFG->dirroot . '/lib/moodlelib.php');
echo "hi";
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
	$sql = "SELECT user.id, user.email, user.firstaccess, user.username, user.firstname FROM mdl_user as user, mdl_role_assignments as role_assign WHERE user.id = role_assign.userid AND (role_assign.roleid = 9 OR role_assign.roleid = 10)";
	$users = $DB->get_records_sql($sql, NULL, 0, 0);
	foreach($users as $user){
		$enrolldate = new DateTime(date('Y-m-d', $user-> firstaccess));
		$currdate = new DateTime(date('Y-m-d', time()));
		$interval = date_diff($enrolldate, $currdate);
		$days = $interval->format('%a');
		$days += 1;
		
		if ($days <= 21){
			print_r($user);
			echo "<br>";
			$num = rand(1,3);
			
			//if($user->id == 14){
			//	echo "num: " . $num;
			//	echo "<br>";
			//	echo $emails[$num];
				//echo email_to_user($user, $admin_user, "Daily Exercises available", $emails[$num]);
			//	echo "<br>";
			//}	
		}
	}
	
	
	//$event = \mod_assign\event\new_assign_shown::create($params);
	//$event->trigger();      

        return true;
    }
}

