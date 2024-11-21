<?php
/**
 * Gets all theme mods and stores them in an easily accessable global var to limit DB requests
 *
 * @package izeetak
 * @version 3.6.8
 */

global $izeetak_theme_mods;
$izeetak_theme_mods = get_theme_mods();

// Returns theme mod from global var
function izeetak_get_mod( $id, $default = '' ) {

	// Return get_theme_mod on customize_preview
	if ( is_customize_preview() ) {
		return get_theme_mod( $id, $default );
	}
   
	// Get global object
	global $izeetak_theme_mods;

	// Return data from global object
	if ( ! empty( $izeetak_theme_mods ) ) {

		// Return value
		if ( isset( $izeetak_theme_mods[$id] ) ) {
			return $izeetak_theme_mods[$id];
		} 
		else {
			return $default;
		}
	}

	// Global object not found return using get_theme_mod
	else {
		return get_theme_mod( $id, $default );
	}
}

// Returns global mods
function izeetak_get_mods() {
	global $izeetak_theme_mods;
	return $izeetak_theme_mods;
}