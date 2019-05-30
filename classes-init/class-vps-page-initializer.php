<?php

class VPS_Page_Initializer{
    public function __construct(){
        
    }
    
    public function create_video_project_page(){
        //code for custom page to be inserted into the site to display custom post type results
        $page_content = 
            '<div class="vps-row">
             <div class="vps-col-3">
             <button id="commercialBtn">Commercial Projects</button>
             </div>
             <div class="vps-col-3">
             <button id="musicVideoBtn">Music Videos</button>
             </div>
             <div class="vps-col-3">
             <button id="weddingsBtn">Wedding projects</button>
             </div>
             </div>
             <div class="vps-row" id="projectsDiv">
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