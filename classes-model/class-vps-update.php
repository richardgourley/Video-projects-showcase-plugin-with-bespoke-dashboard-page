<?php

class VPS_Update extends VPS_Model{
    
    protected $fields;
    protected $helper;

    public function __construct( $helper_class ){
        //constructor logic
        $this->helper = $helper_class;
    }

    public function update_video_project_form(){
        require_once dirname( __DIR__ ) . '/admin-pages/update-video-project-form.php';
    }

    public function update_video_project(){
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
    }

}