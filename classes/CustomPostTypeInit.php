<?php

class VpsCustomPostTypeInit{
    public function __construct(){
        //add_action( 'init', array( $this, 'add_video_project_post_type' ));
    }

    public function add_video_project_post_type(){
        $labels = array();
        $args = array();
        register_post_type( 'video_project', $args );
    }

}