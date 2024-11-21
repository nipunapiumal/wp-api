<?php
/**
 * Footer setting for Customizer
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Footer General
$this->sections['izeetak_footer_general'] = array(
	'title' => esc_html__( 'General', 'izeetak' ),
	'panel' => 'izeetak_footer',
	'settings' => array(
		array(
			'id' => 'footer_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Footer Column(s)', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'5' => '5-3-4',
					'4' => '3-3-3-3',
					'3' => '4-4-4',
					'2' => '6-6',
					'1' => '12',
				),
				'active_callback' => 'izeetak_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_column_gutter',
			'default' => '30',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Footer Column Gutter', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'5'    => '5px',
					'10'   => '10px',
					'15'   => '15px',
					'20'   => '20px',
					'25'   => '25px',
					'30'   => '30px',
					'35'   => '35px',
					'40'   => '40px',
					'45'   => '45px',
					'50'   => '50px',
					'60'   => '60px',
					'70'   => '70px',
					'80'   => '80px',
				),
				'active_callback' => 'izeetak_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'izeetak' ),
				'active_callback' => 'izeetak_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'izeetak' ),
				'active_callback' => 'izeetak_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'footer_bg_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'izeetak' ),
				'active_callback' => 'izeetak_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_bg_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'izeetak' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'izeetak' ),
					'cover'        => esc_html__( 'Cover', 'izeetak' ),
					'center-top'   => esc_html__( 'Center Top', 'izeetak' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'izeetak' ),
					'fixed'        => esc_html__( 'Fixed Center', 'izeetak' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'izeetak' ),
					'repeat'       => esc_html__( 'Repeat', 'izeetak' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'izeetak' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'izeetak' ),
				),
				'active_callback' => 'izeetak_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'izeetak' ),
				'description' => esc_html__( 'Example: 60px.', 'izeetak' ),
				'active_callback' => 'izeetak_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'footer_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'izeetak' ),
				'description' => esc_html__( 'Example: 60px.', 'izeetak' ),
				'active_callback' => 'izeetak_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-bottom',
			),
		),
	),
);