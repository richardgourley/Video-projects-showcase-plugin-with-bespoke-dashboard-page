<?php

/*
* Plugin Name: Video Projects Showcase
* Plugin URI: http://wprevs.com
* Description: A plugin to allow a video production company to showcase their projects in a Wordpress site 
via a bespoke dashboard page. 
* Author: Richard Gourley
* Version: 1.0.0
* Author URI: http://wprevs.com
* License: GPLv2 or later
*/

//check abspath
if(!defined( 'ABSPATH' )) exit;

$vps_admin_page_initializer = new VpsAdminPageInitializer();