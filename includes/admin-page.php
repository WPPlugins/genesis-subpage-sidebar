<?php

function gsfs_options_page() {

	global $gsfs_options;

	ob_start(); ?>
	<div class="wrap">
		<h2>Genesis Subpage Sidebar Settings</h2>
		
		<form method="post" action="options.php">
		
			<?php settings_fields('gsfs_settings_group'); ?>

			<?php
			$gsfs_options = get_option('gsfs_settings');
			// echo '<p><pre>';
			// print_r ( $gsfs_options );
			// echo '</pre><p>';
			?>
		
			<p>
				<input id="gsfs_settings[enable]" name="gsfs_settings[enable]" type="checkbox" value="1" <?php checked(1, $gsfs_options['enable'] ); ?> />
				<label class="description" for="gsfs_settings[enable]"><?php _e('Disable subpage sidebar creation? <em>This setting disables the plugin.</em>', 'gsfs_domain'); ?></label>
			</p>

			<h4><?php _e('Styling & Behavior', 'gsfs_domain'); ?></h4>
			<p>
				<input id="gsfs_settings[defaultstyle]" name="gsfs_settings[defaultstyle]" type="checkbox" value="1" <?php checked(1, $gsfs_options['defaultstyle'] ); ?> />
				<label class="description" for="gsfs_settings[defaultstyle]"><?php _e('Disable the default styles from this plugin?', 'gsfs_domain'); ?></label>
			</p>

			<p>
				<input id="gsfs_settings[scrolling]" name="gsfs_settings[scrolling]" type="checkbox" value="1" <?php checked(1, $gsfs_options['scrolling'] ); ?> />
				<label class="description" for="gsfs_settings[scrolling]"><?php _e('Disable menu scrolling? <em>If scrolling is enabled, the primary menu is automatically removed.</em>', 'gsfs_domain'); ?></label>
			</p>

			<p>
				<input id="gsfs_settings[removeprimarymenu]" name="gsfs_settings[removeprimarymenu]" type="checkbox" value="1" <?php checked(1, $gsfs_options['removeprimarymenu'] ); ?> />
				<label class="description" for="gsfs_settings[removeprimarymenu]"><?php _e('Remove the primary menu?', 'gsfs_domain'); ?></label>
			</p>
		
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Options', 'gsfs_domain'); ?>" />
			</p>
		
		</form>
		
	</div>
	<?php
	echo ob_get_clean();
}

function gsfs_add_options_link() {
	add_options_page( 'Subpage Sidebar Settings', 'Subpage Sidebar', 'manage_options', 'gsfs-options', 'gsfs_options_page' );
}
add_action( 'admin_menu', 'gsfs_add_options_link' );

function gsfs_register_settings() {	
	// creates our settings in the options table
	register_setting( 'gsfs_settings_group', 'gsfs_settings' );
}
add_action( 'admin_init', 'gsfs_register_settings' );