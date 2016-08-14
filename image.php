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
    if(isset($_GET['width'])) throw new Exception('resize!');
    
    $image = new Imagick($filename);
    //$image->adaptiveResizeImage(1024,768);
    //test
    
    if(isset($_GET['thumbnail'])){
        $image->adaptiveresizeimage(150, 150, true);
    }
    $image->borderImage(new ImagickPixel("red"), 5, 5);
    header('Content-type: image/' . $type);
    
    echo $image;
    
}catch(Exception $e){
    
    header('Content-type: text/html');
    echo $e->getMessage();
    
}
