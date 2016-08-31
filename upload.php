<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('init.php');

//Authenticate users
$auth = new authenticator();

if($auth->server_check_permission("upload_media") == false){
    echo "Sorry, you do not have permission to upload files";
    die();
}

$root_dir = "files";

//Save file to temp directory



//Generate code and check it is not in use

$id = file_properties::generate_id();

//Create folder for file

$dir_path = $root_dir . '/' . $id;

//Generate properties.json file


$properties = file_properties::generate_properties($_FILES['file'], $id, $_POST['description'], $_POST['title']);


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



die();

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
