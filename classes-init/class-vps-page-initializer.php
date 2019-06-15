<?php

class VPS_Page_Initializer{
    public function __construct(){
        
    }
    
    public function create_video_project_page(){
        //code for custom page to be inserted into the site to display custom post type results
        $page_content = 
            '<div id="vpsProjectsContainer" class="vps-row">
             </div>';

        $args = array(
            'post_title'   => 'Video Projects',
            'post_status'  => 'publish',
            'post_content' => $page_content,
            'post_type'    => 'page'
        );

        if( !post_exists( 'Video Projects' ) ){
            wp_insert_post( $args );
        }
        
    }

}