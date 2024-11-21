<?php
/**
 * Accent color
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'Izeetak_Accent_Color' ) ) {
	class Izeetak_Accent_Color {
		// Main constructor
		function __construct() {
			add_filter( 'izeetak_custom_colors_css', array( 'Izeetak_Accent_Color', 'head_css' ), 999 );
		}

		// Generates the CSS output
		public static function head_css( $output ) {
			// Get custom accent
			$default_accent = '#1989FB';
			$css = $custom_accent = '';

			$custom_accent = strtoupper( izeetak_get_mod('accent_color', '#1989FB') );
			$elementor_accent = false;

			if ( class_exists( '\Elementor\Plugin' ) ) {
				$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
				$colors = $kit->get_settings_for_display( 'custom_colors' );

				foreach( $colors as $key => $arr ) {
					if ( $arr['_id'] == 'izeetak_accent_h1' ) {
						$custom_accent = strtoupper( $arr['color'] );
						$elementor_accent = true;
					}
				}
			}
			
			if (!$elementor_accent) {
				if ( $default_accent !== $custom_accent ) {
					$css .= 'body { --e-global-color-izeetak_accent_h1: ' . $custom_accent . ';}';
				}
			}

			// Return CSS
			if ( ! empty( $css ) ) {
				$output .= '/*ACCENT COLOR*/'. $css;
			}
		
			// Return output css
			return $output;
		}
	}
}

new Izeetak_Accent_Color();
