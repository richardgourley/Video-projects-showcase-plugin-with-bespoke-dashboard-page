<?php

abstract class VPS_Model{
    
    protected function get_post_form_errors( $post, $action ){
        $message = "";
        if( $action == 'update'){
            $message .= $this->helper->check_field_filled( $post[ 'id' ], 'ID', 'text' );
            $message .= $this->helper->is_a_number($post[ 'id' ], 'ID', 'text' );
        }
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
        $message .= $this->helper->check_valid_url( $post['image-url'], 'Image Url', 'text' );
        $message .= $this->helper->check_valid_url( $post['video-url'], 'Video Url', 'text' );

        return $message;
    }

    protected function re_display_form( $message, $post, $path ){
        require_once $path;
    }

    protected function sanitize_fields_assign( $action ){

        if( $action == 'update'){
            $this->fields[ 'id' ] = sanitize_text_field( $_POST[ 'id' ]);
        }

        $this->fields[ 'category_slug' ] = sanitize_text_field($_POST['category']);
        $this->fields['category_name'] = esc_html(
            get_term_by( 
                'slug', 
                $this->fields['category_slug'], 
                'video_project_category' )->name 
        );

        if($_POST['country'] == 'other'){
            $new_country = sanitize_text_field($_POST['new-country']);
            wp_insert_term(
                $this->helper->first_letter_upper( $new_country ),
                'video_project_country'
            );
            $this->fields['country_name'] = $this->helper->first_letter_upper( $new_country );
            $this->fields['country_slug'] = esc_html(
            get_term_by(
                'name', 
                $this->fields['country_name'], 
                'video_project_country' )->slug 
            );    
        }else{
            $this->fields[ 'country_slug' ] = sanitize_text_field($_POST['country']);
            $this->fields[ 'country_name' ] = esc_html(
            get_term_by(
                'slug', 
                $this->fields['country_slug'], 
                'video_project_country' )->name 
            );
        }

        $this->fields[ 'title' ] = sanitize_text_field($_POST['title']);
        $this->fields[ 'location' ] = sanitize_text_field($_POST['location']);
        $this->fields[ 'date' ] = $_POST['date']; //date validity previously checked
        //display_date will show 'May 2019' instead of '2019-05-01'
        $this->fields[ 'display_date' ] = $this->helper->convert_date_to_month_year( $this->fields[ 'date' ] );
        $this->fields[ 'duration' ] = sanitize_text_field($_POST['duration']);
        $this->fields[ 'image_url' ] = esc_url_raw($_POST['image-url']);
        $this->fields[ 'video_url' ] = esc_url_raw($_POST['video-url']);
        //vimeo video id extracted from the url, to be displayed in iFrame
        $this->fields[ 'video_id' ] = $this->helper->get_vimeo_id( $this->fields[ 'video_url' ]);

    }

    protected function create_or_update_post_assign_terms( $action ){
        $content = $this->generate_post_content();
        
        //NOTE: We retrieve term name from term slug - use name for display purposes.
        $post_arr = array(
            'post_title'   => $this->fields[ 'title' ],
            'post_content' => $content,
            'post_date' => $this->fields[ 'date' ],
            'post_date_gmt' => $this->fields[ 'date' ],
            'comment_status' => 'closed',
            'post_type' => 'video_project',
            'meta_input' => array(
                'video_project_category_name' => $this->fields['category_name'],
                'video_project_category_slug' => $this->fields['category_slug'],
                'video_project_country_name' => $this->fields['country_name'],
                'video_project_country_slug' => $this->fields['country_slug'],
                'video_project_location' => $this->fields[ 'location' ],
                'video_project_duration' => $this->fields[ 'duration' ],
                'video_project_date' => $this->fields[ 'date' ],
                'video_project_display_date' => $this->fields[ 'display_date' ],
                'video_project_image' => $this->fields[ 'image_url'],
                'video_project_url' => $this->fields[ 'video_url'],
                'video_project_id' => $this->fields[ 'video_id' ]
            ), 
            'post_status' => 'publish'
        );
        
        $post_id = '';

        //Update = update with existing ID, Else create = insert a new post
        if( $action == 'update'){
            $post_arr[ 'ID' ] = $this->fields[ 'id' ];
            $post_id = $this->fields[ 'id' ];
            wp_update_post( $post_arr );
        }else{
            $post_id = wp_insert_post( $post_arr );
        }

        //use post id to set object terms
        wp_set_object_terms( $post_id, $this->fields['category_slug'], 'video_project_category' );
        wp_set_object_terms( $post_id, $this->fields['country_slug'], 'video_project_country');

        if($action == 'create'){
            echo '<h3>YOUR NEW VIDEO PROJECT HAS BEEN SUCCESSFULLY CREATED.</h3>';
        }else{
            echo '<h3>YOUR VIDEO PROJECT HAS BEEN SUCCESSFULLY UPDATED.</h3>';
        }
        
    }

    protected function generate_post_content(){

        $html = '';
        
        $html .= '<div class="vps-project-display-post-div">';

        $html .= '<p class="vps-noto-sans-font">Category: ' . $this->fields['category_name'] . '</p>';
        $html .= '<p class="vps-noto-sans-font">Location: ' . $this->fields['location'] . ', ';
        $html .= $this->fields['country_name'] . '</p>';

        $html .= '<p class="vps-noto-sans-font">Date: ' . $this->fields['display_date'] . '</p>';
        $html .= '<p class="vps-noto-sans-font">Duration: ' . $this->fields['duration'] . '</p>';

        $html .= '<iframe class="vps-iframe" src="https://player.vimeo.com/video/';
        $html .= $this->fields['video_id'];
        $html .= '?color=fdfdfd" width="640" height="300" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';

        $html .= '</div>'; //end fullwidth container

        return $html;
  
    }

}