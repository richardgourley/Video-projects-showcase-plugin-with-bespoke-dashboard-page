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
        require_once plugin_dir_path( __DIR__ ) . '/classes/init/class-vps-model.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //loads create video project form
        	if( isset($_POST['create-video-project-form-nonce'] ) 
            && wp_verify_nonce($_POST[ 'create-video-project-form-nonce' ], 'create-video-project-form-action')){
        		$model = new VPS_Model();
        		$model->create_video_project_form();
        	}

            //when create form is completed, pass $_POST array to be handled by create_video_project
            if( isset($_POST['create-video-project-nonce'] ) 
            && wp_verify_nonce($_POST['create-video-project-nonce'], 'create-video-project-action')){
                $model = new VPS_Model();
                $model->create_video_project( );
            }

            //displays all video projects with update buttons
            if(isset( $_POST['view-all-video-projects-nonce'] ) 
            && wp_verify_nonce($_POST[ 'view-all-video-projects-nonce' ], 'view-all-video-projects-action')){
                $model = new VPS_Model();
                $model->view_all_video_projects();
            }

            //when UPDATE is clicked for a video project, we load update video project form
            if(isset( $_POST['update-video-project-form-nonce'] ) 
            && wp_verify_nonce($_POST[ 'update-video-project-form-nonce' ], 'update-video-project-form-action')){
                $model = new VPS_Model();
                $model->update_video_project_form();
            }

            //when update form is completed, pass $_POST array to be handled by update video project
            if(isset( $_POST['update-video-project-nonce'] ) 
            && wp_verify_nonce($_POST[ 'update-video-project-nonce' ], 'update-video-project-action')){
                $model = new VPS_Model();
                $model->update_video_project();
            }
        }
    }

}










