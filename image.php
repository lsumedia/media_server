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
    //if(isset($_GET['width'])) throw new Exception('resize!');
    
    $image = new Imagick($filename);
    //$image->adaptiveResizeImage(1024,768);
    //test
    
    if(isset($_GET['width'])){
        $newwidth = ($_GET['width'] < 5000)? $_GET['width'] : 5000;
        if($type == 'gif'){
            $image = $image->coalesceimages();
            foreach ($image as $frame) { 
                //$frame->cropImage($crop_w, $crop_h, $crop_x, $crop_y); 
                //$frame->thumbnailImage($size_w, $size_h); 
                //$frame->setImagePage($size_w, $size_h, 0, 0); 
                $frame->adaptiveresizeimage($newwidth, $newwidth, true);
            } 
            $image = $image->deconstructimages(); 
        }else{
            $image->adaptiveresizeimage($newwidth, $newwidth, true);
        }
    }
    
    header('Content-type: image/' . $type);
    
    echo $image;
    
}catch(Exception $e){
    
    header('Content-type: text/html');
    echo $e->getMessage();
    
}
