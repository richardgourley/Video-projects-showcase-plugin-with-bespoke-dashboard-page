/*
* CODE FOR add_video_project_form.php
*/

/*
* Displays or hides text box for adding another country 
*
*/


//div that displays country radio boxes
var countries = document.getElementById("countries");
//represents new_country radio button
var addNewCountry = document.getElementById("addNewCountry");
//label that shows or hides text input for new country
var newCountryTextInput = document.getElementById("newCountryTextInput");

addNewCountry.onclick = function(){
	newCountryTextInput.innerHTML = '<input placeholder="Enter country" type="text" id="new_country" name="new_country" value="">';
}

countries.onclick = function(){
    newCountryTextInput.innerHTML = '<input type="hidden" id="new_country" name="new_country" value="">';
}




