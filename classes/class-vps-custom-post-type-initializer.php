<?php

class VpsCustomPostTypeInitializer{
    public function __construct(){
        add_action( 'init', array( $this, 'add_video_project_post_type' ));
    }

    public function add_video_project_post_type(){
        $labels = array(
		    "name" => __( "Video Projects" ),
		    "singular_name" => __( "Video Project" ),
		    "menu_name" => __( "Video Project" ),
		    "all_items" => __( "All Video Projects" ),
		    "add_new" => __( "Add New" ),
		    "add_new_item" => __( "Add New Video Project" ),
		    "edit_item" => __( "Edit Video Project" ),
		    "new_item" => __( "New Video Project" ),
		    "view_item" => __( "View Video Project" ),
		    "view_items" => __( "View Video Projects" ),
		    "search_items" => __( "Search Video Projects" ),
		    "not_found" => __( "No Video Projects found" ),
		    "not_found_in_trash" => __( "No Video Projects found in trash" ),
		    "featured_image" => __( "Featured Image for the Video Project" ),
		    "set_featured_image" => __( "Set featured image for this Video Project" ),
		    "remove_featured_image" => __( "Remove featured image for this Video Project" ),
		    "use_featured_image" => __( "Use featured image for this Video Project" ),
		    "archives" => __( "Video Project Archives" ),
		    "insert_into_item" => __( "Insert into Video Project" ),
		    "uploaded_to_this_item" => __( "Uploaded to this Video Project" ),
		    "filter_items_list" => __( "Filter Video Projects" ),
		    "items_list_navigation" => __( "Video Projects list navigation" ),
		    "items_list" => __( "Video Projects list" ),
		    "attributes" => __( "Video Project attributes" ),
	    );
        $args = array(
            "label" => __( "Video Project" ),
		    "labels" => $labels,
		    "description" => "This post type is for users to add and showcase video projects that they have been working on.",
		    "public" => true,
		    "publicly_queryable" => true,
		    "show_ui" => true,
		    "delete_with_user" => false,
		    "show_in_rest" => true,
		    "rest_base" => "",
		    "rest_controller_class" => "WP_REST_Posts_Controller",
		    "has_archive" => false,
		    "show_in_menu" => false,
		    "show_in_nav_menus" => true,
		    "exclude_from_search" => false,
		    "capability_type" => "post",
		    "map_meta_cap" => true,
		    "hierarchical" => false,
		    "rewrite" => array( "slug" => "video_projects", "with_front" => true ),
		    "query_var" => false,
		    "supports" => array( "title", "thumbnail" ),
        );
        register_post_type( 'video_project', $args );
    }

}