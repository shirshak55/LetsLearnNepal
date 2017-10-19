<?php
add_action('after_setup_theme', function () {
    add_theme_support('custom-background', array(
        'default-color' => 'FDE9D9'
    ));
    add_theme_support('custom-header', array(
        'default-image' => get_template_directory_uri() . '/data/images/logo2.png',
        'flex-width' => true,
        'width' => 400,
        'flex-height' => true,
        'height' => 70,
    ));
});