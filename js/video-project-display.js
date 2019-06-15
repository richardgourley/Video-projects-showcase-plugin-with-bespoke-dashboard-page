/* HERE ARE THE VARIABLES LOCALIZED IN classes-init/class-vps-scripts-initializer.php
console.log(videoProjects);
console.log(countries);
console.log(categories);
*/

let selectOptionsCountryDiv = document.getElementById("selectOptionsCountryDiv");
let selectOptionsCategoryDiv = document.getElementById("selectOptionsCategoryDiv");
//let vpsProjectsContainer = document.getElementById("vpsProjectsContainer");

//only run this code on pages where vpsProjectsContainer is found
if(vpsProjectsContainer){
    //display columns in main container
    let vpsProjectContainerHTML = '';
    vpsProjectContainerHTML += '<div class="vps-col-3" id="selectOptions"></div>';
    vpsProjectContainerHTML += '<div class="vps-col-9" id="contentDiv"></div>';
    vpsProjectsContainer.innerHTML += vpsProjectContainerHTML;

    console.log(vpsProjectContainerHTML);
 
    //assign variables to columns
    let selectOptions = document.getElementById("selectOptions");
    let contentDiv = document.getElementById("contentDiv");
    
    //populate the select boxes
    selectOptions.innerHTML = vpsPopulateSelectBoxes();

    //a function to populate the contentDiv on page load
    vpsPopulateContentDivOnLoad();

    //populate the contentDiv on select box change
    selectCountryDropDown.onchange = function(){
        contentDiv.innerHTML = displayVideoProjects(
            selectCountryDropDown.options[selectCountryDropDown.selectedIndex].value,
            'country'
        );
    }

    selectCategoryDropDown.onchange = function(){
        contentDiv.innerHTML = displayVideoProjects(
            selectCategoryDropDown.options[selectCategoryDropDown.selectedIndex].value,
            'category'
        );
    }

}

function vpsPopulateSelectBoxes(){
    let content = '';
    content += '<div class="vps-row">';
    content += '<div class="vps-col-selectboxes">';
    content += '<p>Select a country to see projects</p>';
    content += createSelectCountryDropDown();
    content += '</div>'; //end col
    content += '<div class="vps-col-selectboxes">';
    content += '<p>Select a category to see projects</p>';
    content += createSelectCategoryDropDown();
    content += '</div>'; //end col
    content += '</div>'; //end row

    return content;
}

function vpsPopulateContentDivOnLoad(){
    contentDiv.innerHTML = displayVideoProjects('Commercial', 'category');
}

function createSelectCountryDropDown(){
    let dropDown = '<select id="selectCountryDropDown">';
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

function createSelectCategoryDropDown(){
    let dropDown = '<select id="selectCategoryDropDown">';
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

function displayVideoProjects(selectOption, selectMenu){
    //contentDiv.innerHTML = '<h1>' + country + '</h1>';
    let content = '<div class="vps-row">';
    
    for(i=0; i<videoProjects.length; i++){
        if(selectMenu === 'country' && videoProjects[i].country === selectOption){
            content += addVideoContent(videoProjects[i]);
        }
        if(selectMenu === 'category' && videoProjects[i].category === selectOption){
            content += addVideoContent(videoProjects[i]);
        }
    }

    content += '</div>';

    return content;

}

function addVideoContent(videoProject){
    let content = '';
    content += '<div class="vps-col-video-project-fullwidth">';

    content += '<h1 class="vps-patua-font">' + videoProject.title + '</h1>';

    content += '<div class="vps-col-6">';
    content += '<div class="vps-col-content-inner-text">';
    content += '<p class="vps-patua-font">Category: ' + videoProject.category + '</p>';
    content += '<p class="vps-patua-font">Location: ' + videoProject.location + ', ' + videoProjects[i].country;
    content += '</div>'; //end inner-text
    content += '</div>'; //end col-6 category and location

    content += '<div class="vps-col-6">';
    content += '<div class="vps-col-content-inner-text">';
    content += '<p class="vps-patua-font">Date: ' + videoProject.displaydate + '</p>';
    content += '<p class="vps-patua-font">Duration: ' + videoProject.duration + '</p>';
    content += '</div>'; //end inner-text
    content += '</div>'; //end col-6 date and duration

    content += '<iframe class="vps-iframe" src="https://player.vimeo.com/video/';
    content += videoProject.videoid;
    //content += '?color=fdfdfd" width="640" height="300" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
    content += '?color=fdfdfd" width="640" height="300" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
    
    content += '</div>'; //end col-12

    return content;
}



