<?php

class VPS_Create extends VPS_Model{

    protected $fields;
    protected $helper;

    public function __construct( $helper_class ){
        //constructor logic
        $this->helper = $helper_class;
    }
    
    public function create_video_project_form(){
    	require_once dirname( __DIR__ ) . '/admin-pages/create-video-project-form.php';
    }
    
    public function create_video_project(){
        //Assign any form validation errors to $message variable
        //'create' parameter = no existing ID number (creating a new post)
        $message = $this->get_post_form_errors( $_POST, 'create' );

        //Re-display create form if error messages exist
        if(!$message == ''){
            return $this->re_display_form( 
                $message, 
                $_POST, 
                plugin_dir_path( __DIR__ ) . 'admin-pages/re-display-create-video-project-form.php' 
            ); 
        }
        
        //sanitize fields and assign to $fields array property
        $this->sanitize_fields_assign( $_POST, 'create' );
        
        //if country is other, insert as new term in db
        if($this->fields[ 'country' ] == 'other'){
            //insert new term from $this->fields['new_country']
            $this->insert_new_country_term();
            //get the slug of term in line above, assign to $this->fields['country']
            $this->fields[ 'country' ] = 
            get_term_by(
                'name',
                $this->helper->first_letter_upper( $this->fields[ 'new_country' ]), 
                'country'
            )->slug;
        }

        //Finally, create new post and set terms for the object.
        $this->create_or_update_post_assign_terms( 'create' );
    }

}