<?php
/*
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
$files_folder = 'files';
$filename = $_GET['file'];

$code = explode('.',$filename)[0];

//Read properties.json
$folder_path = $files_folder . '/' . $code;
$prop_path = $folder_path . '/properties.json';
$prop_handle = fopen($prop_path, 'r');
$properties = json_decode(stream_get_contents($prop_handle));
fclose($prop_handle);

$original = $properties->original;
$original_path = $folder_path . '/' . $original;

$output_content_type = $properties->type;

try{
    //if(isset($_GET['width'])) throw new Exception('resize!');
    
    if(isset($_GET['width'])){
        $width = $_GET['width'];
        $sizes = (array) $properties->sizes;
        
        /*
        print_r($sizes);
            var_dump($sizes[$width]);
            echo $sizes[500];
            
            throw new Exception("end");
        */
        if($sizes[$width] != null){
            
            
            $version_path = $folder_path . '/' . $sizes[$width];
            $image = new Imagick($version_path);
        
            
        }else{            
            
            $image = new Imagick($original_path);
            
            $newwidth = ($_GET['width'] < 5000)? $_GET['width'] : 5000;
            
            if($properties->type == 'image/gif'){
                
                //Resive GIF layer-by-layer
                $image = $image->coalesceimages();
                foreach ($image as $frame){ 
                    //$frame->cropImage($crop_w, $crop_h, $crop_x, $crop_y); 
                    //$frame->thumbnailImage($size_w, $size_h); 
                    //$frame->setImagePage($size_w, $size_h, 0, 0); 
                    $frame->adaptiveresizeimage($newwidth, $newwidth, true);
                } 
                $image = $image->deconstructimages(); 
            }else{
                
                $image->adaptiveresizeimage($newwidth, $newwidth, true);
                
                //Recompress non-PNG files as JPEG
                if($properties->type != 'image/png'){
                    $image->setImageCompression(imagick::COMPRESSION_JPEG); 
                    $image->setImageCompressionQuality(85); 
                    $image->stripImage(); 
                    $output_content_type = 'image/jpeg';
                }
            }
        }
      
    }else{
        
        $image = new Imagick($original_path);
        
        if($properties->type == 'image/gif'){
            //Fix gifs
            $image = $image->coalesceimages();
               
            $image = $image->deconstructimages();
        }
       
    }
    //$image->adaptiveResizeImage(1024,768);
    //test
    
    header('Content-type: ' . $output_content_type);
    
    echo $image;
    
    //TODO: New process
    
    //Read file name
    
    //Look for contents folder
    
    //Read properties.json
    
    //Get or generate the requested image
    
    //Update properties.json
    
}catch(Exception $e){
    
    header('Content-type: text/html');
    echo $e->getMessage();
    
}
