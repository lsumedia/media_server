<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('init.php');

$auth = new authenticator();

if($auth->server_check_permission('edit_media') == true){

    $id = $_GET['id'];

    array_map('unlink', glob("files/$id/*.*"));
    rmdir("files/$id");

}
header('location:.');