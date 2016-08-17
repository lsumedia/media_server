<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'config.php';

$dir = 'app';
$comp_includes = scandir($dir);
foreach($comp_includes as $comp_ifile){
    if(strpos($comp_ifile, '.php') !== false){
        //echo $dir . '/' . $comp_ifile;
        include($dir . '/' . $comp_ifile);
    }
}