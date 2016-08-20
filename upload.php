<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(1){
 ini_set("display_errors", 1);
    ini_set("track_errors", 1);
    ini_set("html_errors", 1);
    error_reporting(E_ALL);
}

require_once('init.php');

if($config['require_auth'] == true){
    
    //Authenticate users
    $auth = new authenticator();

    if($auth->server_check_permission("upload_media") == false){
        echo "Sorry, you do not have permission to upload files";
        die();
    }
}


$root_dir = "files";

//Save file to temp directory



//Generate code and check it is not in use

$id = file_properties::generate_id();

//Create folder for file

$dir_path = $root_dir . '/' . $id;

//Generate properties.json file


$properties = file_properties::generate_properties($_FILES['file'], $id, $_POST['description']);


//Move file to new directory

if(in_array($properties['extension'], $banned_formats)){
    echo "Format not allowed";
    die();
}

//Finalise and write data

//Make directory
if(!mkdir($dir_path)){
    echo "Failed to make directory!";
}

$prop_handle = fopen($dir_path . '/properties.json',"w") or die('Unable to create properties file');
fwrite($prop_handle, json_encode($properties));
fclose($prop_handle);

$final_path = 'files/' . $id . '/original.' . $properties['extension'];
if(move_uploaded_file($_FILES["file"]["tmp_name"], $final_path)){
    header('location:.');
    die();
}

//Generate thumbnail

//if image: Generate additional sizes