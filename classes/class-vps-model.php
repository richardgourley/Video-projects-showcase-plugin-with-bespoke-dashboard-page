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
        
    }

}