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

/**
 * Get the year the current content was first published.
 *
 * @return string Four-digit numerical year.
 */
function lichfieldlive_get_published_date() {
	global $post;
	return date( 'Y', strtotime( $post->post_date ) );
}

/**
 * Migrate theme settings when switching from Newspack to Lichfield Live child.
 *
 * @since Lichfield Live 0.2.0
 */
function lichfieldlive_migrate_settings( $old_name, $old_theme = false ) {
	$theme           = wp_get_theme();
	$old_stylesheet  = is_a( $old_theme, 'WP_Theme' ) ? $old_theme->get_stylesheet() : null;
	$new_stylesheet  = $theme->get_stylesheet();
	$newspack_prefix = 'newspack-';

	$mods = get_option( 'theme_mods_' . $old_stylesheet, null );
	if ( $mods ) {
		update_option( 'theme_mods_' . $new_stylesheet, $mods );
	}
}
add_action( 'after_switch_theme', 'lichfieldlive_migrate_settings', 10, 2 );
