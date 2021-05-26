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
$courseid = required_param('id', PARAM_INT);
echo $OUTPUT->header();

$checked = array();
$groups = groups_get_all_groups($courseid);
foreach($groups as $group){
    if(groups_is_member($group->id, $USER->id)){
        $checked[$group->id]= "checked";

    }
    else{
        $checked[$group->id]="";
    }
}

echo "<h2>Please select the focus of the activities that will be provided:</h2>";
echo "<h4>You can check as many as you want<h4>";
echo "<form action='pref_assign.php?id=$courseid' method='post'>";

echo "<h3><div class=\"row\"> 
<div class=\"column1\"'><u>Activity content</u></div>
<div class=\"column2\" '><u>Yes</u></div>
<div class=\"column3\"'><u>No</u></div>
</div></h3>";

echo "<div class=\"row\">
<div class=\"column1\"'>Activities involving Bulbar Involvement</div>
<div class=\"column2\" '><input type ='radio' id='1' name='1' value ='1' required {$checked[1]} ></div>
<div class=\"column3\"'><input type ='radio' id='1' name='1' value ='0'required ";
if ($checked[2] || !$checked[1]){
    echo "checked";
}
echo "></div></div>";

echo "<div class=\"row\">
<div class=\"column1\"'>Activities involving Upper limb impairments</div>
<div class=\"column2\" '><input type ='radio' id='2' name='2' value ='1' required {$checked[3]}></div>
<div class=\"column3\"'><input type ='radio' id='2' name='2' value ='0' required ";
if ($checked[4] || !$checked[3]){
    echo "checked";
}
echo "></div></div>";

echo "<div class=\"row\">
<div class=\"column1\"'>Activities involving Wheelchair</div>
<div class=\"column2\" '><input type ='radio' id='3' name='3' value ='1' required {$checked[5]}></div>
<div class=\"column3\"'><input type ='radio' id='3' name='3' value ='0' required ";
if ($checked[6] || !$checked[5]){
    echo "checked";
}
echo"></div></div>";

echo "<div class=\"row\">
<div class=\"column1\"'>Activities involving Cane/walker</div>
<div class=\"column2\" '><input type ='radio' id='4' name='4' value ='1' required {$checked[7]}></div>
<div class=\"column3\"'><input type ='radio' id='4' name='4' value ='0' required ";
if ($checked[8] || !$checked[7]){
    echo "checked";
}
echo"></div></div>";
echo "<div class=\"row\">
<div class=\"column1\"'>Activities involving Non-invasive Ventilation</div>
<div class=\"column2\" '><input type ='radio' id='5' name='5' value ='1' required {$checked[9]}></div>
<div class=\"column3\"'><input type ='radio' id='5' name='5' value ='0' required ";
if ($checked[10] || !$checked[9]){
    echo "checked";
}
echo"></div></div>";
echo "<input type='submit' value='Submit'>";
echo "</form>";


echo "<style>
.row:after {
    content: \"\";
    display: table;
    clear: both;
  }
  input[type=\"radio\"] {
    float: left;
    clear: none;
    margin: 15px 0 0 2px;
  }
  .column1{
      float: left;
      width: 50%;
      padding: 15px;
  }
  .column2{
      float: left;
      width: 10%;
      padding: 15px;
  }
  .column3{
      float: left;
      width: 10%;
      padding: 15px;

  }
  </style>";

echo $OUTPUT->footer();
