//only run this code on pages where vpsProjectsContainer is found
if(document.getElementById("vpsProjectsContainer")){
    //display columns in main container
    let vpsProjectsContainer = document.getElementById("vpsProjectsContainer");
    vpsProjectsContainer.innerHTML = '<div class="vps-row">';
    vpsProjectsContainer.innerHTML += '<div id="vpsSelectDiv" class="vps-col-12"></div>';
    vpsProjectsContainer.innerHTML += '<div id="vpsProjectDiv" class="vps-col-12"></div>';
    vpsProjectsContainer.innerHTML += '</div>'; 

    let vpsSelectDiv = document.getElementById("vpsSelectDiv");
    vpsSelectDiv.innerHTML = vpsPopulateSelectBox();

    let vpsProjectDiv = document.getElementById("vpsProjectDiv");
    //vpsProjectDiv.innerHTML = vpsDisplayProjectsOnLoad(countries[0]);
    vpsProjectDiv.innerHTML = vpsDisplayProjectsOnLoad(countries[0]);

    //populate the contentDiv on select box change
    vpsCountryDropDown.onchange = function(){
        vpsProjectDiv.innerHTML = vpsDisplayProjects(
            vpsCountryDropDown.options[vpsCountryDropDown.selectedIndex].value
        );
    }

}

function vpsPopulateSelectBox(){
    let content = '';
    content += '<div class="vps-col-selectbox">';
    content += '<p>Select a country to see projects</p>';
    content += vpsGenerateCountryDropDown();
    content += '</div>'; //end col

    return content;
}

//function vpsDisplayProjectsOnLoad('Commercial', 'category')

function vpsGenerateCountryDropDown(){
    let dropDown = '<select class="vps-select-box" id="vpsCountryDropDown">';
    dropDown += '<option>--Choose a country--</option>';
    for(i=0; i<countries.length; i++){
        dropDown += '<option value="'; 
        dropDown += countries[i]; 
        dropDown += '">';
        dropDown += countries[i]; 
        dropDown += '</option>';
    }
    dropDown += '</select>';

    return dropDown;
}

function vpsDisplayProjectsOnLoad(country){
    return vpsDisplayProjects(country);
}

function vpsDisplayProjects(country){
    let content = '';
    for(i=0; i<videoProjects.length; i++){
        if(videoProjects[i].country == country){
            content += '<div class="vps-row">';
            content += '<div class="vps-col-4-postmeta">';
            content += '<h3 class="vps-noto-sans-font-title">' + videoProjects[i].title + '</h3>';
            content += '<p class="vps-noto-sans-font">Category: ' + videoProjects[i].category + '</p>';
            content += '<p class="vps-noto-sans-font">Location: ' + videoProjects[i].location;
            content += ', ' + videoProjects[i].country + '</p>';
            content += '<p class="vps-noto-sans-font">Date: ' + videoProjects[i].displaydate + '</p>';
            content += '<p class="vps-noto-sans-font">Duration: ' + videoProjects[i].duration + '</p>';
            content += '</div>'; //end col 4

            content += '<div class="vps-col-8-video">';
            content += '<iframe class="vps-iframe" src="https://player.vimeo.com/video/';
            content += videoProjects[i].videoid;
            content += '?color=fdfdfd" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
            content += '</div>'; //end col 8
            content += '</div>'; //end row  
        }
    }
    
    return content;
}

function vpsGenerateContent(videoProject){
    let content = '';

    content += '<div class="vps-col-postmeta-div">';
    content += '<h3 class="vps-noto-sans-font">' + videoProject.title + '</h3>';
    content += '<p class="vps-noto-sans-font">Category: ' + videoProject.category + '</p>';
    content += '<p class="vps-noto-sans-font">Location: ' + videoProject.location + ', ' + videoProjects[i].country;
    content += '<p class="vps-noto-sans-font">Date: ' + videoProject.displaydate + '</p>';
    content += '<p class="vps-noto-sans-font">Duration: ' + videoProject.duration + '</p>';
    content += '</div>'; // end postmeta div

    content += '<div class="vps-col-video-div">';
    content += '<iframe class="vps-iframe" src="https://player.vimeo.com/video/';
    content += videoProject.videoid;
    content += '?color=fdfdfd" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
    content += '</div>'; // end video div


    return content;
}




