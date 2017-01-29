<?php


if( ! function_exists( 'add_custom_header' ) ) {
	function add_custom_header() {
		
		$args = array (
			'width'         => 1170,
			'height'        => 100,
			'default-image' => get_template_directory_uri() . '/images/logo.png',
		);
		add_theme_support( 'custom-header', $args );
	}

	add_action( 'after_setup_theme', 'add_custom_header' );	
}
