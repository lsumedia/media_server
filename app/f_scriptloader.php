<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 function js_import(){
        
            $dir = './js';
            $comp_includes = scandir($dir);
            foreach($comp_includes as $comp_ifile){
                if(substr($comp_ifile, (strlen($comp_ifile)-3),3) == ".js"){
                    echo "<script src=\"js/$comp_ifile\" type=\"text/javascript\"></script>", PHP_EOL;
                }
                if(strpos($comp_ifile, '.js') !== false){
                    //echo "<script src=\"js/$comp_ifile\" type=\"text/javascript\"></script>", PHP_EOL;
                }
            }
    }