<?php

class VpsScriptsInitializer{
    public function __construct(){
        //enqueue scripts here
        add_action( 'init', array( $this, 'enqueue_css' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_js' ) );
    }

    public function enqueue_css(){
        wp_enqueue_style( 'video_projects_showcase_css', plugins_url( 'css/styles.css', __DIR__) );
    }

    public function enqueue_admin_js(){
        wp_enqueue_script( 'video_projects_admin_js', plugins_url( 'js/admin-page.js', __DIR__ ),
        array(), '1.0.0', true );
        wp_enqueue_script( 'video_projects_admin_media_js', plugins_url( 'js/admin-page-media.js', __DIR__ ),
        array('jquery'), '1.0.0', true);
    }

}