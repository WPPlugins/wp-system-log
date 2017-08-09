<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//Add admin page for displaying system log
if( !class_exists( 'WPSL_AdminPage' ) ) {
	class WPSL_AdminPage{

		//constructor
		function __construct() {
			add_action( 'admin_menu', array( $this, 'wpsl_add_menu_page' ) );
		}

		//Actions performed on loading admin_menu
		function wpsl_add_menu_page() {
			$icon_url = WPSL_PLUGIN_URL.'admin/assets/images/system-log.png';
			add_menu_page( __( 'WP System Log Settings', 'wp-system-log' ), __( 'System Log', 'wp-system-log' ), 'manage_options', 'wp-system-log-options', array( $this, 'wpsl_admin_options_page' ), $icon_url );
		}

		function wpsl_admin_options_page() {
			include 'wpsl-admin-options-page.php';
		}
	}
	new WPSL_AdminPage();
}