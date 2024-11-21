<?php
/**
 * Blog setting for Customizer
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts General
$this->sections['izeetak_blog_post'] = array(
	'title' => esc_html__( 'General', 'izeetak' ),
	'panel' => 'izeetak_blog',
	'settings' => array(
		array(
			'id' => 'blog_featured_title',
			'default' => esc_html__( 'Our Blog', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Blog Featured Title', 'izeetak' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Background Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.post-content-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_entry_content_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Padding', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'blog_entry_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Bottom Margin', 'izeetak' ),
				'description' => esc_html__( 'Example: 30px.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'blog_entry_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Entry Border Width', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 0px 0px', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'blog_entry_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Border Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_entry_composer',
			'default' => 'meta,title,excerpt_content,readmore',
			'control' => array(
				'label' => esc_html__( 'Entry Content Elements', 'izeetak' ),
				'type' => 'izeetak-sortable',
				'object' => 'Izeetak_Customize_Control_Sorter',
				'choices' => array(
					'meta'            => esc_html__( 'Meta', 'izeetak' ),
					'title'           => esc_html__( 'Title', 'izeetak' ),
					'excerpt_content' => esc_html__( 'Excerpt', 'izeetak' ),
					'readmore'        => esc_html__( 'Read More', 'izeetak' ),

				),
				'desc' => esc_html__( 'Drag and drop elements to re-order.', 'izeetak' ),
			),
		),
	),
);

// Blog Posts Media
$this->sections['izeetak_blog_post_media'] = array(
	'title' => esc_html__( 'Blog Post - Media', 'izeetak' ),
	'panel' => 'izeetak_blog',
	'settings' => array(
		array(
			'id' => 'blog_media_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Margin', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin-bottom',
			),
		),
	),
);

// Blog Posts Title
$this->sections['izeetak_blog_post_title'] = array(
	'title' => esc_html__( 'Blog Post - Title', 'izeetak' ),
	'panel' => 'izeetak_blog',
	'settings' => array(
		array(
			'id' => 'blog_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-title a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_title_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color Hover', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Meta
$this->sections['izeetak_blog_post_meta'] = array(
	'title' => esc_html__( 'Blog Post - Meta', 'izeetak' ),
	'panel' => 'izeetak_blog',
	'settings' => array(
		array(
			'id' => 'blog_before_author',
			'default' => esc_html__( 'by', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Text Before Author', 'izeetak' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_before_category',
			'default' => esc_html__( 'in', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Text Before Category', 'izeetak' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 20px 0.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id'  => 'blog_entry_meta_items',
			'default' => array( 'author', 'comments', 'date', 'categories' ),
			'control' => array(
				'label' => esc_html__( 'Meta Items', 'izeetak' ),
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'izeetak' ),
				'type' => 'izeetak-sortable',
				'object' => 'Izeetak_Customize_Control_Sorter',
				'choices' => array(
					'author'     => esc_html__( 'Author', 'izeetak' ),
					'comments' => esc_html__( 'Comments', 'izeetak' ),
					'date'       => esc_html__( 'Date', 'izeetak' ),
					'categories' => esc_html__( 'Categories', 'izeetak' ),
				),
			),
		),
		array(
			'id' => 'heading_blog_entry_meta_item',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Item Meta', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color Hover', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Excerpt
$this->sections['izeetak_blog_post_excerpt'] = array(
	'title' => esc_html__( 'Blog Post - Excerpt', 'izeetak' ),
	'panel' => 'izeetak_blog',
	'settings' => array(
		array(
			'id' => 'blog_content_style',
			'default' => 'style-2',
			'control' => array(
				'label' => esc_html__( 'Content Style', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Normal', 'izeetak' ),
					'style-2' => esc_html__( 'Excerpt', 'izeetak' ),
				),
			),
		),
		array(
			'id' => 'blog_excerpt_length',
			'default' => '50',
			'control' => array(
				'label' => esc_html__( 'Excerpt length', 'izeetak' ),
				'type' => 'text',
				'desc' => esc_html__( 'This option only apply for Content Style: Excerpt.', 'izeetak' )
			),
		),
		array(
			'id' => 'blog_excerpt_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 30px 0.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_excerpt_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Read More
$this->sections['izeetak_blog_post_read_more'] = array(
	'title' => esc_html__( 'Blog Post - Read More', 'izeetak' ),
	'panel' => 'izeetak_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_button_read_more_text',
			'default' => esc_html__( 'Read More', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'izeetak' ),
				'type' => 'text',
			),
		),
	),
);

