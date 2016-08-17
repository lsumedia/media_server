<?php

/* 
 * Return details about individual files in JSON format
 */

require_once('init.php');

header('Content-type : application/json');

$code = $_GET['code'];

$details = file_list::get_one($code);

echo json_encode($details);

