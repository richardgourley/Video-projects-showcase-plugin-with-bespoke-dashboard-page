//check container is found
if(document.getElementById("vpsProjectsContainer")){
    //create instance of our class
    let pageSetUp = new vpsSearchPageSetUp();

    //main div
    let vpsProjectsContainer = document.getElementById("vpsProjectsContainer");

    //set divs inside main container
    vpsProjectsContainer.innerHTML = pageSetUp.setDivs();

    //assign vars to divs set up in pageSetUp.setDivs()
    let selectBoxDiv = document.getElementById("selectBoxDiv");
    let projectDisplayDiv = document.getElementById("projectDisplayDiv");

    //populate selectDiv
    selectBoxDiv.innerHTML = pageSetUp.populateSelectBox();

    //display videos for the first country
    projectDisplayDiv.innerHTML = pageSetUp.displayProjects(countries[0]);

    //drop down menu on change
    countryDropDown.onchange = function(){
        projectDisplayDiv.innerHTML = pageSetUp.displayProjects(
            countryDropDown.options[countryDropDown.selectedIndex].value
        );
    }

}

function vpsSearchPageSetUp(){
    this.setDivs = function(){
        let content = '<div id="selectBoxDiv" class="vps-select-div"></div>';
        content += '<div id="projectDisplayDiv"></div>';
        return content;
    }
    this.populateSelectBox = function(){
        let content = '';
        content += '<p>Select a country to see projects</p>';
        content += this.generateCountryDropDown();
        return content;
    }
    this.generateCountryDropDown = function(){
        let dropDown = '<select class="vps-select-dropdown" id="countryDropDown">';
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
    this.displayProjects = function(country){
        let content = '';
        for(i=0; i<videoProjects.length; i++){
            if(videoProjects[i].country == country){
                content += '<div class="vps-display-div-page">';
                content += '<div>';
                content += '<h2>' + videoProjects[i].title + '</h2>';
                content += '<p class="vps-noto-sans-font">Category: ' + videoProjects[i].category + '</p>';
                content += '<p class="vps-noto-sans-font">Location: ' + videoProjects[i].location;
                content += ', ' + videoProjects[i].country + '</p>';
                content += '<p class="vps-noto-sans-font">Date: ' + videoProjects[i].displaydate + '</p>';
                content += '<p class="vps-noto-sans-font">Duration: ' + videoProjects[i].duration + '</p>';
                content += '</div>'; //end project info
                content += '<div>';
                content += '<iframe class="vps-iframe" src="https://player.vimeo.com/video/';
                content += videoProjects[i].videoid;
                content += '?color=fdfdfd" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';

                content += '</div>'; //end project video
                content += '</div>'; //end grid
            }
        }
        return content;
    }
    
}






