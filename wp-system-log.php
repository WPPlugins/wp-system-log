<?php
/*
Plugin Name: WordPress System Log
Plugin URI: https://wbcomdesigns.com/contact/
Description: This plugin allows the admin to know about his site log that includes the wordpress invironment, server environment, etc.
Version: 1.0.0
Author: Wbcom Designs
Author URI: http://wbcomdesigns.com
License: GPLv2+
Text Domain: wp-system-log
Domain Path: /languages
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//Load plugin textdomain ( @since 1.0.0 )
add_action( 'init', 'wpsl_load_textdomain' );
function wpsl_load_textdomain() {
	$domain = "wp-system-log";
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	load_textdomain( $domain, 'languages/'.$domain.'-' . $locale . '.mo' );
	$var = load_plugin_textdomain( $domain, false, plugin_basename( dirname(__FILE__) ) . '/languages' );
}

//Constants used in the plugin
define( 'WPSL_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'WPSL_PLUGIN_URL', plugin_dir_url(__FILE__) );

//Include needed files on init
add_action( 'init', 'wpsl_include_files' );
add_action( 'admin_init', 'wpsl_include_files' );
function wpsl_include_files() {
	$include_files = array(
		'inc/wpsl-scripts.php',
		'inc/wpsl-ajax.php',
		'admin/wpsl-admin.php',
	);
	foreach( $include_files  as $include_file ) include $include_file;
}

//Settings link for this plugin
add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), 'wpsl_admin_page_link' );
function wpsl_admin_page_link( $links ) {
	$page_link = array('<a href="'.admin_url('admin.php?page=wp-system-log-options').'">Options</a>');
	return array_merge( $links, $page_link );
}