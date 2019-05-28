<?php
class VPS_Scripts_Initializer{
    public function __construct(){
        //enqueue scripts here
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_css' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_js' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_js') );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ));
    }

    public function enqueue_css(){
        wp_enqueue_style( 'video_projects_showcase_css', plugins_url( 'css/styles.css', __DIR__) );
    }
    
    public function enqueue_admin_js(){
        wp_enqueue_script( 'vps_admin_add_form_js', plugins_url( 'js/admin-page-add-video-project-form.js', __DIR__ ),
        array(), '1.0.0', true );
        wp_enqueue_script( 'vps_admin_media_js', plugins_url( 'js/admin-page-media.js', __DIR__ ),
        array('jquery'), '1.0.0', true);
    }

    public function enqueue_js(){
        wp_enqueue_script( 'vps_video_project_display_js', plugins_url( 'js/video-project-display.js', __DIR__ ),
        array('jquery'), '1.0.0', true);
        
        $projects = $this->get_video_projects();

        wp_localize_script( 
            'vps_video_project_display_js', 
            'videoProjects', 
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
        if(!taxonomy_exists( 'video_project_category' )){
            return $video_projects_array;
        }

        foreach($results->posts as $project){
            $this_project = [];
            $this_project['title'] = $project->post_title;
            $this_project['content'] = $project->post_content;
            $this_project['category'] = get_the_terms( $project->ID, 'video_project_category' )[0]->name;

            //add this_project to video_projects_array
            array_push($video_projects_array, $this_project);
        }

        return $video_projects_array;

    }
    
}