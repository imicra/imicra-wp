<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package imicra
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function imicra_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( imicra_is_frontpage() ) {
		$classes[] = 'frontpage';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'imicra_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function imicra_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'imicra_pingback_header' );

/**
 * Checks to see if we're on the homepage or not.
 */
function imicra_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Disables the default WordPress option of converting emoticons to image smilies
 */
add_filter( 'option_use_smilies', '__return_false' );
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Clean head.
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
// meta rel='dns-prefetch' href='//s.w.org'
// remove_action( 'wp_head', 'wp_resource_hints', 2 );