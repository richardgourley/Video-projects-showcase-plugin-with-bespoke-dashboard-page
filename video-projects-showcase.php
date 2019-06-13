<?php

/*
* Plugin Name: Video Projects Showcase
* Plugin URI: http://wprevs.com
* Description: A plugin to allow a video production company to showcase their projects in a Wordpress site 
via a bespoke dashboard page. 
* Author: wprevs.com
* Version: 1.0.0
* Author URI: http://wprevs.com
* License: GPLv2 or later
*/

//check abspath
if(!defined( 'ABSPATH' )) exit;

require dirname( __FILE__ ) . '/classes-init/class-vps-admin-page-initializer.php';
require dirname( __FILE__ ) . '/classes-init/class-vps-scripts-initializer.php';
require dirname( __FILE__ ) . '/classes-init/class-vps-custom-post-type-initializer.php';
require dirname( __FILE__ ) . '/classes-init/class-vps-taxonomies-initializer.php';
require dirname( __FILE__ ) . '/classes-init/class-vps-page-initializer.php';
require dirname( __FILE__ ) . '/classes-helper/class-vps-helper.php';
require dirname( __FILE__ ) . '/classes-deactivate/class-vps-deactivation.php';

//registers css and js scripts on activation
$vps_scripts_initializer = new VPS_Scripts_Initializer();

//registers taxonomies on activation
$vps_taxonomies_initializer = new VPS_Taxonomies_Initializer();

//inserts terms - on plugin activation
register_activation_hook( __FILE__, array( $vps_taxonomies_initializer, 'add_terms' ));

//register custom post type
$vps_custom_post_type_initializer = new VPS_Custom_Post_Type_Initializer();

//flush rewrites rules on activation
register_activation_hook( __FILE__, array( $vps_custom_post_type_initializer, 'register_post_type_activation' ));

//initializes admin page in dashboard
$vps_admin_page_initializer = new VPS_Admin_Page_Initializer();

//creates a new archive page - on plugin activation
$vps_page_initializer = new VPS_Page_Initializer();
register_activation_hook( __FILE__, array( $vps_page_initializer, 'create_video_project_page' ));

$vps_plugin_deactivation = new VPS_Plugin_Deactivation();
register_deactivation_hook( __FILE__, array( $vps_plugin_deactivation, 'remove_cpt_taxonomies' ));


