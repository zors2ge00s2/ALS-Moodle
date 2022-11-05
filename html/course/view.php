<?php

//  Display the course home page.

    require_once('../config.php');
    require_once('lib.php');
    require_once($CFG->libdir.'/completionlib.php');
    require_once($CFG->dirroot.'/group/lib.php');
    
    $id          = optional_param('id', 0, PARAM_INT);
    $name        = optional_param('name', '', PARAM_TEXT);
    $edit        = optional_param('edit', -1, PARAM_BOOL);
    $hide        = optional_param('hide', 0, PARAM_INT);
    $show        = optional_param('show', 0, PARAM_INT);
    $idnumber    = optional_param('idnumber', '', PARAM_RAW);
    $sectionid   = optional_param('sectionid', 0, PARAM_INT);
    $section     = optional_param('section', 0, PARAM_INT);
    $move        = optional_param('move', 0, PARAM_INT);
    $marker      = optional_param('marker',-1 , PARAM_INT);
    $switchrole  = optional_param('switchrole',-1, PARAM_INT); // Deprecated, use course/switchrole.php instead.
    $return      = optional_param('return', 0, PARAM_LOCALURL);

    $params = array();
    if (!empty($name)) {
        $params = array('shortname' => $name);
    } else if (!empty($idnumber)) {
        $params = array('idnumber' => $idnumber);
    } else if (!empty($id)) {
        $params = array('id' => $id);
    }else {
        print_error('unspecifycourseid', 'error');
    }

    $course = $DB->get_record('course', $params, '*', MUST_EXIST);

    $urlparams = array('id' => $course->id);

    // Sectionid should get priority over section number
    if ($sectionid) {
        $section = $DB->get_field('course_sections', 'section', array('id' => $sectionid, 'course' => $course->id), MUST_EXIST);
    }
    if ($section) {
        $urlparams['section'] = $section;
    }

    $PAGE->set_url('/course/view.php', $urlparams); // Defined here to avoid notices on errors etc

    // Prevent caching of this page to stop confusion when changing page after making AJAX changes
    $PAGE->set_cacheable(false);

    context_helper::preload_course($course->id);
    $context = context_course::instance($course->id, MUST_EXIST);

    // Remove any switched roles before checking login
    if ($switchrole == 0 && confirm_sesskey()) {
        role_switch($switchrole, $context);
    }

    require_login($course);

    // Switchrole - sanity check in cost-order...
    $reset_user_allowed_editing = false;
    if ($switchrole > 0 && confirm_sesskey() &&
        has_capability('moodle/role:switchroles', $context)) {
        // is this role assignable in this context?
        // inquiring minds want to know...
        $aroles = get_switchable_roles($context);
        if (is_array($aroles) && isset($aroles[$switchrole])) {
            role_switch($switchrole, $context);
            // Double check that this role is allowed here
            require_login($course);
        }
        // reset course page state - this prevents some weird problems ;-)
        $USER->activitycopy = false;
        $USER->activitycopycourse = NULL;
        unset($USER->activitycopyname);
        unset($SESSION->modform);
        $USER->editing = 0;
        $reset_user_allowed_editing = true;
    }

    //If course is hosted on an external server, redirect to corresponding
    //url with appropriate authentication attached as parameter
    if (file_exists($CFG->dirroot .'/course/externservercourse.php')) {
        include $CFG->dirroot .'/course/externservercourse.php';
        if (function_exists('extern_server_course')) {
            if ($extern_url = extern_server_course($course)) {
                redirect($extern_url);
            }
        }
    }


    require_once($CFG->dirroot.'/calendar/lib.php');    /// This is after login because it needs $USER

    // Must set layout before gettting section info. See MDL-47555.
    $PAGE->set_pagelayout('course');

    if ($section and $section > 0) {

        // Get section details and check it exists.
        $modinfo = get_fast_modinfo($course);
        $coursesections = $modinfo->get_section_info($section, MUST_EXIST);

        // Check user is allowed to see it.
        if (!$coursesections->uservisible) {
            // Check if coursesection has conditions affecting availability and if
            // so, output availability info.
            if ($coursesections->visible && $coursesections->availableinfo) {
                $sectionname     = get_section_name($course, $coursesections);
                $message = get_string('notavailablecourse', '', $sectionname);
                redirect(course_get_url($course), $message, null, \core\output\notification::NOTIFY_ERROR);
            } else {
                // Note: We actually already know they don't have this capability
                // or uservisible would have been true; this is just to get the
                // correct error message shown.
                require_capability('moodle/course:viewhiddensections', $context);
            }
        }
    }

    // Fix course format if it is no longer installed
    $course->format = course_get_format($course)->get_format();

    $PAGE->set_pagetype('course-view-' . $course->format);
    $PAGE->set_other_editing_capability('moodle/course:update');
    $PAGE->set_other_editing_capability('moodle/course:manageactivities');
    $PAGE->set_other_editing_capability('moodle/course:activityvisibility');
    if (course_format_uses_sections($course->format)) {
        $PAGE->set_other_editing_capability('moodle/course:sectionvisibility');
        $PAGE->set_other_editing_capability('moodle/course:movesections');
    }

    // Preload course format renderer before output starts.
    // This is a little hacky but necessary since
    // format.php is not included until after output starts
    if (file_exists($CFG->dirroot.'/course/format/'.$course->format.'/renderer.php')) {
        require_once($CFG->dirroot.'/course/format/'.$course->format.'/renderer.php');
        if (class_exists('format_'.$course->format.'_renderer')) {
            // call get_renderer only if renderer is defined in format plugin
            // otherwise an exception would be thrown
            $PAGE->get_renderer('format_'. $course->format);
        }
    }

    if ($reset_user_allowed_editing) {
        // ugly hack
        unset($PAGE->_user_allowed_editing);
    }

    if (!isset($USER->editing)) {
        $USER->editing = 0;
    }
    if ($PAGE->user_allowed_editing()) {
        if (($edit == 1) and confirm_sesskey()) {
            $USER->editing = 1;
            // Redirect to site root if Editing is toggled on frontpage
            if ($course->id == SITEID) {
                redirect($CFG->wwwroot .'/?redirect=0');
            } else if (!empty($return)) {
                redirect($CFG->wwwroot . $return);
            } else {
                $url = new moodle_url($PAGE->url, array('notifyeditingon' => 1));
                redirect($url);
            }
        } else if (($edit == 0) and confirm_sesskey()) {
            $USER->editing = 0;
            if(!empty($USER->activitycopy) && $USER->activitycopycourse == $course->id) {
                $USER->activitycopy       = false;
                $USER->activitycopycourse = NULL;
            }
            // Redirect to site root if Editing is toggled on frontpage
            if ($course->id == SITEID) {
                redirect($CFG->wwwroot .'/?redirect=0');
            } else if (!empty($return)) {
                redirect($CFG->wwwroot . $return);
            } else {
                redirect($PAGE->url);
            }
        }

        if (has_capability('moodle/course:sectionvisibility', $context)) {
            if ($hide && confirm_sesskey()) {
                set_section_visible($course->id, $hide, '0');
                redirect($PAGE->url);
            }

            if ($show && confirm_sesskey()) {
                set_section_visible($course->id, $show, '1');
                redirect($PAGE->url);
            }
        }

        if (!empty($section) && !empty($move) &&
                has_capability('moodle/course:movesections', $context) && confirm_sesskey()) {
            $destsection = $section + $move;
            if (move_section_to($course, $section, $destsection)) {
                if ($course->id == SITEID) {
                    redirect($CFG->wwwroot . '/?redirect=0');
                } else {
                    redirect(course_get_url($course));
                }
            } else {
                echo $OUTPUT->notification('An error occurred while moving a section');
            }
        }
    } else {
        $USER->editing = 0;
    }

    $SESSION->fromdiscussion = $PAGE->url->out(false);


    if ($course->id == SITEID) {
        // This course is not a real course.
        redirect($CFG->wwwroot .'/');
    }

    $completion = new completion_info($course);
    if ($completion->is_enabled()) {
        $PAGE->requires->string_for_js('completion-alt-manual-y', 'completion');
        $PAGE->requires->string_for_js('completion-alt-manual-n', 'completion');

        $PAGE->requires->js_init_call('M.core_completion.init');
    }

    // We are currently keeping the button here from 1.x to help new teachers figure out
    // what to do, even though the link also appears in the course admin block.  It also
    // means you can back out of a situation where you removed the admin block. :)
    if ($PAGE->user_allowed_editing()) {
        $buttons = $OUTPUT->edit_button($PAGE->url);
        $PAGE->set_button($buttons);
    }

    // If viewing a section, make the title more specific
    if ($section and $section > 0 and course_format_uses_sections($course->format)) {
        $sectionname = get_string('sectionname', "format_$course->format");
        $sectiontitle = get_section_name($course, $section);
        $PAGE->set_title(get_string('coursesectiontitle', 'moodle', array('course' => $course->fullname, 'sectiontitle' => $sectiontitle, 'sectionname' => $sectionname)));
    } else {
        $PAGE->set_title(get_string('coursetitle', 'moodle', array('course' => $course->fullname)));
    }

    $PAGE->set_heading($course->fullname);
    echo $OUTPUT->header();

    if ($USER->editing == 1) {

        // MDL-65321 The backup libraries are quite heavy, only require the bare minimum.
        require_once($CFG->dirroot . '/backup/util/helper/async_helper.class.php');

        if (async_helper::is_async_pending($id, 'course', 'backup')) {
            echo $OUTPUT->notification(get_string('pendingasyncedit', 'backup'), 'warning');
        }
    }

    if ($completion->is_enabled()) {
        // This value tracks whether there has been a dynamic change to the page.
        // It is used so that if a user does this - (a) set some tickmarks, (b)
        // go to another page, (c) clicks Back button - the page will
        // automatically reload. Otherwise it would start with the wrong tick
        // values.
        echo html_writer::start_tag('form', array('action'=>'.', 'method'=>'get'));
        echo html_writer::start_tag('div');
        echo html_writer::empty_tag('input', array('type'=>'hidden', 'id'=>'completion_dynamic_change', 'name'=>'completion_dynamic_change', 'value'=>'0'));
        echo html_writer::end_tag('div');
        echo html_writer::end_tag('form');
    }

    // Course wrapper start.
    echo html_writer::start_tag('div', array('class'=>'course-content'));

    // make sure that section 0 exists (this function will create one if it is missing)
    course_create_sections_if_missing($course, 0);

    // get information about course modules and existing module types
    // format.php in course formats may rely on presence of these variables
    $modinfo = get_fast_modinfo($course);
    $modnames = get_module_types_names();
    $modnamesplural = get_module_types_names(true);
    $modnamesused = $modinfo->get_used_module_names();
    $mods = $modinfo->get_cms();
    $sections = $modinfo->get_section_info_all();

   //if(!has_capability('report/customsql:view', $context){ 
    //echo "<p>"; 
        //require($CFG->libdir.'/counter.php');
    //echo "<p> $greeting </p>";
    	$sql_param = array('userid' => $USER->id);
	$sql = "SELECT ue.id, e.courseid, ue.timestart
                FROM {enrol} e
                JOIN {user_enrolments} ue ON (ue.enrolid = e.id AND ue.userid = :userid)";
	//$enrolments = $DB->get_records_sql($sql, $sql_param, 0, 0);
	//echo array_values($enrolments)[0]->timestart;
	//$enrolldate = new DateTime(date('Y-m-d', array_values($enrolments)[0]->timestart));
	//$currdate =  new DateTime(date('Y-m-d', time()));
	//$interval = date_diff($enrolldate, $currdate);
	//$days= $interval->format('%a');
  	//$days += 1;
	$days = $DB->get_field("user", "icq", array('id'=>$USER->id));
	$roleid = $DB->get_field("role_assignments", "roleid", array('id'=>$USER->id));
	if(!$days){
		$days = 1;
	}
	if($roleid == 12 || $roleid == 13){
		$days .= "_control";
	}
