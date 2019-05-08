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
        $this->field_is_blank( $_POST );
        /*var_dump(taxonomy_exists('country'));
        var_dump(taxonomy_exists('video_category'));
        global $wp_taxonomies;
        var_dump($wp_taxonomies);
        var_dump(term_exists('Uncategorized', 'category'));*/
    }

    private function field_is_blank( $post ){
        foreach($post as $k => $v){
            echo "<br>" . $k . " -> " . $v;
        }
    }

}