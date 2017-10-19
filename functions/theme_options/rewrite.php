<?php
add_action('generate_rewrite_rules', function ($wp_rewrite) {
    global $wp_rewrite;
    $theme_name =  wp_get_theme();
    $clean_url = array(
    'css/(.*)'       => 'wp-content/themes/'. $theme_name . '/data/css/$1',
    'js/(.*)'        => 'wp-content/themes/'. $theme_name . '/data/js/$1',
    'images/(.*)'    => 'wp-content/themes/'. $theme_name . '/data/images/$1',
    );
    $wp_rewrite->non_wp_rules =$wp_rewrite->non_wp_rules + $clean_url;
});
?>