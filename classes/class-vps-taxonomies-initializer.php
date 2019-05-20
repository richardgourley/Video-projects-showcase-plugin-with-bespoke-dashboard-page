<?php

class VPS_Taxonomies_Initializer{
    public function __construct(){
        add_action( 'init', array( $this, 'add_video_project_taxonomies' ));
        
    }

    public function add_video_project_taxonomies(){
        $labels_video_project_country = array(
            "name" => __( "Video Project Country" ),
             "singular_name" => __( "Video Project Country" ),
        );

        $args_video_project_country = array(
            "label" => __( "Video Project Country" ),
            "labels" => $labels_video_project_country,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => false,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'video_project_countries', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => true,
            "rest_base" => "video_project_country",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "show_in_quick_edit" => false,
        );

        $labels_video_project_category = array(
            "name" => __( "Video Project Category" ),
             "singular_name" => __( "Video Project Category" ),
        );

        $args_video_project_category = array(
            "label" => __( "Video Project Category" ),
            "labels" => $labels_video_project_category,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => false,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'video_project_categories', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => true,
            "rest_base" => "video_project_category",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "show_in_quick_edit" => false,
        );

        $labels_video_project_language = array(
            "name" => __( "Video Project Language" ),
            "singular_name" => __( "Video Project Language" ),
        );

        $args_video_project_language = array(
            "label" => __( "Video Project Language" ),
            "labels" => $labels_video_project_language,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => false,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'video_project_languages', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => true,
            "rest_base" => "video_project_language",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "show_in_quick_edit" => false,
        );

        register_taxonomy( 'video_project_country', array( "video_project" ), $args_country );
        register_taxonomy( 'video_project_category', array( "video_project" ), $args_video_category );
        register_taxonomy( 'video_project_language', array( "video_project"), $args_video_project_language );

        //insert terms after taxonomies registered
        /*
        if( !term_exists( 'english' )){
            wp_insert_term( 'English', 'video_project_language' );
        }
        */
        
    }

}