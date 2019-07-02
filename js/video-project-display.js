//only run this code on pages where vpsProjectsContainer is found

if(document.getElementById("vpsProjectsContainer")){
    //create instance of our class
    let pageSetUp = new vpsSearchPageSetUp();
    
    /*
    //display grid in main container
    let vpsProjectsContainer = document.getElementById("vpsProjectsContainer");
    vpsProjectsContainer.innerHTML = vpsSetUpPage();

    let vpsSelectDiv = document.getElementById("vpsSelectDiv");
    let vpsProjectDisplayDiv = document.getElementById("vpsProjectDisplayDiv");

    vpsSelectDiv.innerHTML = vpsPopulateSelectBox();
    vpsProjectDisplayDiv.innerHTML = vpsDisplayProjects(countries[0]);

    //populate the project display div on select box change
    vpsCountryDropDown.onchange = function(){
        vpsProjectDisplayDiv.innerHTML = vpsDisplayProjects(
            vpsCountryDropDown.options[vpsCountryDropDown.selectedIndex].value
        );
    }
    */

}

function vpsSearchPageSetUp(){
    this.setDivs = function(){
        let content = '<div id="vpsSelectDiv" class="vps-select-div">Testing</div>';
        content += '<div id="vpsProjectDisplayDiv">Testing</div>';
        return content;
    }
    this.populateSelectBoxes = function(){
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






