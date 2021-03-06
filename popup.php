<?php

if(isset($_GET['debug']) || $config['debug'] == true){
    ini_set("display_errors", 1);
    ini_set("track_errors", 1);
    ini_set("html_errors", 1);
    error_reporting(E_ALL);
}

require('init.php');

if($config['require_auth'] == true){
    //$auth = new authenticator();
}

if(isset($_GET['key'])){
    header('location:./popup.php');   
}

?>
<html>
    <head>
        <title>Choose Files</title>
         <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="css/style.css" />
        
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        
        <script>
            var root_url = '<?= $config['root_url'] ?>';
            var result_id = '<?= $_GET['result_id'] ?>';
        </script>
        
        <?php js_import(); ?>
    </head>
    <body>
        
        <main id="popup-main">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <button class="btn" id="uploadbtn" onclick="$('#uploadmodal').openModal();">Add files</button>
                    </div>
                </div>

                <div class="row">
                <?php
                /*
                foreach(file_list::get_all() as $file){
                    $id = $file->properties->id;
                    ?>
                    <div class="col s2" onclick="$('#infomodal').openModal(); update_info('<?= $id ?>');">
                        <img class="" src="files/<?= $id ?>/<?= $file->properties->thumbnail?>" style="width:100%" />
                        <p><?= $file->properties->name ?></p>
                    </div>
                    <?php
                }*/
                
                $list = new ajax_list(file_list::get_all(), 'file_list');
                $list->display();
                ?>
                </div>
            </div>
        </main>
        
        <div id="uploadmodal" class="modal ">
            <div class="modal-content">
                <form action="upload.php?popup" method="POST" enctype="multipart/form-data" id="upload_form">
                    <div class="file-field input-field">    
                        <div class="btn btn-flat">
                            <span>File</span>
                            <input type="file" name="file">
                        </div>
                        <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="input-field">
                        <label for="upload_desc">Title (optional)</label>
                        <input type="text" name="title" />
                    </div>
                    <div class="input-field">
                        <label for="upload_desc">Description</label>
                        <input type="text" name="description" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0):" 
                   onclick="document.getElementById('upload_form').submit();" 
                   class=" modal-action modal-close waves-effect waves-green btn-flat"
                >Upload</a>
            </div>
        </div>
        
        <div id="infomodal" class="modal">
            <div class="modal-content">
                <div class="row">
                    <audio class="col s12" controls src="" style="display:none; width:100%; margin-bottom:24px;" id="audio_preview"></audio>
                    <div class="col s12 m12 l2 hide-on-med-and-down">
                        <img class="materialboxed hide-on-small-and-down" src="" id="info_thumb" alt="File preview" width="100%"/>
                        <video controls src="" style="display:none;" id="vid_preview" width="100%" height="auto"></video>
                    </div>
                    <div class="col s12 m12 l10">
                        <h4 id="info_name" class="truncate"></h4>
                        <div class="row">
                            <div class="col s12 l6">
                                <label for="info_permalink">Address</label>
                                <input id="info_permalink" readonly value="" onclick="this.focus();this.select()" />
                            </div>
                            <div class="col s12 l3">
                                <label for="info_date">Time uploaded</label>
                                <input id="info_date" readonly value="" />
                            </div>
                            <div class="col s12 l3">
                                <label for="info_type">MIME Type</label>
                                <input id="info_type" readonly value="image/jpeg" />
                            </div>
                        </div>
                         <div class="row">
                            <div class="col s12 l9">
                                <label for="info_desc">Description</label>
                                <input id="info_desc" readonly value="" />
                            </div>
                            <div class="col s12 l3">
                                <label for="info_size">File size</label>
                                <input id="info_size" readonly value="" />
                            </div>
                             <div class="col s6 l4">
                                <div class="switch">
                                    <label>
                                      Full-res
                                      <input type="checkbox" id="optimise_check" checked="checked">
                                      <span class="lever"></span>
                                      Optimised
                                    </label>
                                  </div>
                             </div>
                            
                            <div class="col s6 l8">
                                    <button class="btn red right" id="choose_button">Select</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="modal-footer">
                <a href="#!" class=" modal-action  red-text modal-close waves-effect waves-green btn-flat">DELETE</a>
            </div> -->
        </div>
            
    </body>
</html>

