<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class file_listing{
    
    public function __construct($properties){
       $this->properties = $properties;
    }
}

class file_list{
    
    static function get_all(){
        
        $file_dir = 'files';

        $data_folders = scandir($file_dir);

        $file_entries = [];
        
        //Remove . and ..
        array_shift($files);
        array_shift($files);
        
        foreach($data_folders as $folder){
            
            $root_path = $file_dir . '/' . $folder;
            if(is_dir($root_path)){
                
                $properties = json_decode(fread($root_path . '/properties.json'));
                $file_entries[] = new file_listing($properties);
                
            }
        }
        
        return $file_entries;

    }
}
