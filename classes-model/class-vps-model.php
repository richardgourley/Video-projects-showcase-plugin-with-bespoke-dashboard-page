<?php

abstract class VPS_Model{
    
    protected function get_post_form_errors( $post, $action ){
        $message = "";
        if( $action == 'update'){
            $message .= $this->helper->check_field_filled( $post[ 'id' ], 'ID', 'text' );
            $message .= $this->helper->is_a_number($post[ 'id' ], 'ID', 'text' );
        }
        $message .= $this->helper->check_field_filled( $post['language'], 'Video project language', 'radio');
        $message .= $this->helper->check_field_filled( $post['category'], 'Video category', 'radio' );
        $message .= $this->helper->check_field_filled( $post['country'], 'Country', 'radio' );
        if( $post['country'] == 'other' ){
            $message .= $this->helper->check_field_filled( $post['new-country'], 'Other Country', 'text' );
            $message .= $this->helper->check_only_letters( $post['new-country'] );
        }
        $message .= $this->helper->check_field_filled( $post['title'], 'Title', 'text' );
        $message .= $this->helper->check_field_filled( $post['location'], 'Location', 'text' );
        $message .= $this->helper->check_date_validity( $post['date'] );
        $message .= $this->helper->check_field_filled( $post['duration'], 'Duration', 'text' );
        $message .= $this->helper->check_field_filled( $post['image-url'], 'Project Image', 'text' );
        $message .= $this->helper->check_field_filled( $post['video-url'], 'Video Url', 'text' );
        return $message;
    }

    protected function re_display_form( $message, $post, $path ){
        require_once $path;
    }

    protected function sanitize_fields_assign( $action ){

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

    protected function insert_new_country_term(){
        wp_insert_term( 
            $this->helper->first_letter_upper($this->fields[ 'new_country' ]), 
            'video_project_country' 
        );
    }

    protected function create_or_update_post_assign_terms( $action ){
        $content = $this->generate_post_content();
        
        var_dump($this->fields);
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

        if($action == 'create'){
            echo '<h3>YOUR NEW VIDEO PROJECT HAS BEEN SUCSESSFULLY CREATED.</h3>';
        }else{
            echo '<h3>YOUR VIDEO PROJECT HAS BEEN SUCSESSFULLY UPDATED.</h3>';
        }
        
    }

    protected function generate_post_content(){
        
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
        $vimeo_id = $this->helper->get_vimeo_id( $this->fields[ 'video_url' ] );
        $html .= '<iframe src="https://player.vimeo.com/video/' . $vimeo_id . '?color=fdfdfd" width="640" height="300" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
        return $html;

    }

}