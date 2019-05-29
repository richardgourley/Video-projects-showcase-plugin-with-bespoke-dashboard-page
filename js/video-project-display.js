//videoProjects is assigned from our wp_localize_scripts action in scripts-intializer class.

var commercialBtn = document.getElementById("commercialBtn");
var musicVideoBtn = document.getElementById("musicVideoBtn");
var weddingsBtn = document.getElementById("weddingsBtn");
var projectsDiv = document.getElementById("projectsDiv");

console.log(videoProjects);

function getVimeoId(vimeoLink){
    vimeoLinkParts = vimeoLink.split("/");
    return vimeoLinkParts[(vimeoLinkParts.length -1)];
}

function displayVideos(category){
	if(videoProjects){
		var output = '';
        for(i=0; i<videoProjects.length; i++){
        	if(videoProjects[i].category == category){
                output += '<div class="vps-div-border">';

                output += '<div class="vps-row">';
                output += '<h2>' + videoProjects[i].title + '</h2>';
                output += '</div>';

                output += '<div class="vps-row">';

                output += '<div class="vps-col-3">';
                output += '<h3>Category: ' + videoProjects[i].category + '</h3>';
                output += '<p>Location: ' + videoProjects[i].location + '</p>';
                output += '<img src="' + videoProjects[i].image + '">';
                output += '</div>';

                output += '<div class="vps-col-8">';
                output += '<p>Date: ' + videoProjects[i].date + '</p>';
                output += '<p>Project Duration: ' + videoProjects[i].duration + '</p>';
                output += '<iframe src="https://player.vimeo.com/video/';
                output += getVimeoId(videoProjects[i].url);
                output += '?color=fdfdfd" width="640" height="300" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
                output += '</div>';

                output += '</div>';
                output += '</div>';
        	}
        }
        if(output == ''){
        	projectsDiv.innerHTML = '<br><h3>No videos available at the moment in the category: ' + category + '</h3>';
            projectsDiv.innerHTML += '<p>Please check back later!</p>';
            return;
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

