//only run this code on pages where vpsProjectsContainer is found
if(document.getElementById("vpsProjectsContainer")){
    //display grid in main container
    let vpsProjectsContainer = document.getElementById("vpsProjectsContainer");
    vpsProjectsContainer.innerHTML = vpsSetUpPage();

    console.log(countries);
    console.log(videoProjects);

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

    function vpsSetUpPage(){
        let containerContent = '<div id="vpsSelectDiv" class="vps-select-div">Testing</div>';
        containerContent += '<div id="vpsProjectDisplayDiv">Testing</div>';

        return containerContent;
    }

    function vpsPopulateSelectBox(){
        let content = '';
        content += '<p>Select a country to see projects</p>';
        content += vpsGenerateCountryDropDown();

        return content;
    }

    function vpsGenerateCountryDropDown(){
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

    function vpsDisplayProjects(country){
        let content = '';
        for(i=0; i<videoProjects.length; i++){
            if(videoProjects[i].country == country){
                content += '<div class="vps-grid">';
                content += '<div class="vps-project-info">';
               // content += '<span class="vps-noto-sans-font-title">' + videoProjects[i].title + '</span>';
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

}






