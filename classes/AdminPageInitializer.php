<?php

class VpsAdminPageInitializer{
    public function __construct(){
        add_action( 'admin_menu', array( $this, 'add_video_project_admin_page' ));
    }

    public function add_video_project_admin_page(){
        add_menu_page( 'Video Project', 'Manage Video Projects', 'manage_options', 'video_project', array( $this, 'video_project_admin_page_callback' ));
    }

    public function video_project_admin_page_callback(){
    	//displays main admin page in dashboard.
        require_once plugin_dir_path( __DIR__ ) . '/admin_pages/main.php';
        require_once plugin_dir_path( __DIR__ ) . '/classes/Model.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //loads add video project form
        	if(isset($_POST['add_video_project_nonce']) && wp_verify_nonce($_POST['add_video_project_nonce'], 'add_video_project_action')){
        		$model = new VpsModel();
        		$model->display_video_project_form();
        	}

            //handles insert video project logic
            if(isset($_POST['insert_video_project_form_nonce']) && wp_verify_nonce($_POST['insert_video_project_form_nonce'], 'insert_video_project_form_action')){
                $model = new VpsModel();
                $model->insert_video_project( );
            }
        }
    }

}










