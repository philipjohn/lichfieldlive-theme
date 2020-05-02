<?php

add_action( 'wp_enqueue_scripts', 'lichfieldlive_enqueue_styles' );
function lichfieldlive_enqueue_styles() {

	$parent_style = 'newspack-theme';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style(
		'lichfieldlive-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);

}
