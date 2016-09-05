/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var current_id = null;

function stop_media(){
    //Video/audio preview elements
  var vid_preview = document.getElementById('vid_preview');
  var audio_preview = document.getElementById('audio_preview');
  vid_preview.pause();
  audio_preview.pause();
}

function nice_size(bytes){
    
    if(bytes > 1000000000){
        return (bytes / 1000000000).toString().substr(0,5) + ' GB';
    }else if(bytes > 1000000){
        return (bytes / 1000000).toString().substr(0,5) + ' MB';
    }else if(bytes > 1000){
        return (bytes / 1000).toString().substr(0,5) + ' KB';
    }
    return bytes + ' bytes';
}


function update_info(id){
    
    if(id == current_id){
        $('#infomodal').openModal(); 
        return;
    }
    
    current_id = id;
    
    var name = document.getElementById('info_name');
    var type = document.getElementById('info_type');
    var permalink = document.getElementById('info_permalink');
    var name = document.getElementById('info_name');
    var thumb = document.getElementById('info_thumb');
    var size = document.getElementById('info_size');
    var description = document.getElementById('info_desc');
    var date = document.getElementById('info_date');
    var download_link = document.getElementById('download_url');
    var delete_link = document.getElementById('delete_button');
    var choose_button = document.getElementById('choose_button');
    var optimise = document.getElementById('optimise_check');
    
    //Video/audio preview elements
    var vid_preview = document.getElementById('vid_preview');
    var audio_preview = document.getElementById('audio_preview');
    
    var images = ['jpg','jpeg','png','gif'];
    
     $.ajax({
         url: "details.php?id=" + id,
         method: 'GET',
         contentType: 'application/json',
         success: function(result){
            
            data = JSON.parse(result);
            
            console.log(result);
            
            vid_preview.src = '';
            audio_preview.src = '';
            
            if(data['type'].indexOf('image') != -1){
            //if(images.indexOf(data['extension']) == -1){
                permalink.value = root_url + "files/" + id + "." + data['extension'];
                thumb.src = 'files/' + id + '/' + data['original'];
                thumb.style.display = 'block';
                vid_preview.style.display = 'none';
                audio_preview.style.display = 'none';

            }else if(data['type'].indexOf('audio') != -1){
                permalink.value = root_url + "files/" + id + "/original." + data['extension'];
                thumb.src = '';
                thumb.style.display = 'none';
                thumb.style.display = 'none';
                audio_preview.src = permalink.value;
                audio_preview.load();
                vid_preview.style.display = 'none';
                audio_preview.style.display = 'block';
            
            }else if(data['type'].indexOf('video') != -1){
                permalink.value = root_url + "files/" + id + "/original." + data['extension'];
                thumb.src = '';
                thumb.style.display = 'none';
                vid_preview.src = permalink.value;
                vid_preview.load();
                vid_preview.style.display = 'block';
                audio_preview.style.display = 'none';

            }else{
                permalink.value = root_url + "files/" + id + "/original." + data['extension'];
                thumb.src = '';
                thumb.style.display = 'none';
                vid_preview.style.display = 'none';
                audio_preview.style.display = 'none';
            }
            
            type.value = data['type'];
            name.innerHTML = data['name'];
            size.value = nice_size(data['size']);
            description.value = data['description'];
            date.value = data['date'];
            try{
                download_link.href = permalink.value;
                download_link.download = data['name'];
                delete_link.setAttribute('onclick', 'delete_file(\'' + data['id'] + '\');');
            }catch(e){
                console.log(e);
            }
            
            try{
               
                var function_name = 'return pick_file(\'' + permalink.value + '\');';
                choose_button.setAttribute('onclick',function_name);
            }catch(e){
                console.log(e);
            }
            $('.materialboxed').materialbox();
            $('#infomodal').openModal(); 
            $('.lean-overlay').click(function(){
                stop_media();
            });
        }
    });
    
}

function pick_file(url){
    var optimise = document.getElementById('optimise_check');
    
    if(optimise.checked){
        url += '?width=1920';
    }
    
    try {
        window.opener.handle_window_close(result_id,url);
    }
    catch (err) {
        console.log(err);
    }
    window.close();
    return false;
}

function delete_file(id){
    
    if(confirm('Are you sure you want to delete this file? This will break any links to it!')){
        window.location.href = './delete.php?id=' + id;
    }
    
}