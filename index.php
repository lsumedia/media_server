<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_GET['debug'])){
    ini_set("display_errors", 1);
    ini_set("track_errors", 1);
    ini_set("html_errors", 1);
    error_reporting(E_ALL);
}

require('init.php');

$auth = new authenticator();

if(isset($_GET['key'])){
    header('location:.');   
}

?>
<html>
    <head>
        <title>Media Uploader</title>
         <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        
        <nav>
            <div class="nav-wrapper container white-text" >
                <div class="brand-logo">
                    <!-- <img src="res/media_reverse.png" /> -->
                    <p>File Manager</p>
                </div>
            </div>
        </nav>
        
        <main id="main">
            <div class="container">
                <button class="btn" id="uploadbtn" onclick="$('#uploadmodal').openModal();">Add files</button>

                <?php
                foreach(file_list::get_all() as $file){
                    $id = $file->properties->id;
                    echo "<div onclick=\"fileinfo.open({$id});\">";
                    echo "<img width=\"150\" class=\"not-materialboxed\" src=\"files/{$id}/{$file->properties->thumbnail}\"/>";
                    echo "<p>{$file->properties->name}</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </main>
        
        <div id="uploadmodal" class="modal bottom-sheet">
            <div class="modal-content">
                <form action="#">
                    <div class="file-field input-field">    
                        <div class="btn">
                            <span>File</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Upload</a>
            </div>
        </div>
        
        <div id="detailsmodal" class="modal bottom-sheet">
            <div class="modal-content">
                <form action="#">
                    <div class="file-field input-field">    
                        <div class="btn">
                            <span>File</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Upload</a>
            </div>
        </div>
          
        
        <?php $auth->status_bug(); ?>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script>
            $(".button-collapse").sideNav();
        </script>
    </body>
</html>

