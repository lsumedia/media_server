<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class file_listing{
    
    public function __construct($properties){
       $this->properties = $properties;
       $this->extension = explode('/',$properties->type)[1];
    }
}

class file_list{
    
    static function get_all(){
        
        $file_dir = './files';

        $data_folders = scandir($file_dir);

        $file_entries = [];
        
        //Remove . and ..
        array_shift($data_folders);
        array_shift($data_folders);
        
        foreach($data_folders as $folder){
            
            $root_path = $file_dir . '/' . $folder;
            if(is_dir($root_path)){
                
                $prop_location = $root_path . '/properties.json';
                $prop_handle = fopen($prop_location, 'r');
                $properties = json_decode(fread($prop_handle,filesize($prop_location)));
                fclose($prop_handle);
                $file_entries[] = new file_listing($properties);
                
            }
        }
        
        return $file_entries;

    }
}
