//check container is found
if(document.getElementById("vpsProjectsContainer")){
    //create instance of our class
    let pageSetUp = new vpsSearchPageSetUp();

    //main div
    let vpsProjectsContainer = document.getElementById("vpsProjectsContainer");

    //set divs inside main container
    vpsProjectsContainer.innerHTML = pageSetUp.setDivs();

    //assign vars to divs set up in pageSetUp.setDivs()
    let vpsSelectDiv = document.getElementById("vpsSelectDiv");
    let vpsProjectDisplayDiv = document.getElementById("vpsProjectDisplayDiv");

    //populate selectDiv
    vpsSelectDiv.innerHTML = pageSetUp.populateSelectBox();

    //display videos for the first country
    vpsProjectDisplayDiv.innerHTML = pageSetUp.displayProjects(countries[0]);

    //drop down menu on change
    countryDropDown.onchange = function(){
        vpsProjectDisplayDiv.innerHTML = pageSetUp.displayProjects(
            vpsCountryDropDown.options[vpsCountryDropDown.selectedIndex].value
        );
    }

}

function vpsSearchPageSetUp(){
    this.setDivs = function(){
        let content = '<div id="vpsSelectDiv" class="vps-select-div">Testing</div>';
        content += '<div id="vpsProjectDisplayDiv">Testing</div>';
        return content;
    }
    this.populateSelectBox = function(){
        let content = '';
        content += '<p>Select a country to see projects</p>';
        content += this.generateCountryDropDown();
        return content;
    }
    this.generateCountryDropDown = function(){
        let dropDown = '<select class="vps-select-dropdown" id="vpsCountryDropDown">';
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
                content += '<div class="vps-grid">';
                content += '<div class="vps-project-info">';
                content += '<h2>' + videoProjects[i].title + '</h2>';
                content += '<p class="vps-noto-sans-font">Category: ' + videoProjects[i].category + '</p>';
                content += '<p class="vps-noto-sans-font">Location: ' + videoProjects[i].location;
                content += ', ' + videoProjects[i].country + '</p>';
                content += '<p class="vps-noto-sans-font">Date: ' + videoProjects[i].displaydate + '</p>';
                content += '<p class="vps-noto-sans-font">Duration: ' + videoProjects[i].duration + '</p>';
                content += '</div>'; //end project info
                content += '<div class="vps-project-video">';
                content += '<iframe class="vps-iframe" src="https://player.vimeo.com/video/';
                content += videoProjects[i].videoid;
                content += '?color=fdfdfd" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';

                content += '</div>'; //end project video
                content += '</div>'; //end grid
            }
        }
        return content;
    }
    this.testMethod = function(){
        return 'Just a test function';
    }
}






