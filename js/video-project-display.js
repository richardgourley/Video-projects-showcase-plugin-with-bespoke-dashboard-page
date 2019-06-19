//only run this code on pages where vpsProjectsContainer is found
if(document.getElementById("vpsProjectsContainer")){
    //display columns in main container
    let vpsProjectContainerHTML = '';
    vpsProjectContainerHTML += '<div class="vps-col-select-div" id="vpsSelectOptions"></div>';
    vpsProjectContainerHTML += '<div class="vps-col-content-div" id="vpsContentDiv"></div>';
    vpsProjectsContainer.innerHTML += vpsProjectContainerHTML;

    //assign variables to columns
    let vpsSelectOptions = document.getElementById("vpsSelectOptions");
    let vpsContentDiv = document.getElementById("vpsContentDiv");
    
    //populate the select options column
    vpsSelectOptions.innerHTML = vpsPopulateSelectBoxes();

    //a function to populate the contentDiv on page load
    vpsPopulateContentDivOnLoad();

    //populate the contentDiv on select box change
    vpsCountryDropDown.onchange = function(){
        vpsContentDiv.innerHTML = vpsDisplayProjects(
            vpsCountryDropDown.options[vpsCountryDropDown.selectedIndex].value,
            'country'
        );
    }

    vpsCategoryDropDown.onchange = function(){
        vpsContentDiv.innerHTML = vpsDisplayProjects(
            vpsCategoryDropDown.options[vpsCategoryDropDown.selectedIndex].value,
            'category'
        );
    }

}

function vpsPopulateSelectBoxes(){
    let content = '';
    content += '<div class="vps-row">';
    content += '<div class="vps-col-selectboxes">';
    content += '<p>Select a country to see projects</p>';
    content += vpsGenerateCountryDropDown();
    content += '</div>'; //end col
    content += '<div class="vps-col-selectboxes">';
    content += '<p>Select a category to see projects</p>';
    content += vpsGenerateCategoryDropDown();
    content += '</div>'; //end col
    content += '</div>'; //end row

    return content;
}

function vpsPopulateContentDivOnLoad(){
    vpsContentDiv.innerHTML = vpsDisplayProjects('Commercial', 'category');
}

function vpsGenerateCountryDropDown(){
    let dropDown = '<select id="vpsCountryDropDown">';
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

function vpsGenerateCategoryDropDown(){
    let dropDown = '<select id="vpsCategoryDropDown">';
    dropDown += '<option>--Choose a category--</option>';
    for(i=0; i<categories.length; i++){
        dropDown += '<option value="'; 
        dropDown += categories[i]; 
        dropDown += '">';
        dropDown += categories[i]; 
        dropDown += '</option>';
    }
    dropDown += '</select>';

    return dropDown;
}

function vpsDisplayProjects(selectOption, selectMenu){
    let content = '<div class="vps-row">';
    
    for(i=0; i<videoProjects.length; i++){
        if(selectMenu === 'country' && videoProjects[i].country === selectOption){
            //lines 113, 116, 126
            content += vpsGenerateContent(videoProjects[i]);
        }
        if(selectMenu === 'category' && videoProjects[i].category === selectOption){
            content += vpsGenerateContent(videoProjects[i]);
        }
    }

    content += '</div>';

    return content;
}

function vpsGenerateContent(videoProject){
    let content = '';
    content += '<div class="vps-col-video-project-fullwidth">';

    content += '<h1 class="vps-noto-sans-font">' + videoProject.title + '</h1>';

    content += '<div class="vps-col-content-inner-text">';
    content += '<p>Category: ' + videoProject.category + '</p>';
    content += '<p>Location: ' + videoProject.location + ', ' + videoProjects[i].country;
    content += '</div>'; //end inner-text

    content += '<div class="vps-col-content-inner-text">';
    content += '<p>Date: ' + videoProject.displaydate + '</p>';
    content += '<p>Duration: ' + videoProject.duration + '</p>';
    content += '</div>'; //end inner-text

    content += '<iframe class="vps-iframe" src="https://player.vimeo.com/video/';
    content += videoProject.videoid;
    content += '?color=fdfdfd" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
    
    content += '</div>'; //end col-fullwidth

    return content;
}




