<?php
function izeetak_add_menu_activate() {
	add_submenu_page( 'themes.php', esc_html__( 'Theme Activation', 'izeetak' ), esc_html__( 'Theme Activation', 'izeetak' ), 'manage_options', 'izeetak_activate_settings', 'izeetak_activation_settings', 1 );
}
add_action( 'admin_menu', 'izeetak_add_menu_activate' );

function izeetak_activation_settings() {
	$settings = get_option('izeetak_activate_settings');

	if(!$settings) $settings = array();
	$settings['izeetak_code_purchase'] = isset($settings['izeetak_code_purchase']) ? $settings['izeetak_code_purchase'] : '';
	$settings['izeetak_activate_status'] = isset($settings['izeetak_activate_status']) ? $settings['izeetak_activate_status'] : 0;
	$settings['izeetak_activate_message'] = isset($settings['izeetak_activate_message']) ? $settings['izeetak_activate_message'] : esc_html__( 'Missing Code Purchase', 'izeetak' );

	$css = '';
	switch ($settings['izeetak_activate_status']) {
		case 1:
			$css = 'color: #39b54a;';
			break;
		case 2:
			$css = 'color: #d72b3f;';
			break;
		case 3:
			$css = 'color: #fcb92c;';
			break;
		default:
			$css = 'color: #1d2327;';
			break;
	}
	?>	

	<form action="<?php echo admin_url( 'options.php' ); ?>" method="post">
		<?php settings_fields( 'izeetak_activate_settings' ); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<?php echo esc_html__( 'Status', 'izeetak' ); ?>
				</th>
				<td>
					<span class="izeetak-status" style="<?php echo esc_attr($css); ?>">
						<?php echo esc_html($settings['izeetak_activate_message']); ?>
					</span>
				</td>
			</tr>


			<tr valign="top">
				<th scope="row"><label for="izeetak_code_purchase"><?php echo esc_html_e( 'Code Purchase', 'izeetak' ); ?></label></th>
				<td>
					<input class="regular-text code" type="text" placeholder="<?php echo esc_attr__( 'Your Code Purchase', 'izeetak' ); ?>" id="izeetak_code_purchase" name="izeetak_code_purchase" value="<?php echo esc_attr($settings['izeetak_code_purchase']); ?>" ?>
				</td>

			</tr>

		</table>

		<div>
		    <?php esc_html_e('Enter the Code Purchase in order to get theme and plugin updates.', 'izeetak'); ?><br>
		    <?php esc_html_e('For Envato Elements, enter "Envato Elements" in case you want to disable the warning message.', 'izeetak'); ?><br>
		    <?php esc_html_e('Please rememeber Envato Elements dont get automatic update (update from WP Dashboard), you will need to download the latest version
		    from your Envato Elements account and manually update theme and plugin Masterlayer Addons for Elementor.', 'izeetak'); ?><br>
		</div>
		<?php submit_button(); ?>

	</form>
	<?php
}

// register settings
add_action( 'admin_init', 'izeetak_register_settings');
function izeetak_register_settings() {
	register_setting( 'izeetak_activate_settings', 'izeetak_code_purchase', 'izeetak_save_settings' );
}

// Save Settings
add_action('admin_init', 'izeetak_save_settings');
function izeetak_save_settings() {
	if (defined('DOING_AJAX') && DOING_AJAX) return;

	$settings = get_option('izeetak_activate_settings');

	if(isset($_POST['izeetak_code_purchase'])) {
		$settings['izeetak_code_purchase'] = untrailingslashit(esc_html($_POST['izeetak_code_purchase']));

		$result = izeetak_activate_theme($settings['izeetak_code_purchase']);
		if ( isset($result['message']) ) {
			$settings['izeetak_activate_status'] = $result['code'];
			$settings['izeetak_activate_message'] = $result['message'];
		} else {
			$settings['izeetak_activate_status'] = 0;
			$settings['izeetak_activate_message'] = $result;
		}

		update_option('izeetak_activate_settings', $settings);
	}     
	
}

// Activate theme
function izeetak_activate_theme($code) {
	// Check syntax
	if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code)) {
		$result = array();
		
		if (empty($code)) {
			$result['code'] = 0;
			$result['message'] = esc_html__( 'Purchase code empty', 'izeetak' );
		} elseif(empty($code) == 'Envato Elements') {
			$result['code'] = 2;
			$result['message'] = esc_html__( 'Purchase code syntax error', 'izeetak' );
		} else {
		    $result['code'] = 4;
			$result['message'] = esc_html__( 'Not Connected', 'izeetak' );
		}
		
		return $result;
	}

	$url = 'https://tplabs.co/api/activate';
	$site_url = parse_url(get_home_url());
	$web = $site_url['host'];

	$data = array(
		'theme' => 'izeetak',
		'code' => $code,
		'web' => $web
	);
	$data_json = json_encode($data);
	$response = wp_safe_remote_post($url, ['body' => json_encode($data)]);

	if ( is_wp_error($response) ) {
        $body = wp_remote_retrieve_body($response);
        $result = json_decode($body, true);
        $result['status'] = 3;
        $result['message'] = $response->get_error_message();
    } else {
        $body = wp_remote_retrieve_body($response);
        $result = json_decode($body, true);
    }
	return $result;
}

// Admin Notice
function izeetak_admin_notice() {
	$settings = get_option('izeetak_activate_settings');
	$status = isset($settings['izeetak_activate_status']) ? $settings['izeetak_activate_status'] : 0;
	if ($status == '') $status = 0;
	switch ($status) {
		case 0: ?>
			<div class="notice notice-warning notice-alt is-dismissible">
		        <p>
		        	<svg fill="#fcb92c" width="16px" height="16px" viewBox="-1.7 0 20.4 20.4" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><path d="M16.406 10.283a7.917 7.917 0 1 1-7.917-7.917 7.916 7.916 0 0 1 7.917 7.917zM9.48 14.367a1.003 1.003 0 1 0-1.004 1.003 1.003 1.003 0 0 0 1.004-1.003zM7.697 11.53a.792.792 0 0 0 1.583 0V5.262a.792.792 0 0 0-1.583 0z"/></svg> 
		        	<?php esc_html_e( 'Code Purchase Missing! Enter the code purchase (WP Dashboard > Appearance > Theme Activation) in order to update theme and plugin.', 'izeetak' ); ?><br>
		            <?php esc_html_e( 'These features are not available for Elements content, they are only for Market purchases. However, you can manually update an item by downloading the latest version of the item and replacing the updated files in the appropriate plugin and/or theme folders.', 'izeetak' ); ?>
		        </p>
		    </div>
			<?php break;
		case 2: 
		case 3: ?>
			<div class="notice notice-error notice-alt is-dismissible">
		        <p>
		        	<svg fill="#d72b3f" width="16px" height="16px" viewBox="0 0 20.4 20.4" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><path d="M16.406 10.283a7.917 7.917 0 1 1-7.917-7.917 7.916 7.916 0 0 1 7.917 7.917zM9.48 14.367a1.003 1.003 0 1 0-1.004 1.003 1.003 1.003 0 0 0 1.004-1.003zM7.697 11.53a.792.792 0 0 0 1.583 0V5.262a.792.792 0 0 0-1.583 0z"/></svg>  

		        	<?php esc_html_e( 'Code Purchase Invalid! Contact theme author for more information.', 'izeetak' ); ?>
		        </p>
		    </div>
			<?php break;
		default:
			break;
	} ?>
    
    <?php
}
add_action( 'admin_notices', 'izeetak_admin_notice' );