<?php
/*ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/

$type = $_GET['type'];



$folder = './files';
$filename = $_GET['file'];

$path = $folder . '/' . $filename;

try{
    
    $image = new Imagick($path);
    //$image->adaptiveResizeImage(1024,768);
    $image->borderImage(new ImagickPixel("red"), 5, 5);
    header('Content-type: image/' . $type);
    
}catch(Exception $e){
    
    header('Content-type: text/html');
    echo $e->getMessage();
    
}

echo $image;