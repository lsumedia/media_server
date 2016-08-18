/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function update_info(id){
    
    var name = document.getElementById('info_name');
    var type = document.getElementById('info_type');
    var permalink = document.getElementById('info_permalink');
    var name = document.getElementById('info_name');
    var thumb = document.getElementById('info_thumb');
    var size = document.getElementById('info_size');
    var description = document.getElementById('info_desc');
    
    var images = ['jpg','jpeg','png','gif'];
    
     $.ajax({
         url: "details.php?id=" + id,
         method: 'GET',
         contentType: 'application/json',
         success: function(result){
            
            data = JSON.parse(result);
            
            console.log(result);
            
            
            if(images.indexOf(data['extension']) == -1){
                permalink.value = window.location.href + "files/" + id + "/original." + data['extension'];
                thumb.src = 'files/' + id + '/' + data['original'];

            }else{
                permalink.value = window.location.href + "files/" + id + "." + data['extension'];
                thumb.src = 'files/' + id + '/' + data['thumbnail'];
            }
            type.value = data['type'];
            name.innerHTML = data['name'];
            size.value = data['size'] + ' bytes';
            description.value = data['description'];
            $('.materialboxed').materialbox();
        }
    });
    
}