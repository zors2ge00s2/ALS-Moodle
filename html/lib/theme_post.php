<?php
require_once('../config.php');

$myfile = fopen("../theme.csv", "r") or die("Unable to open file!");

while(!feof($myfile)) {
    $line= fgets($myfile);
    $split = explode(",", $line);
    if(count($split) == 3){
      $a = $DB->set_field('config_plugins', 'value', $split[2],  array('plugin'=> $split[0], 'name'=>$split[1]));
    }
  }
