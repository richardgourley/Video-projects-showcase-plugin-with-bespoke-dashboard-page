<?php

class VPS_Model{
    
    public function __construct(){
        //constructor logic
    }
    
    public function display_video_project_form(){
    	//displays form 
    	require_once plugin_dir_path( __DIR__ ) . 'admin-pages/add-video-project-form.php';
    }

    public function insert_video_project( ){
        /*
        * CHECK FORM FOR ERRORS AND SANITIZE/ VALIDATE
        */
        var_dump($_POST);
        $message = "";
        
        //ADD TO ERROR MESSAGE AS WE FIND ERRORS
        $message .= $this->check_field_filled($_POST['video_category'], 'Video category', 'radio');
        $message .= $this->check_field_filled($_POST['country'], 'Country', 'radio');
        $message .= $this->check_only_letters($_POST['country']);
        $message .= $this->check_field_filled($_POST['title'], 'Title', 'text');
        $message .= $this->check_field_filled($_POST['location'], 'Location', 'text');
        $message .= $this->check_date_validity($_POST['date']);
        $message .= $this->check_field_filled($_POST['duration'], 'Duration', 'text');
        $message .= $this->check_field_filled($_POST['video-project-image'], 'Project Image', 'text');
        $message .= $this->check_field_filled($_POST['video-url'], 'Video Url', 'text');

        if(!$message == ''){
            //Return and re-display form with error message
            echo "<br />There were errors in the form";
            echo "<br />" . $message;
            //return redisplay_form( $message ); 
        }

        //SANITIZE TEXT FIELDS
        $video_category = sanitize_text_field($_POST['video-category']);
        $country = sanitize_text_field($_POST['country']);
        $title = sanitize_text_field($_POST['title']);
        $date = $_POST['date'];
        $duration = sanitize_text_field($_POST['duration']);
        $video_project_image = sanitize_url($_POST['video-project-image']);
        $video_url = sanitize_url($_POST['video-url']);
        

        /*
        * INSERT NEW POST HERE
        */
        
        echo "<br />";
        echo "<br />" . $video_category;
        echo "<br />" . $country;
        echo "<br />" . $title;
        echo "<br />" . $date;
        echo "<br />" . $duration;
        echo "<br />" . $video_url;
        echo "<br />" . $video_project_image;
        
        
    }

    private function check_field_filled( $var, $name, $type ){
        if($var === '' && $type == 'radio'){
            return "<br />$name must be selected.";
        }else if($var === '' && $type == 'text'){
            return "<br />$name field must not be blank.";
        }else{
            return '';
        }
    }
    
    private function check_date_validity( $date ){
    
        if($date === ''){
            return "<br />Date field must not be blank";
        }

        $date_arr = explode( '-', $date);

        if(!strlen($date_arr[0]) == 4 || preg_match('/[a-z@,!]/i', $date)){
            return "<br />Your date is not valid. Check it is in YYYY-MM-DD format";
        }
    
        if(!wp_checkdate($date_arr[1], $date_arr[2], $date_arr[0], $date)){
            return "<br />Your date is not valid. Check it is in YYYY-MM-DD format";
        }
    
        return '';
    }

    private function check_only_letters( $country ){
        //country field is blank already checked, ok if blank
        if(preg_match('/^[a-z]+$/i', $country) || $country === ''){
            return '';
        }else{
            return "<br />Country field can only contain letters.";
        }
    }
}