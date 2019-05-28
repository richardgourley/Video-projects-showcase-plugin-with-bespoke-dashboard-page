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
            echo "<h2>You have sucsessfully deleted the post titled: " . $result->post_title . "</h2>";
        }

        /*
        $message = $this->get_post_form_errors( $_POST, 'update' );

        //message not blank means message contains FORM ERRORS - re-display form
        if(!$message == ''){
            return $this->re_display_form( 
                $message, 
                $_POST, 
                plugin_dir_path( __DIR__ ) . 'admin-pages/update-video-project-form.php' 
            ); 
        }

        $this->sanitize_fields_assign( 'update' ); //'update' means we have existing post ID

        if($this->fields[ 'country' ] == 'other'){
            $this->insert_new_country_term();

            //assign new country term slug to country field.
            $this->fields[ 'country' ] = 
            get_term_by(
                'name',
                $this->helper->first_letter_upper( $this->fields[ 'new_country' ]), 
                'video_project_country'
            )->slug;
        }

        $this->create_or_update_post_assign_terms( 'update' );
        */
    }

}