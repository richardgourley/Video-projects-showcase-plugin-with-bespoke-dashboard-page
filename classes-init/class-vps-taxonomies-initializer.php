<?php

class VPS_Taxonomies_Initializer{
    public function __construct(){
        add_action( 'init', array( $this, 'add_video_project_taxonomies' ));
    }

    public function add_terms(){
        $this->add_video_project_taxonomies();
        $this->register_terms();
    }
    
    public function add_video_project_taxonomies(){
        $labels_video_project_category = array(
            "name" => __( "Video Project Category" ),
             "singular_name" => __( "Video Project Category" ),
        );

        $args_video_project_category = array(
            "label" => __( "Video Project Category" ),
            "labels" => $labels_video_project_category,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => true,
            "show_ui" => false,
            "show_in_menu" => false,
            "show_in_nav_menus" => false,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'video-project-categories', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => true,
            "rest_base" => "video_project_category",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "show_in_quick_edit" => false,
        );

        register_taxonomy( 'video_project_category', array( "video_project" ), $args_video_project_category );

        $labels_video_project_country = array(
            "name" => __( "Video Project Country" ),
             "singular_name" => __( "Video Project Country" ),
        );

        $args_video_project_country = array(
            "label" => __( "Video Project Country" ),
            "labels" => $labels_video_project_country,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => true,
            "show_ui" => false,
            "show_in_menu" => false,
            "show_in_nav_menus" => false,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'video-project-countries', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => true,
            "rest_base" => "video_project_country",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "show_in_quick_edit" => false,
        );

        register_taxonomy( 'video_project_country', array( "video_project" ), $args_video_project_country );
    }

    public function register_terms(){
        /********
        * Insert initial terms after taxonomies registered
        *********/

        //country terms
        if( !term_exists( 'germany' )){
            wp_insert_term( 'Germany', 'video_project_country' );
        }

        if( !term_exists( 'ireland' )){
            wp_insert_term( 'Ireland', 'video_project_country' );
        }     

        if( !term_exists( 'spain' )){
            wp_insert_term( 'Spain', 'video_project_country' );
        }

        //category terms
        if( !term_exists( 'wedding' )){
            wp_insert_term( 'Wedding', 'video_project_category' );
        }

        if( !term_exists( 'commercial' )){
            wp_insert_term( 'Commercial', 'video_project_category' );
        }

        if( !term_exists( 'music-video' )){
            wp_insert_term( 'Music Video', 'video_project_category' );
        }
    }

}