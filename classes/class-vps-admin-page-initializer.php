<?php

class VPS_Admin_Page_Initializer{
    public function __construct(){
        add_action( 'admin_menu', array( $this, 'add_video_project_admin_page' ));
    }

    public function add_video_project_admin_page(){
        add_menu_page( 'Video Project', 'Manage Video Projects', 'manage_options', 'video-project', 
            array( $this, 'video_project_admin_page_callback' ));
    }

    public function video_project_admin_page_callback(){
    	//displays main admin page in dashboard.
        require_once plugin_dir_path( __DIR__ ) . '/admin-pages/main.php';
        require_once plugin_dir_path( __DIR__ ) . '/classes/class-vps-model.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //loads add video project form
        	if(isset($_POST['add-video-project-nonce']) 
            && wp_verify_nonce($_POST[ 'add-video-project-nonce' ], 'add-video-project-action')){
        		$model = new VPS_Model();
        		$model->display_video_project_form();
        	}

            //handles insert video project logic
            if(isset($_POST['insert-video-project-form-nonce']) 
            && wp_verify_nonce($_POST['insert-video-project-form-nonce'], 'insert-video-project-form-action')){
                $model = new VPS_Model();
                $model->insert_video_project( );
            }
        }
    }

}










