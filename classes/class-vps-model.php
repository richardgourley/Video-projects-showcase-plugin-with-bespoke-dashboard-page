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
        $message = $this->check_blank_fields( $_POST );
        //$message is either blank or not.

        $video_category = sanitize_text_field($_POST['video-category']);
        $country = sanitize_text_field($_POST['country']);
        $new_country = sanitize_text_field($_POST['new-country']);

        if(!$this->is_a_pure_string($new_country)){
            $message .= '<br />The new country you added must only contain letters.';
        }

        $title = sanitize_text_field($_POST['title']);

        if($this->validate_date($_POST['date'])){
            $date = $_POST['date'];
        }else{
            //handle invalid date
            $message .= '<br />Your date is invalid, please use YYYY-MM-DD format.'; 
        }
        $duration = sanitize_text_field($_POST['duration']);
        $video_url = sanitize_url($_POST['video-url']);
        $video_project_image = sanitize_url($_POST['video-project-url']);

        /*
        * INSERT NEW POST HERE
        */

        if($country === 'add-new-country'){
            //we have checked $new_country already
            //so we have a $new_country ready to create a new term.
            
        }else{
            //country is from existing terms... add this post to taxonomy term.
        }

        //FORM HANDLING
        /*
        1. video_category - a) check term exists b) create term if not c) add to post?
        2. country - a) check is add-new-country b) check term exists - if not create term b) check is add-new-country
        3. new-country - a) create term b) save 
        4. title - sanitize text field
        5. date - check is valid date, if not add to error message
        6. duration - sanitize text field
        7. video-project-url - sanitize url
        8. video-url - sanitize url
        */
    }

    private function check_blank_fields( $post ){
        $message = "";
        foreach($post as $k => $v){
            if($v === ''){
                $message .= $k . ' field is blank. Please try again<br>';
            }
        }
        return $message;
    }
    
    private function validate_date( $date ){
        $date_arr = explode( '-', $date);
        var_dump($date_arr);
        //MM DD YYYY
        return wp_checkdate($date_arr[1], $date_arr[2], $date_arr[0], $date);
    }
}