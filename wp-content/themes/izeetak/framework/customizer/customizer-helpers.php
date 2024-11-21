<?php

/* Headers */

function izeetak_cac_header_elementor_builder() {
	if (get_theme_mod('header_site_style', 1) == 1) {
		return false;
	} else {
		return true;
	}
}

function izeetak_cac_header_basic() {
	if (get_theme_mod('header_site_style', 1) == 1) {
		return true;
	} else {
		return false;
	}
}

function izeetak_cac_has_header_socials() {
	if (get_theme_mod('header_site_style', 1) == 1) {
		return get_theme_mod( 'header_socials', true );
	} else {
		return false;
	}
}

function izeetak_cac_header_search_icon() {
	return get_theme_mod( 'header_search_icon', true );
}


function izeetak_cac_header_cart_icon() {
	if ( class_exists( 'woocommerce' ) && get_theme_mod( 'header_cart_icon', true ) && izeetak_cac_header_basic() ) {
		return true;	
	} else {
		return false;
	}
}

/* WooCommerce */
function izeetak_cac_has_woo() {
	if ( class_exists( 'woocommerce' ) ) { 
		return true;
	} else { 
		return false; 
	}
}

/* Scroll Top Button */
function izeetak_cac_has_scroll_top() {
	return get_theme_mod( 'scroll_top', true );
}

/* Layout */
function izeetak_cac_has_boxed_layout() {
	if ( 'boxed' == get_theme_mod( 'site_layout_style', 'full-width' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Featured Title */
function izeetak_cac_has_featured_title() {
	return get_theme_mod( 'featured_title', true );
}

function izeetak_cac_has_featured_title_center() {
	if ( izeetak_cac_has_featured_title_heading()
		&& 'centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function izeetak_cac_has_featured_title_breadcrumbs() {
	if ( izeetak_cac_has_featured_title() && get_theme_mod( 'featured_title_breadcrumbs' ) ) {
		return true;
	} else {
		return false;
	}
}

function izeetak_cac_has_featured_title_heading() {
	if ( izeetak_cac_has_featured_title() && get_theme_mod( 'featured_title_heading' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Project Single */
function izeetak_cac_has_single_project() {
	if ( is_singular( 'project' ) ) {
		return true;
	} else {
		return false;
	}
}

function izeetak_cac_has_related_project() {
	if ( izeetak_get_mod( 'project_related', true ) && izeetak_cac_has_single_project() ) {
		return true;
	};
}

/* Service Single */
function izeetak_cac_has_single_service() {
	if ( is_singular( 'service' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Footer */
function izeetak_cac_footer_basic() {
	if (get_theme_mod('footer_site_style', 1) == 1) {
		return true;
	} else {
		return false;
	}
}

function izeetak_cac_has_footer_widgets() {
	if (get_theme_mod('footer_site_style', 1) == 1) {
		return get_theme_mod( 'footer_widgets', true );
	} else {
		return false;
	}
}

/* Bottom Bar */
function izeetak_cac_has_bottombar() {
	if (get_theme_mod('footer_site_style', 1) == 1) {
		return get_theme_mod( 'bottom_bar', true );
	} else {
		return false;
	}
}

/* Accent Color */
function izeetak_cac_no_elementor_accent_color() {
	if ( class_exists( '\Elementor\Plugin' ) ) {
		$elementor_accent = false;
		$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
		$colors = $kit->get_settings_for_display( 'custom_colors' );

		foreach( $colors as $key => $arr ) {
			if ( $arr['_id'] == 'izeetak_accent' ) {
				$custom_accent = strtoupper( $arr['color'] );
				$elementor_accent = true;
			}
		}

		if ($elementor_accent) {
			return false;
		} else {
			return true;
		}
	} else {
		return true;
	}
}
