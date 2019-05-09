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
        //handle insert video project form submission here
        $message = $this->check_blank_fields( $_POST );
        if($message == ''){
            echo 'Now we will insert this post into the database';
            var_dump( $_POST );
            var_dump( taxonomy_exists('video_category' ));
        }else{
            echo 'There were some errors.<br>Some of your fields were left blank.<br>';
        }
        /*var_dump(taxonomy_exists('country'));
        var_dump(taxonomy_exists('video_category'));
        global $wp_taxonomies;
        var_dump($wp_taxonomies);
        var_dump(term_exists('Uncategorized', 'category'));*/

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

}