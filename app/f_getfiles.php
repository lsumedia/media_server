<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class file_listing{
    public $name;
    public $thumbnail;
    public $type;
    
    public function __construct($name, $thumbnail, $type){
        $this->name = $name;
        $this->thumbnail = $thumbnail;
        $this->type = $type;
    }
}

class file_list{
    
    static function get_all(){
        
        global $audio_formats;
        global $image_formats;
        global $video_formats;
        
        $file_dir = './files';

        $files = scandir($file_dir);

        $file_list = [];
        
        array_shift($files);
        array_shift($files);
        
        foreach($files as $filename){

            $file_parts = explode('.', $filename);
            $file_extension = end($file_parts);

            $relative_filename = $file_dir . '/' . $filename;
            
            if(in_array($file_extension, $image_formats)){
                //Images
                $file_list[] = new file_listing($filename, $relative_filename . '?width=150', 'image/' . $file_extension);
                
            }else if(in_array($file_extension, $audio_formats)){
                //Audio
                $file_list[] = new file_listing($filename, '', 'audio/' . $file_extension);

            }else if(in_array($file_extension, $video_formats)){
                //Videos                
                $file_list[] = new file_listing($filename, '', 'video/' . $file_extension);
                
            }else{
                //Other file
                
                $file_list[] = new file_listing($filename, '', 'text/' . $file_extension);

            }
             
        }
        
        return $file_list;

    }
}
