<?php
class VPS_Scripts_Initializer{
    public function __construct(){
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_css' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_js' ) );
        //Registers and localizes php array to JS objects for front end
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_localize_js') );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ));
    }

    public function enqueue_css(){
        wp_enqueue_style( 'video_projects_showcase_css', plugins_url( 'css/styles.css', __DIR__) );
    }
    
    public function enqueue_admin_js(){
        wp_enqueue_media();
        wp_enqueue_script( 'vps_admin_media_js', plugins_url( 'js/admin-page-media.js', __DIR__ ),
        array('jquery'), '1.0.0', true);
    }

    public function enqueue_localize_js(){
        wp_enqueue_script( 'vps_video_project_display_js', plugins_url( 'js/video-project-display.js', __DIR__ ),
        array('jquery'), '1.0.0', true);
        
        // Localize script - access php projects array as JS objects 
        $projects = $this->get_video_projects();

        wp_localize_script( 
            //JS file handle
            'vps_video_project_display_js', 
            //array name inside js file
            'videoProjects', 
            //php array name
            $projects
        );
        
    }

    private function get_video_projects(){
        $video_projects_array = [];

        $args = array(
            'post_type' => 'video_project',
            'post_status' => 'publish'
        );
        $results = new WP_Query( $args );

        //check video_project_category taxonomy exists, if not return blank array
        if( !taxonomy_exists( 'video_project_category' ) ){
            return $video_projects_array;
        }

        foreach($results->posts as $project){
            $this_project = [];
            $this_project['title'] = $project->post_title;
            $this_project['category'] = esc_html(
                get_post_meta( $project->ID, 'video_project_category', true)
            );
            $this_project['location'] = esc_html(get_post_meta( $project->ID, 'video_project_location', true));
            $this_project['image'] = esc_html(get_post_meta( $project->ID, 'video_project_image', true));
            $this_project['displaydate'] = esc_html(
                get_post_meta( $project->ID, 
                'video_project_display_date', 
                true
            ));
            $this_project['duration'] = esc_html(get_post_meta( $project->ID, 'video_project_duration', true));
            $this_project['videoid'] = esc_html(get_post_meta( $project->ID, 'video_project_id', true));

            //add this_project to video_projects_array
            array_push($video_projects_array, $this_project);
        }

        return $video_projects_array;

    }
    
}