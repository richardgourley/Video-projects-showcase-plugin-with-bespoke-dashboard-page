<?php

class VPS_Taxonomies_Initializer{
    public function __construct(){
        add_action( 'init', array( $this, 'add_language_taxonomy' ));
        add_action( 'init', array( $this, 'add_category_taxonomy' ));
        add_action( 'init', array( $this, 'add_country_taxonomy' ));
    }
    
    public function add_country_taxonomy(){
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

        register_taxonomy( 'video_project_country', array( "video_project" ), $args_country );
    }

    public function add_category_taxonomy(){
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

        register_taxonomy( 'video_project_category', array( "video_project" ), $args_video_category );
    }

    public function add_language_taxonomy(){
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

        register_taxonomy( 'video_project_language', array( "video_project"), $args_video_project_language );
    }

    public function register_terms(){
        /********
        * Insert initial terms after taxonomies registered
        *********/
        
        //language terms
        if( !term_exists( 'english' )){
            wp_insert_term( 'English', 'video_project_language' );
        }

        if( !term_exists( 'spanish' )){
            wp_insert_term( 'Spanish', 'video_project_language' );
        }

        //country terms
        if( !term_exists( 'germany' )){
            wp_insert_term( 'Germany', 'video_project_country');
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