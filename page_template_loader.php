<?php
/**
 * Template Name: Page Theme Loader
 */

global $post;

// Define the post_name and the file name of the current page
$pslug = $post->post_name;
$pname = $pslug . '.php';

    // Load the TEMPLATE file in your custom directory
    require_once( get_template_directory() . '/functions/page_template/' . $pname );
?>