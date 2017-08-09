<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$spinner_src = includes_url().'/images/spinner.gif';
?>
<div class="wpsl-content">
	<div class='system-log-header'>
		<h1><?php _e( 'WP System Log Settings', 'wp-system-log' );?></h1>
	</div>

	<div class="wpsl-support-mail">
		<h3><?php _e( 'Mail Us To Discuss', 'wp-system-log' );?></h3>

		<div id="wpsl_enquiry_success" class="updated settings-error notice is-dismissible">
			<p><strong>Your Enquiry Has Been Sent!</strong></p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text">Dismiss this notice.</span>
			</button>
		</div>

		<p><?php _e( 'Mail this system status to your support to discuss issues!', 'wp-system-log' );?></p>
		<div class="wpsl-support-mail-form">
			<table cellspacing="0" id="wpsl-enquiry-form-tbl">
				<tr>
					<td><?php _e( 'Email', 'wp-system-log' );?></td>
					<td>
						<input type="email" id="user-email" placeholder="User Email">
					</td>
				</tr>
				<tr>
					<td><?php _e( 'Your Message', 'wp-system-log' );?></td>
					<td>
						<textarea placeholder="Your Message" id="user-message" rows="4" cols="30"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" id="wpsl-send-enquiry" value="Enquire" class="button button-primary">
						<img src="<?php echo $spinner_src;?>" class="wpsl-send-enquiry-spinner" />
					</td>
				</tr>
			</table>
		</div>
	</div>

	<!-- WORDPRESS ENVIRONMENT -->
	<div id="wpsl-wp-environment" class="wpsl-environments">
		<?php include 'environments/wpsl-wp.php';?>
	</div>

	<!-- WORDPRESS DATABASE ENVIRONMENT -->
	<div id="wpsl-wpdb-environment" class="wpsl-environments">
		<?php include 'environments/wpsl-wpdb.php';?>
	</div>

	<!-- SERVER ENVIRONMENT -->
	<div id="wpsl-server-environment" class="wpsl-environments">
		<?php include 'environments/wpsl-server.php';?>
	</div>

	<!-- PLUGINS ENVIRONMENT -->
	<div id="wpsl-plugins-environment" class="wpsl-environments">
		<?php include 'environments/wpsl-plugins.php';?>
	</div>
</div>