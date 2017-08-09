<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$all_plugins = get_plugins();
?>
<h3><?php _e('Plugins Environment','wp-system-log');?></h3>
<hr>
<table id="wpsl-plugins-environment-tbl">
	<tbody>
		<?php foreach( $all_plugins as $index => $plugin ){?>
			<tr>
				<td>
					<h4><?php echo $plugin['Name']?></h4>
				</td>
				<td>
					<i>(Plugin by:<?php echo $plugin['Author']?>)</i>
				</td>
				<td>
					<i>(Version:<?php echo $plugin['Version']?>)</i>
				</td>
				<?php if( is_plugin_active( $index ) ){?>
					<td>
						<img class="tick-icon" src="<?php echo WPSL_PLUGIN_URL."admin/assets/images/symbol_check.png"?>">
					</td>
				<?php }?>
			</tr>
		<?php }?>
	</tbody>
</table>