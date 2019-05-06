<?php

class VpsTaxonomiesInitializer{
    public function __construct(){
        add_action( 'init', array( $this, 'add_video_project_taxonomies' ));
    }

    public function add_video_project_taxonomies(){
        $labels_country = array(
            "name" => __( "Country" ),
             "singular_name" => __( "Country" ),
        );

        $args_country = array(
            "label" => __( "Country" ),
            "labels" => $labels_country,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => false,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'countries', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => true,
            "rest_base" => "countries",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "show_in_quick_edit" => false,
        );

        $labels_video_category = array(
            "name" => __( "Video category" ),
             "singular_name" => __( "Video category" ),
        );

        $args_video_category = array(
            "label" => __( "Video category" ),
            "labels" => $labels_video_category,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => false,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array( 'slug' => 'video_categories', 'with_front' => true, ),
            "show_admin_column" => false,
            "show_in_rest" => true,
            "rest_base" => "video_category",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "show_in_quick_edit" => false,
        );

        register_taxonomy( 'country', array( "video_project" ), $args_country );
        register_taxonomy( 'video_category', array( "video_project" ), $args_video_category );
        /*
        $labels_video_type = array();
        $args_video_type = array();
        register_taxonomy( 'video_type', $args_video_type);
        */
    }

}