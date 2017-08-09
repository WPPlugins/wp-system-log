<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

//Class to serve ajax calls for this plugin
if( !class_exists( 'WPSL_Ajax' ) ) {
	class WPSL_Ajax{

		//Constructor
		function __construct() {
			//AJAX Request to submit the enquiry
			add_action( 'wp_ajax_wpsl_send_enquiry', array( $this, 'wpsl_send_enquiry' ) );
			add_action( 'wp_ajax_nopriv_wpsl_send_enquiry', array( $this, 'wpsl_send_enquiry' ) );

			//Turn OFF Debug Mode
			add_action( 'wp_ajax_wpsl_turn_off_debug', array( $this, 'wpsl_turn_off_debug') );
			add_action( 'wp_ajax_nopriv_wpsl_turn_off_debug', array( $this, 'wpsl_turn_off_debug') );

			//Turn ON Debug Mode
			add_action( 'wp_ajax_wpsl_turn_on_debug', array( $this, 'wpsl_turn_on_debug') );
			add_action( 'wp_ajax_nopriv_wpsl_turn_on_debug', array( $this, 'wpsl_turn_on_debug') );
		}

		//Actions performed to turn on the debug mode
		function wpsl_turn_on_debug() {
			if( isset( $_POST['action'] ) && $_POST['action'] === 'wpsl_turn_on_debug' ) {
				$config_file = dirname( getcwd() )."/wp-config.php";
				$config_file_contents = file_get_contents( $config_file );
				$new_contents = str_replace( "define('WP_DEBUG', false)", "define('WP_DEBUG', true)", $config_file_contents );
				file_put_contents( $config_file, $new_contents );
				echo WPSL_PLUGIN_URL;
				die;
			}
		}

		//Actions performed to turn off the debug mode
		function wpsl_turn_off_debug() {
			if( isset( $_POST['action'] ) && $_POST['action'] === 'wpsl_turn_off_debug' ) {
				$config_file = dirname( getcwd() )."/wp-config.php";
				$config_file_contents = file_get_contents( $config_file );
				$new_contents = str_replace( "define('WP_DEBUG', true)", "define('WP_DEBUG', false)", $config_file_contents );
				file_put_contents( $config_file, $new_contents );
				echo WPSL_PLUGIN_URL;
				die;
			}
		}

		//Actions performed to submit the enquiry
		function wpsl_send_enquiry() {
			if( isset( $_POST['action'] ) && $_POST['action'] === 'wpsl_send_enquiry' ) {
				$to = sanitize_text_field( $_POST['email'] );
				$message = sanitize_text_field( $_POST['message'] );
				$subject = "Need Help!";

				global $wpdb;

				//Memory Limit
				$memory = "-";
				if (defined('WP_MEMORY_LIMIT')) {
					$memory = WP_MEMORY_LIMIT;
				}

				//WP DEBUG MODE
				$debug = "-";
				if (defined('WP_DEBUG')) {
					$debug = WP_DEBUG;
				}

				//WP CRON
				$cron = "-";
				if (defined('DISABLE_WP_CRON')) {
					$cron = DISABLE_WP_CRON;
				}

				$cron_arr = _get_cron_array();

				$home_url=home_url();
				$site_url=get_site_url();
				$blog_version=get_bloginfo('version');
				$multisite=(is_multisite())?'Yes' : 'No';
				$debug_mode=($debug)?'On' : 'Off';
				$wp_cron=($cron_arr)?'Yes' : 'No';
				$language=get_locale();

				//Server Software
				$server_software = "-";
				if ( isset( $_SERVER['SERVER_SOFTWARE'] ) ) {
					$server_software = $_SERVER['SERVER_SOFTWARE'];
				}

				//Server Name
				$server_name = "-";
				if ( isset( $_SERVER['HTTP_HOST'] ) ) {
					$server_name = $_SERVER['HTTP_HOST'];
				}

				//Current IP
				$current_ip = "-";
				if ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
					$current_ip = $_SERVER['REMOTE_ADDR'];
				}

				//cURL Info
				$curl_ver = curl_version();
				if( !empty( $curl_ver ) ){
					$curl = $curl_ver['version']." ".$curl_ver['ssl_version'];
				} else {
					$curl = '-';
				}

				//Suhosin Installed
				$suhosin = true;
				if (!extension_loaded('suhosin')) {
					$suhosin = false;
				}

				$suhosin_status=($suhosin)?'Yes' : 'No';
				if ( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) {
					$curls= true;
				} else {
					$curls = false;
				}
				$curl_status=($curls)?'Yes' : 'No';

				if ( class_exists( 'DOMDocument' ) ) {
					$dom= true;
				} else {
					$dom = false;
				}
				$dom_status=($dom)?'Yes' : 'No';

				if ( class_exists( 'SoapClient' ) ) {
					$soap =true;
				} else {
					$soap=false;
				}
				$soap_status = ($soap)?'Yes': 'No';

				if (extension_loaded('mbstring')) {
					$mbstring =true;
				} else {
					$mbstring=false;
				}
				$mbstring_status = ($mbstring)?'Yes': 'No';

				if ( is_callable( 'gzopen' ) ) {
					$gzip = true;
				} else {
					$gzip = false;
				}
				$gzip_status = ($gzip)?'Yes': 'No';

				if ( date_default_timezone_get() == 'UTC' ){
					$date_default_timezone='Yes';
				} else {
					$date_default_timezone='No';
				}


				$link = mysqli_connect( $wpdb->dbhost, $wpdb->dbuser, $wpdb->dbpassword );
				$db_password=($wpdb->dbpassword)?$wpdb->dbpassword : 'No Password';

				/**
				*Get Plugins Environment Details
				*/

				$all_plugins = get_plugins();
				$plugin_str='';
				$count=0;
				foreach( $all_plugins as $index => $plugin ){
				$plugin_status=($index)?'Activate':'Deactivate';
				$odd='background-color: #e0e0e0;';
				$style=(++$count%2 ? $odd : "");
				$plugin_str.='<tr style="'.$style.'"><td>'.'<b>Plugin Name : </b>'.$plugin["Name"].'  '.'<b>Plugin by : </b>'.$plugin["Author"].'   '.'<b>Version :  </b>'.$plugin['Version'].'  '.'<b>Status : </b>'.$plugin_status.'</td></tr>';
				}

				$cust_email = get_option( 'admin_email' );

				$htmlContent = '
				<html>
				<head>
				<title>Need to help</title>
				</head>
				<body>
				<h3>Customer Information</h3>
				<table cellspacing="0" style="border: 2px dashed #FB4314; width: 500px; height: 90px;">
				<tr style="background-color: #e0e0e0;">
				<th>Email:</th><td>'.$cust_email.'</td>
				</tr>
				<tr>
				<th>Message:</th><td>'.$message.'</td>
				</tr>
				</table>
				<h3>Wordpress Environment</h3>
				<table cellspacing="0" style="border: 2px dashed #FB4314; width: 500px; height: 90px;">
				<tr>
				<th>Home URL :</th><td>'.$home_url.'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>Site URL:</th><td>'.$site_url.'</td>
				</tr>
				<tr>
				<th>Wordpress Version:</th><td>'.$blog_version.'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>Wordpress MultiSite:</th><td>'.$multisite.'</td>
				</tr>
				<tr>
				<th>Wordpress Memory Limit:</th><td>'.$memory.'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>Wordpress Debug Mode:</th><td>'.$debug_mode.'</td>
				</tr>
				<tr>
				<th>Wordpress Cron:</th><td>'.$wp_cron.'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>Language:</th><td>'.$language.'</td>
				</tr>
				</table>
				<h3>Server Environment</h3>
				<table cellspacing="0" style="border: 2px dashed #FB4314; width: 500px; height: 90px;">
				<tr>
				<th>Server Info :</th><td>'.$server_software.'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>Server Name:</th><td>'.$server_name.'</td>
				</tr>
				<tr>
				<th>Current IP:</th><td>'.$current_ip.'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>PHP Version:</th><td>'.PHP_VERSION.'</td>
				</tr>
				<tr>
				<th>PHP Post Max Size:</th><td>'.ini_get('post_max_size').'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>PHP Time Limit:</th><td>'.ini_get('max_execution_time').'</td>
				</tr>
				<tr>
				<th>PHP Max Input Vars:</th><td>'.ini_get('max_input_vars').'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>cURL available:</th><td>'.$curl_status.'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>cURL Version:</th><td>'.$curl.'</td>
				</tr>

				<tr>
				<th>SUHOSIN Installed:</th><td>'.$suhosin_status.'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>Max Upload Size:</th><td>'.ini_get('upload_max_filesize').'</td>
				</tr>
				<tr>
				<th>Default Timezone is UTC:</th><td>'.$date_default_timezone.'</td>
				</tr>
				<tr>
				<th>Dom Available:</th><td>'.$dom_status.'</td>
				</tr>
				<tr>
				<th>Soap Client:</th><td>'.$soap_status.'</td>
				</tr>
				<tr>
				<th>Gzip:</th><td>'.$gzip_status.'</td>
				</tr>
				<tr>
				<th>Multibyte String:</th><td>'.$mbstring_status.'</td>
				</tr>
				</table>
				<h3>Wordpress Database Environment</h3>
				<table cellspacing="0" style="border: 2px dashed #FB4314; width: 500px; height: 90px;">
				<tr>
				<th>MySql Version :</th><td>'.mysqli_get_server_info( $link ).'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>WPDB Prefix:</th><td>'.$wpdb->prefix.'</td>
				</tr>
				<tr>
				<th>DB User:</th><td>'.$wpdb->dbuser.'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>DB Password:</th><td>'.$db_password.'</td>
				</tr>
				<tr>
				<th>DB Name:</th><td>'.$wpdb->dbname.'</td>
				</tr>
				<tr style="background-color: #e0e0e0;">
				<th>DB Host:</th><td>'.$wpdb->dbhost.'</td>
				</tr>
				</table>

				<h3>Plugins Environment</h3>
				<table cellspacing="0" style="border: 2px dashed #FB4314; width: 500px; height: 90px;">'.$plugin_str.'</table>
				</body>
				</html>';

				// Set content-type header for sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// Additional headers
				$headers .= 'From: <'.get_option( 'admin_email' ).'>' . "\r\n";
				wp_mail( $to, $subject, $htmlContent, $headers);
				echo 'enquiry-sent-success';
				die;
			}
		}
	}
	new WPSL_Ajax();
}