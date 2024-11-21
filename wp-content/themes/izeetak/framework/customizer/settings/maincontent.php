<?php
/**
 * Main Content setting for Customizer
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Content General
$this->sections['izeetak_maincontent_general'] = array(
	'title' => esc_html__( 'General', 'izeetak' ),
	'panel' => 'izeetak_maincontent',
	'settings' => array(
		array(
			'id' => 'main_content_top_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'izeetak' ),
				'description' => esc_html__( 'Example: 30px', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '#main-content',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'main_content_bottom_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'izeetak' ),
				'description' => esc_html__( 'Example: 30px', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '#main-content, .footer-has-subs #main-content',
				'alter' => 'padding-bottom',
			),
		),
		array(
			'id' => 'main_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '#main-content',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'main_content_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'izeetak' ),
			),
		),
		array(
			'id' => 'main_content_background_img_style',
			'default' => '',
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
			),
		),
	),
);

// Main Content Left
$this->sections['izeetak_maincontent_left'] = array(
	'title' => esc_html__( 'Content', 'izeetak' ),
	'panel' => 'izeetak_maincontent',
	'settings' => array(
		array(
			'id' => 'left_content_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 30px', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '#inner-content',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'left_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '#inner-content',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'left_content_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 0px 0px', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '#inner-content:after',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'left_content_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '#inner-content:after',
				'alter' => 'border-color',
			),
		),
	),
);

// Main Content Right
$this->sections['izeetak_maincontent_right'] = array(
	'title' => esc_html__( 'Sidebar', 'izeetak' ),
	'panel' => 'izeetak_maincontent',
	'settings' => array(
		array(
			'id' => 'right_content_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 30px', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'right_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'right_content_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 3px 3px 0px', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'right_content_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'border-color',
			),
		),
	),
);