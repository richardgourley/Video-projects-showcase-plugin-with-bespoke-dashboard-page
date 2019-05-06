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

require dirname( __FILE__ ) . '/classes/AdminPageInitializer.php';
require dirname( __FILE__ ) . '/classes/ScriptsInitializer.php';
require dirname( __FILE__ ) . '/classes/CustomPostTypeInitializer.php';
require dirname( __FILE__ ) . '/classes/TaxonomiesInitializer.php';


//initializes admin page in dashboard
$vps_admin_page_initializer = new VpsAdminPageInitializer();

//initializes css and js scripts
$vps_scripts_initializer = new VpsScriptsInitializer();

//initializes custom post type
$vps_custom_post_type_initializer = new VpsCustomPostTypeInitializer();


//initializes taxonomies
$vps_taxonomies_initializer = new VpsTaxonomiesInitializer();
