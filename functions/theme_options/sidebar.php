<?php
add_action( 'widgets_init', function () {
	$args = array(
		'id'            => "sidebar_main",
		'class'         => 'sidebar',
		'name'          => __( 'Main Sidebar', 'text_domain' ),
		'description'   => __( 'Sidebar that is shown right at blog', 'text_domain' ),
		'before_title'  => '<h4 class="widgetbox-heading">',
		'after_title'   => '</h4>',
		'before_widget' => '<div class="module module-%2$s">',
		'after_widget'  => '</div>',
	);
	register_sidebar( $args );

	$args = array(
		'id'            => 'header_ads',
		'class'         => 'header-ads',
		'name'          => __( 'Header Adverts', 'text_domain' ),
		'description'   => __( 'Show that ads or something in header', 'text_domain' ),
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		'before_widget' => '<div id="%1$s">',
		'after_widget'  => '</div>',
	);
	register_sidebar( $args );
});