<?php

namespace mod_assign\task;

class course_check_progression extends \core\task\scheduled_task {
	/**
	 * Get a descriptive name for this task (shown to admins).
	 *
	 */
	public function get_name(){
		return "Checks whether users have completed the day's activities and if so, moves them forwards a day";
	}

	public function execute(){
		//global $CFG;
		//global $DB;
		/*$sql = 'SELECT b.id, assign_count FROM (SELECT count(mapping.assignment) as assign_count, mapping.userid FROM mdl_assign_user_mapping as mapping WHERE NOT EXISTS(SELECT * FROM mdl_assign_submission as submission WHERE mapping.userid= submission.userid AND mapping.assignment = submission.assignment AND submission.status="submitted")
GROUP BY mapping.userid) as a RIGHT JOIN mdl_user as b ON a.userid = b.id';
	$assignments = $DB->get_records_sql($sql, NULL, 0, 0);
	//print_r($assignments);
	foreach($assignments as $assign){
		$assigns_left = $assign->assign_count;
		if(!$assigns_left || $assigns_left ==0){
			//print_r($assign);
			//echo "<br>";
			//echo $assign->id;
			//echo "<br>";
			$user_days = $DB->get_field("user", "icq", array('id'=>$assign->id));
			if(!$user_days){
				$user_days= 0;
			}
			//echo $user_days;
			$user_days++;
			$DB->set_field("user", "icq", $user_days, array('id'=>$assign->id));
			//$DB->set_field("user", "icq", 1, array('id'=>$assign->id));
		}
		//echo "<br>";
	}
		 */
		echo "hi";
		//require('../config.php');
		global $CFG;
		global $DB;
		echo "no";
	
		$user_sql = 'SELECT * FROM mdl_user';
       		$users = $DB->get_records_sql($user_sql, NULL, 0, 0);
		echo "maybe so";
		//echo "icq: " . $user->icq;
	foreach($users as $user){
		$data->groupa = groups_is_member(1, $user->id) ? 'yes' : 'no';//shorthand if statement
        	$data->groupb = groups_is_member(3, $user->id) ? 'yes' : 'no';
        	$data->groupc = groups_is_member(5, $user->id) ? 'yes' : 'no';
        	$data->groupd = groups_is_member(7, $user->id) ? 'yes' : 'no';
		$data->groupe = groups_is_member(9, $user->id) ? 'yes' : 'no';
		//echo $USER->id;
		print_r($data);
		$role_sql = "SELECT * FROM mdl_role_assignments WHERE userid = $user->id";
		$role = $DB->get_record_sql($role_sql);
		if(!$role){
			$role->roleid = 9;
		}
		if(!$user->icq){
			$user->icq = 1;
		}
		//$role->roleid = 9;
		echo "<br>";
 		//$user_sql = 'SELECT id, icq FROM mdl_user WHERE id = '.$USER->id;
		//$user = $DB->get_record_sql($user_sql);
		//echo "icq: " . $user->icq;
		//$user->icq = 1;
		$sql = "SELECT * FROM mdl_assign_destination as dest WHERE (dest.groupa LIKE '% 'OR dest.groupa LIKE '%$data->groupa%') AND (dest.groupb LIKE '%$data->groupb%' OR dest.groupb LIKE '% ')
        	AND (dest.groupc LIKE '%$data->groupc%' OR dest.groupc LIKE '% ') AND (dest.groupd LIKE '%$data->groupd%' OR dest.groupd LIKE '% ')
        	AND (dest.groupe LIKE '%$data->groupe%' OR dest.groupe LIKE '% ') AND dest.roleid = $role->roleid AND dest.day= $user->icq";
		$assignments = $DB->get_records_sql($sql, NULL, 0, 0);
		print_r($assignments);
		$count = 0;
		$assigns = [];
		echo "<br>";
		foreach($assignments as $assign){
			echo $count;
			if($count == 0){
				echo "in loop";
				print_r($assigns);
				print_r($assign);
				print_r($first);
				echo $count;
				echo "<br>";
				$assigns[$count] = $assign->origin;
				$count ++;
				$assigns[$count] = $assign->destination;
		 		print_r($assigns);
                        	echo $count;
			}
			else{
				echo "count not 0)";
				$count++;
				$assigns[$count] = $assign->destination;
			}
		}
		echo "<br>";
		//$assign_completion = $DB->get_records_list("mdl_course_modules_completion","coursemoduleid", $assigns);
		print_r($assign_completion);
		print_r($assigns);
		$total_count = count($assigns);
		echo "<br>";
		$arr = implode(',',$assigns);
		if($arr){
			print_r($arr);
			echo "<br>";
			$sql_modules = "SELECT coursemoduleid, userid FROM mdl_course_modules_completion WHERE coursemoduleid IN ($arr) AND userid = $user->id AND completionstate =1";
			//print_r($sql);
			$completed = $DB->get_records_sql($sql_modules, NULL, 0, 0);
			print_r($completed);
		}
		$completed_count = count($completed);
		if($total_count - $completed_count <=0){
			echo "done!";
			$user_days = $user->icq + 1;
			$DB->set_field("user", "icq", $user_days, array('id'=>$user->id));
			if($user->icq == 22){
				$admin_user = $DB->get_record("user", array('id'=>2));
				echo email_to_user($admin_user, $admin_user, "User has completed course!", "The user " . $user->firstname . ' has completed the course! Their email address is ' . $user->email);
			}
		}
	}
	}



}
