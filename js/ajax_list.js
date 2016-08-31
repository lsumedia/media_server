/* 
 * The MIT License
 *
 * Copyright 2016 Cameron.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */


var convert = function(convert){
    return $("<span />", { html: convert }).text();
};
        
function list_get_data(dataLocation){
        var string = document.getElementById(dataLocation).innerHTML;
        return JSON.parse(string);
}
function rowCode(row){
    
    if(row['properties'] != null){

        var id = row['properties']['id'];

        var html = '<div class="col s2 card z-depth-0" onclick="update_info(\'' + row['properties']['id'] +'\');">';

        if(row['properties']['type'].indexOf('image') != -1){
            html += "<div class=\"card-image z-depth-1 black valign-wrapper\" style=\"height:130px;\"><img class=\"valign\" src=\"files/" + id + "/" + row['properties']['thumbnail'] + "\"></div>";
        }else if(row['properties']['type'].indexOf('audio') != -1){
            html += "<div class=\"card-image z-depth-1 black valign-wrapper\" style=\"height:130px;\"><img class=\"valign\" src=\"res/music_note.svg\"></div>";            
        }else if(row['properties']['type'].indexOf('video') != -1){
            html += "<div class=\"card-image z-depth-1 black valign-wrapper\" style=\"height:130px;\"><img class=\"valign\" src=\"res/videocam.svg\"></div>";       
        }else{
            html += "<div class=\"card-image z-depth-1 black valign-wrapper\" style=\"height:130px;\"><img class=\"valign\" src=\"res/document.svg\"></div>";
        }
        
        html += '<div class="card-title truncate">' + row['properties']['name'] + '</div>';
        html += "</div>";
        
    }else{
        html = "";
    }
    return html;
}
        
function list_change_page(listId,dataLocation,pageNumber){
    var data = list_get_data(dataLocation);
    var html = "";

    var numberOfPages = Math.ceil((data.length)/50);

    var next = pageNumber + 1;
    var prev = pageNumber - 1;

    var offset = 50 * (pageNumber);

    for(var i=offset; i < offset + 50; i++){
        var row = data[i];
        if(row){
            html += rowCode(row);
        }   
    }

    try{
        document.getElementById(listId + '_body').innerHTML = html;
        document.getElementById(listId + '_pagenumber').innerHTML = pageNumber + 1;
    }catch(e){
        console.log(e);
    }

    //Load buttons
    var backbtn = document.getElementById(listId + '_back');
    var nextbtn = document.getElementById(listId + '_next');
    //Change button targets
        
        
    try{
        //Change button visibility depending on list length
        if(pageNumber == 0){
            backbtn.setAttribute('onclick','javascript:void(0);');
            backbtn.style.color = '#888';
        }else{
            backbtn.setAttribute('onclick','list_change_page(\'' + listId + '\',\'' + dataLocation + '\',' + prev + ');' );
            backbtn.style.color = 'inherit';
        }
        if(pageNumber >= (numberOfPages -1) ){
            nextbtn.setAttribute('onclick','javascript:void(0);');
            nextbtn.style.color = '#888';
        }else{
            nextbtn.setAttribute('onclick','list_change_page(\'' + listId + '\',\'' + dataLocation + '\',' + next + ');' );
            nextbtn.style.color = 'inherit';
        }
    }catch(e){
        console.log(e.message);
    }
        
}
        
function list_search(listId,dataLocation,term){
        
        if(term.length == 0){
            list_change_page(listId,dataLocation,0);
            return;
        }
        
        var data = list_get_data(dataLocation);
        
        var html = "";
        for(var i=0; i < data.length; i++){
            var row = data[i];
            var match = false;
            for(var key in row){
                if(key != 'onclick'){
                    if(row[key]){
                        var content = row[key].toLowerCase();
                        if(content.indexOf(term.toLowerCase()) != -1){
                           match = true;
                        }
                    }
                }
            }
            if(match == true){
                var row = data[i];
                if(row){
                    html += rowCode(row);
                }   
                
            }
        }
        
        document.getElementById(listId + '_body').innerHTML = html;
        //Load buttons
        var backbtn = document.getElementById(listId + '_back');
        var nextbtn = document.getElementById(listId + '_next');
        backbtn.style.color = '#888';
        nextbtn.style.color = '#888';
}
        
function list_all(listId, dataLocation){ 
        var data = list_get_data(dataLocation);
        
        console.log(data);
        var html = "";
        
        
        for(var i=0; i < data.length; i++){
            var row = data[i];
            if(row){
                html += rowCode(row);
            }   
        }
        
        document.getElementById(listId + '_body').innerHTML = html;
}