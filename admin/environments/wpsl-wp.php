<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
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
?>
<h3><?php _e('Wordpress Environment','wp-system-log');?></h3>
<hr>
<table>
	<tbody>
		<!--Home URL-->
		<tr>
			<td><h4><?php _e('Home URL:', 'wp-system-log');?></h4></td>
			<td><?php echo home_url();?></td>
		</tr>

		<!--Site URL-->
		<tr>
			<td><h4><?php _e('Site URL:', 'wp-system-log');?></h4></td>
			<td><?php echo get_site_url();?></td>
		</tr>

		<!--Wordpress Version-->
		<tr>
			<td><h4><?php _e('Wordpress Version:', 'wp-system-log');?></h4></td>
			<td><?php echo get_bloginfo('version');?></td>
		</tr>

		<!--Wordpress MultiSite-->
		<tr>
			<td><h4><?php _e('Wordpress MultiSite:', 'wp-system-log');?></h4></td>
			<?php if ( is_multisite() ){?>
				<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>"></td>
			<?php } else {?>
				<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/erase-icon.png"?>"></td>
			<?php }?>
		</tr>

		<!--Wordpress Memory Limit-->
		<tr>
			<td><h4><?php _e('Wordpress Memory Limit:', 'wp-system-log');?></h4></td>
			<td><?php echo $memory;?></td>
		</tr>

		<!--Wordpress Debug Mode-->
		<tr id="wp-debug-row">
			<td><h4><?php _e('Wordpress Debug Mode:', 'wp-system-log');?></h4></td>
			<?php if ( $debug ){?>
				<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>"></td>
				<td>
					<input type="button" class="button button-primary" id="turn-off-debug" value="Turn Off">
				</td>
			<?php } else {?>
				<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/erase-icon.png"?>"></td>
				<td>
					<input type="button" class="button button-primary" id="turn-on-debug" value="Turn On">
				</td>
			<?php }?>
		</tr>

		<!--Wordpress Cron-->
		<tr>
			<td><h4><?php _e('Wordpress Cron:', 'wp-system-log');?></h4></td>
			<?php if ( !empty( $cron_arr ) ){?>
				<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>"></td>
			<?php } else {?>
				<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/erase-icon.png"?>"></td>
			<?php }?>
		</tr>

		<!--Language-->
		<tr>
			<td><h4><?php _e('Language:', 'wp-system-log');?></h4></td>
			<td><?php echo get_locale();?></td>
		</tr>
	</tbody>
</table>