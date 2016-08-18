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
    
    
    
     $.ajax({
         url: "details.php?id=" + id,
         method: 'GET',
         contentType: 'application/json',
         success: function(result){
            
            data = JSON.parse(result);
            
            console.log(result);
            
            permalink.value = window.location.href + "files/" + id + "." + data['extension'];
            type.value = data['type'];
            thumb.src = 'files/' + id + '/' + data['thumbnail'];
            name.innerHTML = data['name'];
            
            
        }
    });
    
}