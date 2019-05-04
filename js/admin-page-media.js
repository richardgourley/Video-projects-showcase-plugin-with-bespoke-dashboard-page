/*
* CODE FOR add_video_project_form.php
* DISPLAYS the media box when uploading an image
*/

jQuery(document).ready(function($s){

    var mediaUploader;

    $('#upload_image_video_project').click(function(e){
    	console.log("JUST TESTING AGAIN");
        e.preventDefault();

        if(mediaUploader){
        	mediaUploader.open();
        	return;
        }

        //Extend wp_media object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
            	text: 'Choose Image'
            }, multiple: false}
        );

        //When file selected, get the URL and set it to field value in the form
        mediaUploader.on('select', function(){
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#video_project_image').val(attachment.url);
        });

        //Opens the uploader dialog
        mediaUploader.open();
    });

});







