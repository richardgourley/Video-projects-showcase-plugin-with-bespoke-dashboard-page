//videoProjects is assigned from our wp_localize_scripts action in scripts-intializer class.

var commercialBtn = document.getElementById("commercialBtn");
var musicVideoBtn = document.getElementById("musicVideoBtn");
var weddingsBtn = document.getElementById("weddingsBtn");
var projectsDiv = document.getElementById("projectsDiv");

console.log(videoProjects);

function displayVideos(category){
	if(videoProjects){
		var output = '';
        for(i=0; i<videoProjects.length; i++){
        	if(videoProjects[i].category == category){
        		output += '<div class="vps-col-5">';
                output += '<h2>' + videoProjects[i].title + '</h2>';
                output += videoProjects[i].content;
                output += '</div>';
        	}
        }
        if(output == ''){
        	projectsDiv.innerHTML = 'No videos available in this category. Please check back later!';
        }
        projectsDiv.innerHTML = output;
	}

	if(!videoProjects){
        projectsDiv.innerHTML = 'No videos available at the moment, please check back later!';
	}
}

commercialBtn.onclick = function(){
	displayVideos('Commercial');
}

musicVideoBtn.onclick = function(){
    displayVideos('Music video');
}

weddingsBtn.onclick = function(){
    displayVideos('Wedding');
}

