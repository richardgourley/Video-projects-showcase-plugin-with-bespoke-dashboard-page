<?php

class VpsTaxonomiesInit{
    public function __construct(){
        //add_action( 'init', array( $this, 'add_video_project_taxonomies' ));
    }

    public function add_video_project_taxonomies(){
        $labels_country = array();
        $args_country = array();
        register_taxonomy( 'country', $args_country);
        
        $labels_video_type = array();
        $args_video_type = array();
        register_taxonomy( 'video_type', $args_video_type);
    }

}