<?php

require_once('../config.php');
$sql= 'SELECT * FROM mdl_config_plugins WHERE plugin = \'theme_adaptable\';';
$discussions = $DB->get_records_sql($sql, null, $limitfrom=0, $limitnum=0);
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=theme.csv');
$output = fopen('php://output', 'w');
foreach($discussions as $record){
    $name = $record->name;
    $value = $record->value;
    if(strcmp($name, "customcss") ==0 ){
        $value = str_replace(array("\n", "\r"), '', $value);
    }
    $arr = array($record->plugin, $name, $value);

    fputcsv($output, $arr);
}
