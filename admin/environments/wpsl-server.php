<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
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
}else{
  $curls = false;
}
$curl_status=($curls)?'Yes' : 'No';

if ( class_exists( 'DOMDocument' ) ) {
    $dom= true;
}else{
  $dom = false;
}
$dom_status=($dom)?'Yes' : 'No';

if ( class_exists( 'SoapClient' ) ) {
  $soap =true;
}else{
  $soap=false;
}
$soap_status = ($soap)?'Yes': 'No';

if (extension_loaded('mbstring')) {
  $mbstring =true;
}else{
  $mbstring=false;
}
$mbstring_status = ($mbstring)?'Yes': 'No';

if ( is_callable( 'gzopen' ) ) {
  $gzip = true;
}else{
  $gzip = false;
}
$gzip_status = ($gzip)?'Yes': 'No';

if ( date_default_timezone_get() == 'UTC' ){
	$date_default_timezone='Yes';
}else{
    $date_default_timezone='No';
}
?>
<h3><?php _e('Server Environment','wp-system-log');?></h3>
<hr>
<table>
	<tbody>

		<!--Server Info-->
		<tr>
		<td><h4><?php _e('Server Info:','wp-system-log');?></h4></td>
		<td><?php echo $server_software;?></td>
		</tr>

		<!--Server Name-->
		<tr>
		<td><h4><?php _e('Server Name:','wp-system-log');?></h4></td>
		<td><?php echo $server_name;?></td>
		</tr>

		<!--Current IP-->
		<tr>
		<td><h4><?php _e('Current IP:','wp-system-log');?></h4></td>
		<td><?php echo $current_ip;?></td>
		</tr>

		<!--PHP Version-->
		<tr>
		<td><h4><?php _e('PHP Version:','wp-system-log');?></h4></td>
		<td><?php echo PHP_VERSION;?></td>
		</tr>

		<!--PHP Post Max Size-->
		<tr>
		<td><h4><?php _e('PHP Post Max Size:','wp-system-log');?></h4></td>
		<td><?php echo ini_get('post_max_size');?></td>
		</tr>

		<!--PHP Time Limit-->
		<tr>
		<td><h4><?php _e('PHP Time Limit:','wp-system-log');?></h4></td>
		<td><?php echo ini_get('max_execution_time');?></td>
		</tr>

		<!--PHP Max Input Vars-->
		<tr>
		<td><h4><?php _e('PHP Max Input Vars:','wp-system-log');?></h4></td>
		<td><?php echo ini_get('max_input_vars');?></td>
		</tr>

		<tr>
		<td><h4><?php _e('fsockopen/curl:','wp-system-log');?></h4></td>
		<?php if ( $curls){?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>"></td>
		<?php } else {?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/erase-icon.png"?>"></td>
		<?php }?>
		</tr>

		<!--cURL Version-->
		<tr>
		<td><h4><?php _e('cURL Version:','wp-system-log');?></h4></td>
		<td><?php echo $curl;?></td>
		</tr>

		<!--SUHOSIN Installed-->
		<tr>
		<td><h4><?php _e('SUHOSIN Installed:','wp-system-log');?></h4></td>
		<?php if ( $suhosin ){?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>"></td>
		<?php } else {?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/erase-icon.png"?>"></td>
		<?php }?>
		</tr>

		<!--Max Upload Size-->
		<tr>
		<td><h4><?php _e('Max Upload Size:','wp-system-log');?></h4></td>
		<td><?php echo ini_get('upload_max_filesize');?></td>
		</tr>

		<!--Default Timezone is UTC-->
		<tr>
		<td><h4><?php _e('Default Timezone is UTC:','wp-system-log');?></h4></td>
		<?php if ( date_default_timezone_get() == 'UTC' ){?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>"></td>
		<?php } else {?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/erase-icon.png"?>"></td>
		<?php }?>
		</tr>

		<!--Soap Client-->
		<tr>
		<td><h4><?php _e('Soap Client:','wp-system-log');?></h4></td>
		<?php if ( $soap){?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>"></td>
		<?php } else {?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/erase-icon.png"?>"></td>
		<?php }?>
		</tr>

		<!--Multibyte String-->
		<tr>
		<td><h4><?php _e('Multibyte String:','wp-system-log');?></h4></td>
		<?php if ( $mbstring){?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>"></td>
		<?php } else {?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/erase-icon.png"?>"></td>
		<?php }?>
		</tr>

		<!--DOM-->
		<tr>
		<td><h4><?php _e('DOM:','wp-system-log');?></h4></td>
		<?php if ( $dom){?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>"></td>
		<?php } else {?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/erase-icon.png"?>"></td>
		<?php }?>
		</tr>

		<!--GZIP-->
		<tr>
		<td><h4><?php _e('Gzip:','wp-system-log');?></h4></td>
		<?php if ( $gzip){?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>"></td>
		<?php } else {?>
		<td><img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/erase-icon.png"?>"></td>
		<?php }?>
		</tr>

	</tbody>
</table>