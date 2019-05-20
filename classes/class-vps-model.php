<?php

class VPS_Model{
    
    protected $fields;

    public function __construct(){
        //constructor logic
    }
    
    public function create_video_project_form(){
    	require_once plugin_dir_path( __DIR__ ) . 'admin-pages/create-video-project-form.php';
    }

    public function update_video_project_form(){
        require_once plugin_dir_path( __DIR__ ) . 'admin-pages/update-video-project-form.php';
    }
    
    public function create_video_project(){
        //Assign any form validation errors to $message variable
        //'create' parameter = no existing ID number (creating a new post)
        $message = $this->get_post_form_errors( $_POST, 'create' );

        //Re-display create form if error messages exist
        if(!$message == ''){
            return $this->re_display_create_video_project_form( $message, $_POST ); 
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
                $this->first_letter_upper( $this->fields[ 'new_country' ]), 
                'country'
            )->slug;
        }

        //Finally, create new post and set terms for the object.
        $this->create_or_update_post_assign_terms( 'create' );
    }

    public function update_video_project(){
        $message = $this->get_post_form_errors( $_POST, 'update' );

        if(!$message == ''){
            return $this->re_display_update_video_project_form( $message, $_POST ); 
        }

        $this->sanitize_fields_assign( $_POST, 'update' ); //'update' means we have existing post ID

        if($this->fields[ 'country' ] == 'other'){
            $this->insert_new_country_term();

            //assign new country term slug to country field.
            $this->fields[ 'country' ] = 
            get_term_by(
                'name',
                $this->first_letter_upper( $this->fields[ 'new_country' ]), 
                'country'
            )->slug;
        }

        $this->create_or_update_post_assign_terms( 'update' );
    }

    public function view_all_video_projects(){
        //displays all video projects
        $args = array(
            'post_type' => 'video_project',
            'post_status' => 'publish'
        );
        $video_projects = new WP_Query( $args );
        
        require_once plugin_dir_path( __DIR__ ) . 'admin-pages/view-all-video-projects.php';
    }
    
    private function get_post_form_errors( $post, $action ){
        $message = "";
        if( $action == 'update'){
            $message .= $this->check_field_filled( $post[ 'id' ], 'ID', 'text' );
            $message .= $this->is_a_number($post[ 'id' ], 'ID', 'text' );
        }
        $message .= $this->check_field_filled( $post['language'], 'Video project language', 'radio');
        $message .= $this->check_field_filled( $post['category'], 'Video category', 'radio' );
        $message .= $this->check_field_filled( $post['country'], 'Country', 'radio' );
        if( $post['country'] == 'other' ){
            $message .= $this->check_field_filled( $post['new-country'], 'Other Country', 'text' );
            $message .= $this->check_only_letters( $post['new-country'] );
        }
        $message .= $this->check_field_filled( $post['title'], 'Title', 'text' );
        $message .= $this->check_field_filled( $post['location'], 'Location', 'text' );
        $message .= $this->check_date_validity( $post['date'] );
        $message .= $this->check_field_filled( $post['duration'], 'Duration', 'text' );
        $message .= $this->check_field_filled( $post['image-url'], 'Project Image', 'text' );
        $message .= $this->check_field_filled( $post['video-url'], 'Video Url', 'text' );
        return $message;
    }

    private function re_display_create_video_project_form( $message, $post ){
        require_once plugin_dir_path( __DIR__ ) . 'admin-pages/re-display-create-video-project-form.php';
    }

    private function re_display_update_video_project_form( $message, $post ){
        require_once plugin_dir_path( __DIR__ ) . 'admin-pages/update-video-project-form.php';
    }

    private function sanitize_fields_assign( $action ){
        if( $action == 'update'){
            $this->fields[ 'id' ] = sanitize_text_field( $_POST[ 'id' ]);
        }
        $this->fields[ 'language' ] = sanitize_text_field($_POST['language']);
        $this->fields[ 'category' ] = sanitize_text_field($_POST['category']);
        $this->fields[ 'country' ] = sanitize_text_field($_POST['country']);
        $this->fields[ 'new_country' ] = sanitize_text_field($_POST['new-country']);
        $this->fields[ 'title' ] = sanitize_text_field($_POST['title']);
        $this->fields[ 'location' ] = sanitize_text_field($_POST['location']);
        $this->fields[ 'date' ] = $_POST['date']; //date validity previously checked
        $this->fields[ 'duration' ] = sanitize_text_field($_POST['duration']);
        $this->fields[ 'image_url' ] = sanitize_url($_POST['image-url']);
        $this->fields[ 'video_url' ] = sanitize_url($_POST['video-url']);

    }

    private function insert_new_country_term(){
        wp_insert_term( $this->first_letter_upper($this->fields[ 'new_country' ]), 'country' );
    }

    private function create_or_update_post_assign_terms( $action ){
        $content = $this->generate_post_content();
        
        //NOTE: We retrieve term name from term slug - use name for display purposes.
        $post_arr = array(
            'post_title'   => $this->fields[ 'title' ],
            'post_content' => $content,
            'post_date' => $this->fields[ 'date' ],
            'comment_status' => 'closed',
            'post_type' => 'video_project',
            'meta_input' => array(
                'video_project_category' => 
                get_term_by('slug', $this->fields[ 'category' ], 'video_project_category')->name,
                'video_project_country' => 
                get_term_by( 'slug', $this->fields[ 'country' ], 'video_project_country' )->name,
                'video_project_location' => $this->fields[ 'location' ],
                'video_project_duration' => $this->fields[ 'duration' ],
                'video_project_date' => $this->fields[ 'date' ],
                'video_project_image' => $this->fields[ 'image_url'],
                'video_project_url' => $this->fields[ 'video_url']
            ), 
            'post_status' => 'publish'
        );
        
        $post_id = '';

        //If action is update, add existing ID to $post_arr
        if( $action == 'update'){
            $post_arr[ 'ID' ] = $this->fields[ 'id' ];
            $post_id = $this->fields[ 'id' ];
            wp_update_post( $post_arr );
        }else{
            $post_id = wp_insert_post( $post_arr );
        }

        //use post id to set object terms
        wp_set_object_terms( $post_id, $this->fields['language'], 'video_project_language' );
        wp_set_object_terms( $post_id, $this->fields['category'], 'video_project_category' );
        wp_set_object_terms( $post_id, $this->fields['country'], 'video_project_country');

        echo '<h3>New post has been succesfully created.</h3>';
    }

    private function check_field_filled( $var, $name, $type ){
        if($var === '' && $type == 'radio'){
            return "<br />$name must be selected.";
        }else if($var === '' && $type == 'text'){
            return "<br />$name field must not be blank.";
        }else{
            return '';
        }
    }

    private function is_a_number( $var, $name){
        if(!is_numeric( $var )){
            return "<br />$name entered is not a number.";
        }else{
            return '';
        }
    }
    
    private function check_date_validity( $date ){
    
        if($date === ''){
            return "<br />Date field must not be blank";
        }

        $date_arr = explode( '-', $date);

        if(!strlen($date_arr[0]) == 4 || preg_match('/[a-z@,!]/i', $date)){
            return "<br />Your date is not valid. Check it is in YYYY-MM-DD format";
        }
    
        if(!wp_checkdate($date_arr[1], $date_arr[2], $date_arr[0], $date)){
            return "<br />Your date is not valid. Check it is in YYYY-MM-DD format";
        }
    
        return '';
    }

    private function check_only_letters( $country ){
        //country field is blank already checked, ok if blank
        if(preg_match('/^[a-z\s]+$/i', $country) || $country === ''){
            return '';
        }else{
            return "<br />Country field can only contain letters.";
        }
    }

    private function first_letter_upper( $str ){
        $str[0] = strtoupper($str[0]);
        return $str;
    }

    private function generate_post_content(){
        
        //use name instead of slug for presentation.
        $category_name = get_term_by(
            'slug', 
            $this->fields[ 'category' ], 
            'video_project_category'
        )->name;

        $country_name = get_term_by('slug', $this->fields[ 'country' ], 'video_project_country')->name;
        
        $html = '';
        $html .= '<h3>Category: ' . $category_name . '</h3>';
        $html .= '<p>Location: ' . $this->fields[ 'location' ] . ', ' . $country_name . '.</p>';
        $html .= '<img class="vps-image-small" src ="' . $this->fields[ 'image_url' ] . '"></img>';
        $html .= '<p>Date: ' . $this->fields[ 'date' ] . '.</p>';
        $html .= '<p>Project duration: ' . $this->fields[ 'duration' ] . '.</p>';
        $vimeo_id = $this->get_vimeo_id( $this->fields[ 'video_url' ] );
        $html .= '<iframe src="https://player.vimeo.com/video/' . $vimeo_id . '?color=fdfdfd" width="640" height="300" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
        return $html;

    }

    private function get_vimeo_id( $vimeo_url ){
        $video_id = $vimeo_url;
        $vid_arr = explode('/', $video_id);
        return $vid_arr[(count($vid_arr)-1)];
    }
}