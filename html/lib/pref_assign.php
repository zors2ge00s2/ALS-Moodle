<?php

require('../config.php');
require_once($CFG->dirroot.'/group/lib.php');

global $USER;


$a = (bool) $_POST["1"];
$b = (bool) $_POST["2"];
$c = (bool) $_POST["3"];
$d = (bool) $_POST["4"];
$e = (bool) $_POST["5"];
//these pairings remove the user from the opposite pairing
$courseid = required_param('id', PARAM_INT);

//BI
if($a){
    groups_add_member(1, $USER);
    groups_remove_member(2, $USER);
}
else{
    groups_add_member(2, $USER);
    groups_remove_member(1, $USER);
}
//ULI
if($b){
    groups_add_member(3, $USER);
    groups_remove_member(4, $USER);
}
else{
    groups_add_member(4, $USER);
    groups_remove_member(3, $USER);
}
//W
if($c){
    groups_add_member(5, $USER);
    groups_remove_member(6, $USER);
}
else{
    groups_add_member(6, $USER);
    groups_remove_member(5, $USER);
}

//C/W
if($d){
    groups_add_member(7, $USER);
    groups_remove_member(8, $USER);
}
else{
    groups_add_member(8, $USER);
    groups_remove_member(7, $USER);
}
if($e){
    groups_add_member(9, $USER);
    groups_remove_member(10, $USER);
}
else{
    groups_add_member(10, $USER);
    groups_remove_member(9, $USER);
}
//header("Location: /course/view.php?id={$courseid}");
header("Location: /#");
?>
