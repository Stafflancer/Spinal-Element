<?php /**
 * Custom ACF functions.
 *
 * A place to custom functionality related to Advanced Custom Fields.
 *
 * @package Pyramid
 */

// If ACF isn't activated, then bail.
if (!class_exists('ACF')) {
	return false;
}

/**
 * ACF theme options page - Setting up ACF options pages
 * Enables "Options" pages in Advanced Custom Fields
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title'  => __('Theme Settings'),
		'menu_title'  => __('Theme Settings'),
		'menu_slug'  => 'theme-settings',
		'capability' => 'edit_posts',
		'redirect'    => true,
		'position'   => 3.1,
	));

	acf_add_options_page(array(
		'page_title'  => __('Header Settings'),
		'menu_title'  => __('Header Settings'),
		'parent_slug' => 'theme-settings',
	));

	acf_add_options_page(array(
		'page_title'  => __('Footer Settings'),
		'menu_title'  => __('Footer Settings'),
		'parent_slug' => 'theme-settings',
	));
}