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
var add_new_country = document.getElementById("add_new_country");
//label that shows or hides text input for new country
var new_country_text_input = document.getElementById("new_country_text_input");

add_new_country.onclick = function(){
    new_country_text_input.innerHTML = '<input type="text" id="new_country" name="new_country" value="">';
}

countries.onclick = function(){
    new_country_text_input.innerHTML = '<input type="hidden" id="new_country" name="new_country" value="">';
}

//=================================================



