<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getRandomHex($num_bytes=4) {
    return bin2hex(openssl_random_pseudo_bytes($num_bytes));
}

class file_properties{
    
    static function generate_id(){
        
        $existing_ids = file_list::get_ids();
        
        $found = false;
        
        while($found == false){
        
            $new = getRandomHex();
        
            if(in_array($new, $existing_ids) == false){
                $found = true;
            }
            
        }
        
        return $new;
        
    }
    
    static function generate_properties($file, $id, $description, $title){
        
        if(strlen($title) < 1){ $title = $file['name']; }
        
        $extension = end(explode('.',$file['name']));
        
        $properties = [
            "id" => $id,
            "name" => $title,
            "size" => $file['size'],
            "type" => $file['type'],
            "original" => "original." . $extension,
            "thumbnail" => "original." . $extension,
            "description" => $description,
            "extension" => $extension,
            "timestamp" => time(),
        ];
        
        return $properties;
    }
   
}