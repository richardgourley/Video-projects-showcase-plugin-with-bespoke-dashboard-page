<?php

class VPS_Plugin_Deactivation{
    public function __construct(){
        
    }

    public function remove_cpt_taxonomies(){
        unregister_taxonomy( 'video_project_country' );
        unregister_taxonomy( 'video_project_category' );
        unregister_taxonomy( 'video_project_language' );
        unregister_post_type( 'video_project' );
        flush_rewrite_rules();
    }
}










