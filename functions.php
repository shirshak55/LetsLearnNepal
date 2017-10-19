<?php
if ( ! is_admin() ) {
    add_action( 'wp_enqueue_scripts', function(){
        //wp_deregister_script( 'jquery' );
        //wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), null, false );
        wp_enqueue_script( 'jquery');
    });
}

add_action( 'wp_print_styles', function() {
	wp_enqueue_style('index_css',get_template_directory_uri()."/data/css/home_page.css");
	//wp_deregister_script( 'jquery-migrate' );
	wp_dequeue_style('yarppWidgetCss');
	wp_deregister_style('yarppRelatedCss');
} );
add_action( 'wp_footer', function () {
  wp_dequeue_style('yarppRelatedCss');
} );

//========================================================
// Theme Options
//========================================================
require_once("functions/theme_options/rewrite.php");
require_once('functions/theme_options/custom_header.php');
require_once("functions/theme_options/theme_support.php");
require_once("functions/theme_options/sidebar.php");
//========================================================
// Libraries
//========================================================
require_once('libraries/browser-detect.php');
//========================================================
// Posts
//========================================================
require_once('functions/post/theme_essential_page_creator.php');