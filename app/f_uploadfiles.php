<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getRandomHex($num_bytes=4) {
    return bin2hex(substr(md5(rand(),true),0,$num_bytes));
}

class file_properties{
    
    static function generate_id(){
        
        $existing_ids = file_list::get_ids();
        
        $found = false;
        
        while($found == false){
        
            $new = getRandomHex(3);
        
            if(in_array($new, $existing_ids) == false){
                $found = true;
            }
            
        }
        
        return $new;
        
    }
    
    static function generate_properties($file, $id, $description){
        
        $extension = end(explode('.',$file['name']));
        
        $properties = [
            "id" => $id,
            "name" => $file['name'],
            "size" => $file['size'],
            "type" => $file['type'],
            "original" => "original." . $extension,
            "thumbnail" => "original." . $extension,
            "description" => $description,
            "extension" => $extension,
        ];
        
        return $properties;
    }
   
}