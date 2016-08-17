<?php

/* 
 * Return details about individual files in JSON format
 */

require_once('init.php');

$code = $_GET['code'];

$details = file_list::get_one(code);

echo json_encode($details);

