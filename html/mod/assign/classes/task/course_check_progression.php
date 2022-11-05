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
		
		//require('../config.php');
		global $CFG;
		global $DB;
		
	
		$user_sql = 'SELECT * FROM mdl_user WHERE deleted = 0';
       		$users = $DB->get_records_sql($user_sql, NULL, 0, 0);
		
		//echo "icq: " . $user->icq;
		foreach($users as $user){
		
			echo "<br> user id:" . $user->id;
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
				$DB->set_field("user", "icq", $user->icq, array('id'=>$user->id));
			}

			//This is the variable that makes it so the control group is not required to do any submissions
			$submissions_required = TRUE;
			if($role->roleid == 12 OR $role->roleid ==13){
				$submissions_required = FALSE;
			}

			if($submissions_required){
			//$role->roleid = 9;
			echo "<br>";
 			//$user_sql = 'SELECT id, icq FROM mdl_user WHERE id = '.$USER->id;
			//$user = $DB->get_record_sql($user_sql);
			//echo "icq: " . $user->icq;
			//$user->icq = 1;
			$sql = "SELECT * FROM mdl_assign_destination as dest WHERE (dest.groupa LIKE (CASE WHEN dest.groupa LIKE '%yes%' OR dest.groupa LIKE '%no%' THEN '%$data->groupa%' WHEN dest.groupa LIKE '%' THEN '%' END))
		               AND (dest.groupb LIKE (CASE WHEN dest.groupb LIKE '%yes%' OR dest.groupb LIKE '%no%' THEN '%$data->groupb%' WHEN dest.groupb LIKE '%' THEN '%' END))
		               AND (dest.groupc LIKE  (CASE WHEN dest.groupc LIKE '%yes%' OR dest.groupc LIKE '%no%' THEN '%$data->groupc%' WHEN dest.groupc LIKE '%' THEN '%' END))
			       AND (dest.groupd LIKE  (CASE WHEN dest.groupd LIKE '%yes%' OR dest.groupd LIKE '%no%' THEN '%$data->groupd%' WHEN dest.groupd LIKE '%' THEN '%' END))
		        AND (dest.groupe LIKE (CASE WHEN dest.groupe LIKE '%yes%' OR dest.groupe LIKE '%no%' THEN '%$data->groupe%' WHEN dest.groupe LIKE '%' THEN '%' END)) AND dest.roleid = $role->roleid AND dest.day= $user->icq";
			$assignments = $DB->get_records_sql($sql, NULL, 0, 0);
			//print_r($assignments);
			$count = 0;
			$incomplete_assigns= [];
			$assigns = [];
			$incomplete ="";
			echo "<br>";
			$completed = [];
			foreach($assignments as $assign){
			
				print_r($assign);
				$origin = $DB->get_field('course_modules', 'instance', ['id'=>$assign->origin]);
				$destination = $DB->get_field('course_modules', 'instance', ['id'=>$assign->destination]);
				$origin_no_submissions= $DB->get_field('assign', 'nosubmissions', ['id'=> $origin]);
			//	echo $assign->origin . ": submissions?" . var_dump((bool) $origin_no_submissions) . "\n";
				$dest_no_submissions= $DB->get_field('assign', 'nosubmissions', ['id'=>$destination]);
			//	echo $assign->destination . ": submissions? " . var_dump((bool) $dest_no_submissions) . "\n";
				if(!$origin_no_submissions and !array_key_exists($assign->origin, $assigns)){
			//		echo $assign->origin . ": has submissions";
					$assigns[$assign->origin] = true;
				//The query we use later uses course module ID for checking whether it's been submitted
				}
				if(!$dest_no_submissions and !array_key_exists($assign->destination, $assigns)){
			//		echo $assign->destination . ": has submissions";
					$assigns[$assign->destination] = true;
				}
				print_r($assigns);

				//echo "count: " . $count;
				//echo "origin: " .$assign->origin . " dest: " . $assign-destination;
				}
			echo "done adding";
			print_r($assigns);
			$assigns = array_keys($assigns);
			echo "<br>";
			//$assign_completion = $DB->get_records_list("mdl_course_modules_completion","coursemoduleid", $assigns);
			print_r($assign_completion);
			print_r($assigns);
			$total_count = count($assigns);
			echo "<br>";
			$arr = implode(',',$assigns);
			echo "imploded \n";
			print_r($arr);
			if($arr){
				echo "this: ";
				print_r($arr);
				echo "<br>";
				$sql_modules = "SELECT coursemoduleid, userid FROM mdl_course_modules_completion WHERE coursemoduleid IN ($arr) AND userid = $user->id AND completionstate =1";
				//print_r($sql);
				$completed = $DB->get_records_sql($sql_modules, NULL, 0, 0);
				print_r($completed);
				$completed = array_keys($completed);
			}
			echo "completed: ";
			print_r($completed);
			$completed_count = count($completed);
			$incomplete_assigns = array_diff($assigns, $completed);	
			echo "total: " .$total_count;
			echo "completed: " .$completed_count; 
			}
			$admin_sql = "SELECT * FROM mdl_config WHERE name ='siteadmins'";
			$admin_users = $DB->get_record_sql($admin_sql);
			$admin_ids = explode(",", $admin_users->value);
			print_r($admin_ids);
			print_r($admin_users);
			//this is the admin account that is used for automated emailing
			$admin_user = $DB->get_record("user", array('id'=>2));
			if($total_count - $completed_count <=0 OR !$submissions_required){
				echo "done!";
				$user_days = $user->icq + 1;
				if($user_days > 22){
					echo "user done with course";
					continue;
				}
				$DB->set_field("user", "icq", $user_days, array('id'=>$user->id));
				$DB->set_field("user", "skype", 0, array('id'=>$user->id));
				if($user_days == 22){
					foreach($admin_ids as $admins){
				
					$admin_u = $DB->get_record("user", array('id'=>$admins));
					print_r($admin_user);
					echo email_to_user($admin_u, $admin_u, "User has completed course!", "The user " . $user->firstname . ' has completed the course! Their email address is ' . $user->email);
						
					}
				}
				else{
				$emails = array(1=> "Here is your daily reminder to check out today's cool new exercises at http://mindful.rc.fas.harvard.edu! See you there!",
					2=> "Come visit http://mindful.rc.fas.harvard.edu to see today's mindfulness exercises.",
					3=> "There is new content available at http://mindful.rc.fas.harvard.edu, come check it out.",        );
				
				$admin_user = $DB->get_record("user", array('id'=>2));
				$num = rand(1,3);
				echo "emailing to email address " . $user->email . "for user " .  $user->firstname . "  ". $user->id . " the following message: ";
				echo $emails[$num];
				echo email_to_user($user, $admin_user, "Daily Exercises available for " . $user->username, $emails[$num]);
			}
		}
		else{
			if($user->icq < 22){
				$incomplete = "";
				//Make sure the below field is uncommented on production
				$DB->set_field("user", "skype", $user->skype + 1, array('id'=>$user->id));
				print_r($assigns);
				if($user->skype == 2){
					echo "user has been inactive for 3 days";
					print_r($admin_ids);
					foreach($admin_ids as $admins){
						$admin_u = $DB->get_record("user", array('id'=>$admins));
						print_r($admin_u);
						echo email_to_user($admin_u, $admin_u, "User hasn't done exercises in 3 days!", "The user " . $user->username . ' has not progressed for 3 days in a row. Their email address is ' . $user->email); 
					}
				}
				elseif($user->skype > 3){
					echo "user has been inactive more than 3 days: " . $user->firstname;
					continue;
				}
				foreach($incomplete_assigns as $inc){

					if(strlen($incomplete) > 0){
						$incomplete .= ", ";
					}
					//echo $incomplete;
					$incomplete .="https://mindful.rc.fas.harvard.edu/mod/assign/view.php?id=" . $inc;
				}	
				echo "incomplete links: " . $incomplete;
				$emails = array(1=> "Hey, did you forget to do your mindfulness exercises at https://mindful.rc.fas.harvard.edu yesterday?",
					2=>"Here's yesterday's mindfuless exercises that you missed: " . $incomplete . ". You should check them out."
				);
				$num = rand(1,2);
				 echo "emailing to email address " . $user->email . "for user " .  $user->firstname . "  ". $user->id . " the following message: ";
				echo $emails[$num];
				echo email_to_user($user, $admin_user, "Mindfulness reminder for " . $user->username, $emails[$num]);
			}
		}
		
	}	
 
	}
}
