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

require dirname( __FILE__ ) . '/classes/class-vps-admin-page-initializer.php';
require dirname( __FILE__ ) . '/classes/class-vps-scripts-initializer.php';
require dirname( __FILE__ ) . '/classes/class-vps-custom-post-type-initializer.php';
require dirname( __FILE__ ) . '/classes/class-vps-taxonomies-initializer.php';

//initializes css and js scripts
$vps_scripts_initializer = new VPS_Scripts_Initializer();

//initializes custom post type
$vps_custom_post_type_initializer = new VPS_Custom_Post_Type_Initializer();

//initializes taxonomies
$vps_taxonomies_initializer = new VPS_Taxonomies_Initializer();

//initializes admin page in dashboard
$vps_admin_page_initializer = new VPS_Admin_Page_Initializer();


