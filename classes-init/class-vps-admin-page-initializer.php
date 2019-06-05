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
        require_once dirname( __DIR__ ) . '/admin-pages/main.php';
        require_once dirname( __DIR__ ) . '/classes-model/class-vps-model.php';
        require_once dirname( __DIR__ ) . '/classes-model/class-vps-create.php';
        require_once dirname( __DIR__ ) . '/classes-model/class-vps-update.php';
        require_once dirname( __DIR__ ) . '/classes-model/class-vps-view-all.php';
        require_once dirname( __DIR__ ) . '/classes-model/class-vps-delete.php';
        require_once dirname( __DIR__ ) . '/classes-helper/class-vps-helper.php';

        $helper_class = new VPS_Helper();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //loads create video project form
        	if( isset($_POST['create-video-project-form-nonce'] ) 
            && wp_verify_nonce($_POST[ 'create-video-project-form-nonce' ], 'create-video-project-form-action')){
        		$model = new VPS_Create( $helper_class );
        		$model->create_video_project_form();
                
        	}

            //when create form is completed, pass $_POST array to be handled by create_video_project
            if( isset($_POST['create-video-project-nonce'] ) 
            && wp_verify_nonce($_POST['create-video-project-nonce'], 'create-video-project-action')){
                $model = new VPS_Create( $helper_class );
                $model->create_video_project( );
            }

            //displays all video projects with update buttons
            if(isset( $_POST['view-all-video-projects-nonce'] ) 
            && wp_verify_nonce($_POST[ 'view-all-video-projects-nonce' ], 'view-all-video-projects-action')){
                $model = new VPS_View_All( );
                $model->view_all_video_projects();
            }

            //when UPDATE is clicked for a video project, we load update video project form
            if(isset( $_POST['update-video-project-form-nonce'] ) 
            && wp_verify_nonce($_POST[ 'update-video-project-form-nonce' ], 'update-video-project-form-action')){
                $model = new VPS_Update( $helper_class );
                $model->update_video_project_form();
            }

            //when update form is completed, pass $_POST array to be handled by update video project
            if(isset( $_POST['update-video-project-nonce'] ) 
            && wp_verify_nonce($_POST[ 'update-video-project-nonce' ], 'update-video-project-action')){
                $model = new VPS_Update( $helper_class );
                $model->update_video_project();
            }

            //when delete project is selected, displays all projects with delete button as an option
            if(isset( $_POST['delete-video-project-form-nonce'] ) 
            && wp_verify_nonce($_POST[ 'delete-video-project-form-nonce' ], 'delete-video-project-form-action')){
                $model = new VPS_Delete( $helper_class );
                $model->delete_video_project_form();
            }

            //when delete is clicked, process deletion of video project.
            if(isset( $_POST['delete-video-project-nonce'] ) 
            && wp_verify_nonce($_POST[ 'delete-video-project-nonce' ], 'delete-video-project-action')){
                $model = new VPS_Delete( $helper_class );
                $model->delete_video_project();
            }
        }
    }

}










