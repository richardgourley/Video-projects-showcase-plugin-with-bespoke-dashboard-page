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
    }

}










