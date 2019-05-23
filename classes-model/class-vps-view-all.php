<?php

class VPS_View{

    public function __construct( ){
        
    }

    public function view_all_video_projects(){
        //displays all video projects
        $args = array(
            'post_type' => 'video_project',
            'post_status' => 'publish'
        );
        $video_projects = new WP_Query( $args );
        
        require_once plugin_dir_path( __DIR__ ) . 'admin-pages/view-all-video-projects.php';
    }
    
}