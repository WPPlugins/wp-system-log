<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $wpdb;

$link = mysqli_connect( $wpdb->dbhost, $wpdb->dbuser, $wpdb->dbpassword );
?>
<h3><?php _e('WP Database Environment','wp-system-log');?></h3>
<hr>
<table>
	<tbody>
		<!--MySql Version-->
		<tr>
			<td><h4><?php _e('MySql Version:','wp-system-log');?></h4></td>
			<td><?php echo mysqli_get_server_info( $link );?></td>
		</tr>

		<!--WPDB Prefix-->
		<tr>
			<td><h4><?php _e('WPDB Prefix:','wp-system-log');?></h4></td>
			<td><?php echo $wpdb->prefix;?></td>
		</tr>

		<!--DB User-->
		<tr>
			<td><h4><?php _e('DB User:','wp-system-log');?></h4></td>
			<td><?php echo $wpdb->dbuser;?></td>
		</tr>

		<!--DB Password-->
		<tr>
			<td><h4><?php _e('DB Password:','wp-system-log');?></h4></td>
			<td><?php if( empty( $wpdb->dbpassword ) ) echo "No Password"; else echo $wpdb->dbpassword;?></td>
		</tr>

		<!--DB Name-->
		<tr>
			<td><h4><?php _e('DB Name:','wp-system-log');?></h4></td>
			<td><?php echo $wpdb->dbname;?></td>
		</tr>

		<!--DB Host-->
		<tr>
			<td><h4><?php _e('DB Host:','wp-system-log');?></h4></td>
			<td><?php echo $wpdb->dbhost;?></td>
		</tr>

	</tbody>
</table>