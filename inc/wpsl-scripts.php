<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class to add custom scripts and styles
 */
if( !class_exists( 'WPSL_ScriptsStyles' ) ) {
	class WPSL_ScriptsStyles{

		/**
		 * Constructor
		 */
		function __construct() {
			
			if( strpos( $_SERVER['REQUEST_URI'], 'wp-system-log-options') !== false ) {
				add_action( 'admin_init', array( $this, 'wpsl_admin_custom_variables' ) );
			}
		}
		
		/**
		 * Actions performed for enqueuing scripts and styles for admin page
		 */
		function wpsl_admin_custom_variables() {
			wp_enqueue_style('wpsl-css-admin', WPSL_PLUGIN_URL.'admin/assets/css/wpsl-admin.css');
			wp_enqueue_script('wpsl-js-admin', WPSL_PLUGIN_URL.'admin/assets/js/wpsl-admin.js', array('jquery') );
		}
	}
	new WPSL_ScriptsStyles();
}