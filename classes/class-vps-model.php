<?php

class VPS_Model{
    
    protected $fields;

    public function __construct(){
        //constructor logic
    }
    
    public function display_video_project_form(){
    	//displays form 
    	require_once plugin_dir_path( __DIR__ ) . 'admin-pages/add-video-project-form.php';
    }

    public function insert_video_project( ){
        /*
        * CHECK FORM FOR ERRORS AND SANITIZE/ VALIDATE
        */
        $message = $this->get_post_form_errors( $_POST );
        
        //Re-display form with current inputs and error messages
        if(!$message == ''){
            return $this->re_display_form( $message, $_POST ); 
        }

        //Sanitize fields if no errors exist. Set as array parameters
        $this->fields[ 'language' ] = sanitize_text_field($_POST['video-project-language']);
        $this->fields[ 'video_category' ] = sanitize_text_field($_POST['video-category']);
        $this->fields[ 'country' ] = sanitize_text_field($_POST['country']);
        $this->fields[ 'new_country' ] = sanitize_text_field($_POST['new-country']);
        $this->fields[ 'title' ] = sanitize_text_field($_POST['title']);
        $this->fields[ 'location' ] = sanitize_text_field($_POST['location']);
        $this->fields[ 'date' ] = $_POST['date'];
        $this->fields[ 'duration' ] = sanitize_text_field($_POST['duration']);
        $this->fields[ 'video_project_image' ] = sanitize_url($_POST['video-project-image']);
        $this->fields[ 'video_url' ] = sanitize_url($_POST['video-url']);

        /*
        * INSERT NEW POST HERE
        */

        if($this->fields[ 'country' ] == 'other'){
            //insert new term into the database ($this->fields[ 'new_country' ]);
            if( !term_exists( $this->fields[ 'new_country' ] )){
                wp_insert_term( $this->first_letter_upper($this->fields[ 'new_country' ]), 'country' );
            }
        }
        
        $content = $this->generate_post_content();

        //CHECK IF IS NEW COUNTRY OR EXISTING FOR OUR video_project_country META FIELD
        $post_meta_country = '';
        if($this->fields[ 'country' ] == 'other'){
            $post_meta_country = get_term_by( 'slug', $this->fields['new_country'], 'country' )->name;
        }else{
            $post_meta_country = get_term_by( 'slug', $this->fields[ 'country' ], 'country' )->name;
        }

    
        $post_arr = array(
            'post_title'   => $this->fields[ 'title' ],
            'post_content' => $content,
            'comment_status' => 'closed',
            'post_type' => 'video_project',
            'meta_input' => array(
                'video_project_category' => 
                get_term_by('slug', $this->fields[ 'video_category' ], 'video_category')->name,
                'video_project_country' => 
                $post_meta_country,
                'video_project_location' => $this->fields[ 'location' ],
                'video_project_duration' => $this->fields[ 'duration' ],
                'video_project_date' => $this->fields[ 'date' ],
                'video_project_image' => $this->fields[ 'video_project_image'],
                'video_project_url' => $this->fields[ 'video_url']
            ), 
            'post_status' => 'publish'
        );

        $post_id = wp_insert_post( $post_arr );

        wp_set_object_terms( $post_id, $this->fields['language'], 'video_project_language' );
        wp_set_object_terms( $post_id, $this->fields['video_category'], 'video_category' );
        if($this->fields[ 'country' ] == 'other'){
            wp_set_object_terms( $post_id, $this->first_letter_upper($this->fields[ 'new_country' ]), 'country');
        }else{
            wp_set_object_terms( $post_id, $this->fields['country'], 'country');
        }

        echo '<h3>New post has been succesfully created.</h3>';

    }

    public function view_all_video_projects(){
        //displays all video projects
        $args = array(
            'post_type' => 'video_project',
            'post_status' => 'publish'
        );
        $video_projects = new WP_Query( $args );
        $post_1 = $video_projects->posts[0];
        $post_1_meta = array();
        array_push($post_1_meta, get_post_meta($post_1->ID, 'video_project_duration', true));
        array_push($post_1_meta, get_post_meta($post_1->ID, 'video_project_category', true));
        array_push($post_1_meta, get_post_meta($post_1->ID, 'video_project_country', true));
        
        require_once plugin_dir_path( __DIR__ ) . 'admin-pages/view-all-video-projects.php';
    }
    
    private function get_post_form_errors( $post ){
        $message = "";
        $message .= $this->check_field_filled( $post['video-project-language'], 'Video project language', 'radio');
        $message .= $this->check_field_filled( $post['video_category'], 'Video category', 'radio' );
        $message .= $this->check_field_filled( $post['country'], 'Country', 'radio' );
        if( $post['country'] == 'other' ){
            $message .= $this->check_field_filled( $post['new-country'], 'Other Country', 'text' );
            $message .= $this->check_only_letters( $post['new-country'] );
        }
        $message .= $this->check_field_filled( $post['title'], 'Title', 'text' );
        $message .= $this->check_field_filled( $post['location'], 'Location', 'text' );
        $message .= $this->check_date_validity( $post['date'] );
        $message .= $this->check_field_filled( $post['duration'], 'Duration', 'text' );
        $message .= $this->check_field_filled( $post['video-project-image'], 'Project Image', 'text' );
        $message .= $this->check_field_filled( $post['video-url'], 'Video Url', 'text' );
        return $message;
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

    private function re_display_form( $message, $post ){
        require_once plugin_dir_path( __DIR__ ) . 'admin-pages/redisplay-video-project-form.php';
    }

    private function first_letter_upper( $str ){
        $str[0] = strtoupper($str[0]);
        return $str;
    }

    private function generate_post_content(){

        $category_name = get_term_by('slug', $this->fields[ 'video_category' ], 'video_category')->name;
        $country_name = get_term_by('slug', $this->fields[ 'country' ], 'country')->name;

        $html = '';
        $html .= '<h3>Category: ' . $category_name . '</h3>';
        $html .= '<p>Location: ' . $this->fields[ 'location' ] . ', ' . $country_name . '.</p>';
        $html .= '<img class="vps-image-small" src ="' . $this->fields[ 'video_project_image' ] . '"></img>';
        $html .= '<p>Date: ' . $this->fields[ 'date' ] . '.</p>';
        $html .= '<p>Project duration: ' . $this->fields[ 'duration' ] . '.</p>';
        $vimeo_id = $this->get_vimeo_link( $this->fields['video_url'] );
        $html .= '<iframe src="https://player.vimeo.com/video/' . $vimeo_id . '?color=fdfdfd" width="640" height="300" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
            <p><a href="https://vimeo.com/259695789">VDP Design // Hype Reel</a> from <a href="https://vimeo.com/ablueroomproduction">Blueroom Productions</a> on <a href="https://vimeo.com">Vimeo</a>.</p>';
        return $html;

    }

    private function get_vimeo_link( $vimeo_url ){
        $video_id = $vimeo_url;
        $vid_arr = explode('/', $video_id);
        return $vid_arr[(count($vid_arr)-1)];
    }
}