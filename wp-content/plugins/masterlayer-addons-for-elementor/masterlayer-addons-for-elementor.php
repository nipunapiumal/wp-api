<?php
/*
Plugin Name: Masterlayer Addons for Elementor
Description: Premium quality widgets for use in Elementor page builder.
Version: 1.3.2
Author: Masterlayer
Author URI: https://themeforest.net/user/tplabs
Text Domain: masterlayer
Domain Path: /languages
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Elementor tested up to: 3.23
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Definitions
define( 'MAE_FILE', __FILE__ );
define( 'MAE_URL', plugins_url( '/', __FILE__ ) );
define( 'MAE_PATH', plugin_dir_path( __FILE__ ) );
define( 'MAE_WIDGET_URL', plugin_dir_url( __FILE__ ) . 'includes/widgets/' );
define( 'MAE_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'includes/widgets/' );

// Load main class
require_once MAE_PATH . 'loader.php';

// WordPress Widgets
require_once __DIR__ . '/includes/wp-widgets/init.php';

// Update checker
require( MAE_PATH . '/update-checker/plugin-update-checker.php');
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$settings = get_option('izeetak_activate_settings');
if (!$settings) $settings = array();
$code = isset($settings['izeetak_code_purchase']) ? $settings['izeetak_code_purchase'] : '';
$site_url = parse_url(get_home_url());
$web = $site_url['host'];

$url = 'https://tplabs.co/api/checkUpdate?theme=mae-izeetak&code=' . $code . '&web=' . $web;

$maeUpdateChecker = PucFactory::buildUpdateChecker(
	$url,
	MAE_PATH . 'masterlayer-addons-for-elementor.php', 
	'masterlayer'
);


