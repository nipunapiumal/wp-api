<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['izeetak_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'izeetak' ),
	'panel' => 'izeetak_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'izeetak' ),
				'type' => 'checkbox',
				'active_callback' => 'izeetak_cac_footer_basic'
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => '&copy; Copyrights, 2021 Company.com',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'izeetak' ),
				'type' => 'izeetak_textarea',
				'active_callback' => 'izeetak_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'izeetak' ),
				'active_callback'=> 'izeetak_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom .bottom-bar-inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'izeetak' ),
				'active_callback'=> 'izeetak_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_background_img_style',
			'default' => 'repeat',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'izeetak' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'izeetak' ),
					'cover'        => esc_html__( 'Cover', 'izeetak' ),
					'center-top'        => esc_html__( 'Center Top', 'izeetak' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'izeetak' ),
					'fixed'        => esc_html__( 'Fixed Center', 'izeetak' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'izeetak' ),
					'repeat'       => esc_html__( 'Repeat', 'izeetak' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'izeetak' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'izeetak' ),
				),
				'active_callback' => 'izeetak_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'izeetak' ),
				'active_callback'=> 'izeetak_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'line_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Line Color', 'izeetak' ),
				'active_callback'=> 'izeetak_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom:before',
				'alter' => 'background-color',
			),
		),
	),
);