//	print_r($roleid);
//	echo $days;
    	//$days = "8"; 
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
	if (($days %100) >= 11 && ($days%100) <= 13)
   		$abbreviation = $days. 'th';
	else
        	$abbreviation = $days. $ends[$days % 10];
	//echo $abbreviation;
	$arr = array(
        	1 => "Welcome to your $abbreviation day of our Mindfulness program!",
      	 	//2 => "Greetings, hope you're excited for your $abbreviation day of Mindfulness!",
      	 	//3 => "There's some great exercises lined up for your $abbreviation day of Mindfulness!",
	);
	$greeting = file_get_contents('http://mindful.rc.fas.harvard.edu/lib/daily_posts/day_'. $days .'_exercises.txt');
	if($greeting){
		//echo "<h3>" . $greeting . "</h3>";
		echo "<br>";
	}
	else{
		$greeting = $arr[1];
		//echo "<h3>" . $greeting . "</h3>";
                echo "<br>";

	}

	 
//	$sql = "SELECT u.id, u.confirmed FROM {user} u WHERE u.id = :userid";
//	$usr = $DB->get_record_sql($sql, $sql_param, 0, 0);
	//if($usr->confirmed== 0){
	//	echo "Please check your email for an account confirmation email and click on the confirmation link in it. Thanks!";
	//	echo "<br><br>";
	//}
   //}	
    //echo $days;
	
    if(!groups_is_member(1, $USER->id) && !groups_is_member(2, $USER->id)){
        //echo "<a class='pref-link' href='/lib/pref.php?id=$course->id'><u> Please click here to set your activity preferences</u> </a>";
   	
    }
	
    // CAUTION, hacky fundamental variable defintion to follow!
    // Note that because of the way course fromats are constructed though
    // inclusion we pass parameters around this way..
   // if(has_capability('mod/assign:addinstance', $context) /*|| (groups_is_member(1, $USER->id) || groups_is_member(2, $USER->id))*/){
    
    $displaysection = $section;

    // Include the actual course format.
    require($CFG->dirroot .'/course/format/'. $course->format .'/format.php');
    // Content wrapper end.
    //}
    if($days<21){
	    echo "Thank you and see you tomorrow!";	    
    }
    if($days ==21){
	echo "<p>Thank you for participating in this three-week program. We hope you have enjoyed it. Next, we will contact you to fill out surveys and to introduce you to the social community part of the program. If you do not hear from a member of the research team
    within two days please contact either Dr. Deborah Phillips at <a href=\"mailto:dphillips@fas.harvard.edu\">dphillips@fas.harvard.edu</a> or Dr. Francesco Pagnini at <a href=\"mailto:Francesco.pagnini@unicatt.it\">Francesco.pagnini@unicatt.it</a>. They
    will get you started on the next part of the program!</p>
<p dir=\"ltr\" style=\"text-align: left;\"><br></p>";
    }
    echo "<br>";
    //echo "<a class='pref-link' href='/lib/change_day.php?id=$course->id'><u> TESTERS CHANGE DAY</u> </a>";
    //echo "<a style=\"background-color:white; padding: 1em 1em; border-radius:8px;\" href=\"/lib/change_day.php?id=$course->id\"> TESTERS CHANGE DAY </a>";
    echo html_writer::end_tag('div');

    // Trigger course viewed event.
    // We don't trust $context here. Course format inclusion above executes in the global space. We can't assume
    // anything after that point.
    course_view(context_course::instance($course->id), $section);

    // Include course AJAX
    include_course_ajax($course, $modnamesused);

    echo $OUTPUT->footer();
