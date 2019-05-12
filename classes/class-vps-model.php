<?php

class VPS_Model{
    
    protected $fields;

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
        $message = $this->get_post_form_errors( $_POST );
        
        //Re-display form with current inputs and error messages
        if(!$message == ''){
            return $this->re_display_form( $message, $_POST ); 
        }

        //Sanitize fields if no errors exist. Set as array parameters
        $this->fields[ 'video_category' ] = sanitize_text_field($_POST['video-category']);
        $this->fields[ 'country' ] = sanitize_text_field($_POST['country']);
        $this->fields[ 'new_country' ] = sanitize_text_field($_POST['new-country']);
        $this->fields[ 'title' ] = sanitize_text_field($_POST['title']);
        $this->fields[ 'location' ] = sanitize_text_field($_POST['location']);
        $this->fields[ 'date' ] = $_POST['date'];
        $this->fields[ 'duration' ] = sanitize_text_field($_POST['duration']);
        $this->fields[ 'video_project_image' ] = sanitize_url($_POST['video-project-image']);
        $this->fields[ 'video_url' ] = sanitize_url($_POST['video-url']);

        var_dump($this->fields);
        /*
        * INSERT NEW POST HERE
        */

        /*
        $post_arr = array(
            'content' => $this->generate_content( $this->fields );


        );
        */
        
        echo "<br />";
        echo "<br />" . $video_category;
        echo "<br />" . $country;
        echo "<br />" . $new_country;
        echo "<br />" . $title;
        echo "<br />" . $date;
        echo "<br />" . $duration;
        echo "<br />" . $video_url;
        echo "<br />" . $video_project_image;
         
    }
    
    private function get_post_form_errors( $post ){
        $message = "";
        $message .= $this->check_field_filled( $post['video_category'], 'Video category', 'radio' );
        $message .= $this->check_field_filled( $post['country'], 'Country', 'radio' );
        if( $post['country'] == 'other' ){
            $message .= $this->check_field_filled( $post['new-country'], 'Other Country', 'text' );
            $message .= $this->check_only_letters( $post['new-country'] );
        }
        $message .= $this->check_field_filled( $post['title'], 'Title', 'text' );
        $message .= $this->check_field_filled( $post['location'], 'Location', 'text' );
        $message .= $this->check_date_validity( $post['date'] );
        $message .= $this->check_field_filled( $post['duration'], 'Duration', 'text' );
        $message .= $this->check_field_filled( $post['video-project-image'], 'Project Image', 'text' );
        $message .= $this->check_field_filled( $post['video-url'], 'Video Url', 'text' );
        return $message;
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
        if(preg_match('/^[a-z\s]+$/i', $country) || $country === ''){
            return '';
        }else{
            return "<br />Country field can only contain letters.";
        }
    }

    private function re_display_form( $message, $post ){
        require_once plugin_dir_path( __DIR__ ) . 'admin-pages/redisplay-video-project-form.php';
    }
}