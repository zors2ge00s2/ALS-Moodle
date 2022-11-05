<?php
	echo "hi1";
	require('../config.php');
	global $CFG;
	global $DB;
	global $USER;
	echo "hi2";
	//require_once($CFG->dirroot .'config.php');
	//require_once($CFG->dirroot . '/course/lib.php');
	echo "hi";
	print_r("hi");
	//$sql = 'SELECT * FROM mdl_assign_user_mapping as mapping WHERE NOT EXISTS(SELECT * FROM mdl_assign_submission as submission WHERE mapping.userid= submission.userid AND mapping.assignment = submission.assignment AND submission.status="submitted") ORDER BY mapping.assignment, mapping.userid;';
	//$sql = 'SELECT b.id, assign_count FROM (SELECT count(mapping.assignment) as assign_count, mapping.userid FROM mdl_assign_user_mapping as mapping WHERE NOT EXISTS(SELECT * FROM mdl_assign_submission as submission WHERE mapping.userid= submission.userid AND mapping.assignment = submission.assignment AND submission.status="submitted") 
	//GROUP BY mapping.userid) as a RIGHT JOIN mdl_user as b ON a.userid = b.id';
	//$user_sql = 'SELECT id, icq FROM mdl_user WHERE id = 14';//. $USER->id
        //$user = $DB->get_record_sql($user_sql);
        //echo "icq: " . $user->icq;
        //$user->icq = 2;
	 $sql = "SELECT * FROM mdl_user";
        $users = $DB->get_records_sql($sql, NULL, 0, 0);
	
	echo "icq: " . $users->icq;
        foreach($users as $user){
	//$user_sql = 'SELECT id, icq FROM mdl_user WHERE id = 14';//. $USER->id
        //$user = $DB->get_record_sql($user_sql);
		print_r("here");
		echo "icq: " . $user->icq;
	$data->groupa = groups_is_member(1, $user->id) ? 'yes' : 'no';//shorthand if statement
        $data->groupb = groups_is_member(3, $user->id) ? 'yes' : 'no';
        $data->groupc = groups_is_member(5, $user->id) ? 'yes' : 'no';
        $data->groupd = groups_is_member(7, $user->id) ? 'yes' : 'no';
	$data->groupe = groups_is_member(9, $user->id) ? 'yes' : 'no';
	//echo $USER->id;
	//print_r($users);
	//print_r($data);
	$role_sql = "SELECT * FROM mdl_role_assignments WHERE userid = $user->id";
	$role = $DB->get_record_sql($role_sql);
	//echo "role: ". $role;
	//print_r($data);
	if(!$role){
		$role->roleid = 9;
	}
	//$role->roleid = 9;
	echo "<br>";
 	//$user_sql = 'SELECT id, icq FROM mdl_user WHERE id = '.$USER->id;
	//$user = $DB->get_record_sql($user_sql);
	//echo "icq: " . $user->icq;
	//$user->icq = 1;	
	//$sql = "SELECT * FROM mdl_assign_destination as dest WHERE (dest.groupa LIKE '% 'OR dest.groupa LIKE '%$data->groupa%') AND (dest.groupb LIKE '%$data->groupb%' OR dest.groupb LIKE '% ')
        //AND (dest.groupc LIKE '%$data->groupc%' OR dest.groupc LIKE '% ') AND (dest.groupd LIKE '%$data->groupd%' OR dest.groupd LIKE '% ')
	//AND (dest.groupe LIKE '%$data->groupe%' OR dest.groupe LIKE '% ') AND dest.roleid = $role->roleid AND dest.day= $user->icq";
	$sql =  "SELECT * FROM mdl_assign_destination as dest WHERE (dest.groupa LIKE (CASE WHEN dest.groupa LIKE '%yes%' OR dest.groupa LIKE '%no%' THEN '%$data->groupa%' WHEN dest.groupa LIKE '%' THEN '%' END))                                                                                                                                                                                                  AND (dest.groupb LIKE (CASE WHEN dest.groupb LIKE '%yes%' OR dest.groupb LIKE '%no%' THEN '%$data->groupb%' WHEN dest.groupb LIKE '%' THEN '%' END))                                               AND (dest.groupc LIKE  (CASE WHEN dest.groupc LIKE '%yes%' OR dest.groupc LIKE '%no%' THEN '%$data->groupc%' WHEN dest.groupc LIKE '%' THEN '%' END))                                              AND (dest.groupd LIKE  (CASE WHEN dest.groupd LIKE '%yes%' OR dest.groupd LIKE '%no%' THEN '%$data->groupd%' WHEN dest.groupd LIKE '%' THEN '%' END))                                       AND (dest.groupe LIKE (CASE WHEN dest.groupe LIKE '%yes%' OR dest.groupe LIKE '%no%' THEN '%$data->groupe%' WHEN dest.groupe LIKE '%' THEN '%' END)) AND dest.roleid = $role->roleid AND dest.day= $user->icq";  
	$assignments = $DB->get_records_sql($sql, NULL, 0, 0);
	//var_dump($assignments);
	echo "user id: ". $user->id;
	echo "<br>";
	print_r($sql);
	echo "<br>";
	$count = 0;
	$assigns = [];
	echo "<br>";
	foreach($assignments as $assign){
		//$assigns_left = $assign->assign_count;
		echo $count;
		if($count == 0){
			echo "in loop";
			print_r($assigns);
			print_r($assign);
			//$sql = "SELECT * FROM 'mdl_course_modules_completion' WHERE coursemoduleid = $assign->origin";
			//$first = $DB->get_record_sql($sql);
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
		//$DB->set_field("user", "icq", $user_days, array('id'=>$user->id));
	}
	}
//$sql_user = "SELECT id FROM mdl_user";
	//$users = $DB->get_records_sql($sql_user, NULL, 0, 0);
	 /* foreach($users as $user){
                print_r($user);
                echo "<br>";
        }
	  */
	//echo "computed";
