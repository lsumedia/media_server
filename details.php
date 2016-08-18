<?php

/* 
 * Return details about individual files in JSON format
 */

require_once('init.php');

header('Content-type : application/json');

$id = $_GET['id'];

$details = file_list::get_one($id);

echo json_encode($details);

