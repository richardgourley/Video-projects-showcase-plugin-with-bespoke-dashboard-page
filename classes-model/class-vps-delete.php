<?php

class VPS_Delete extends VPS_Model{
    
    protected $fields;
    protected $helper;

    public function __construct( $helper_class ){
        //constructor logic
        $this->helper = $helper_class;
    }

    public function delete_video_project_form(){
        //displays all video projects
        $args = array(
            'post_type' => 'video_project',
            'post_status' => 'publish'
        );
        $video_projects = new WP_Query( $args );
        require_once dirname( __DIR__ ) . '/admin-pages/delete-video-project-form.php';
    }

    public function delete_video_project(){

        $post_id = $_POST['id'];
        $result = wp_delete_post( $post_id, true );
        
        if($result){
            echo "<h2>You have successfully deleted the post titled: " . $result->post_title . "</h2>";
        }

    }

}