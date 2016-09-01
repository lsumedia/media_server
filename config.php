<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$image_formats = ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'ico', 'svg'];
$audio_formats = ['mp3', 'm4a', 'aac', 'wav', 'flac', 'wma'];
$video_formats = ['mp4', 'mov', 'avi', 'wmv', 'webm', 'oggv'];

$banned_formats = ['php','exe','msi','cshtml'];

$config = [
    'require_auth' => true,
    'debug' => false,
];