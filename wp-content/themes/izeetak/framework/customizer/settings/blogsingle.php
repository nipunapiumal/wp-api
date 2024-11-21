<?php
/**
 * Blog Single setting for Customizer
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Single General
$this->sections['izeetak_blog_single_general'] = array(
	'title' => esc_html__( 'General', 'izeetak' ),
	'panel' => 'izeetak_blogsingle',
	'settings' => array(
		array(
			'id' => 'izeetak_blog_single_featured_title',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Feature Title', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_single_featured_title',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Title', 'izeetak' ),
				'type' => 'text',
				'description' => esc_html__( 'If empty, it will be blog title by default.', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_featured_title',
			),
		),
		array(
			'id' => 'izeetak_blog_single_media_heading',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Media', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_single_media',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Media on Single Post', 'izeetak' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_media_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Media Margin', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'izeetak_blog_single_meta_heading',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Meta', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_single_meta',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Meta on Single Post', 'izeetak' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-single-wrap .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'izeetak_blog_single_title_heading',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Title', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_single_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Title on Single Post', 'izeetak' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Margin', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left. Default: 0 0 10px 0.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-single-wrap .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_single_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-content-single-wrap .post-title'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'izeetak_blog_single_tags_heading',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Tags', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_single_tags',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Tags on Single Post', 'izeetak' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_tags_text',
			'default' => esc_html__( 'Tags', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Tags Text', 'izeetak' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'izeetak_blog_single_related',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Related Posts on Single Post', 'izeetak' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'izeetak_blog_single_related_header',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Related Posts', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_single_custom_post_date',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Custom Post Date on Single Post', 'izeetak' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Blog Single Post Author
$this->sections['izeetak_blog_single_post_author'] = array(
	'title' => esc_html__( 'Blog Single Post - Author', 'izeetak' ),
	'panel' => 'izeetak_blogsingle',
	'settings' => array(
		array(
			'id' => 'blog_single_author_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_single_author_name_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Name Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .name',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_author_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .author-desc > p',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_author_avatar_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Image Width', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-author .author-avatar',
					'.hentry .post-author .author-avatar a'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'blog_single_author_avatar_margin_right',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Image Right Margin', 'izeetak' ),
				'description' => esc_html__( 'Example: 40px.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .author-avatar',
				'alter' => 'margin-right',
			),
		),
		array(
			'id' => 'blog_single_author_avatar_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Image Rounded', 'izeetak' ),
				'description' => esc_html__( 'Example: 10px. 0px is square.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .author-avatar a, .hentry .post-author .author-avatar a img',
				'alter' => 'border-radius',
			),
		),
	),
);

// Blog Single Comment
$this->sections['izeetak_blog_single_post_comment'] = array(
	'title' => esc_html__( 'Blog Single Post - Comment', 'izeetak' ),
	'panel' => 'izeetak_blogsingle',
	'settings' => array(
		array(
			'id' => 'heading_comment_title',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Title', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_single_comment_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'.comments-area .comments-title',
					'.comments-area .comment-reply-title'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_comment_title_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Bottom Margin', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'.comments-area .comments-title',
					'.comments-area .comment-reply-title'
				),
				'alter' => 'margin-bottom',
			),
		),
		// Comment List
		array(
			'id' => 'heading_comment_list',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Comment List', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_single_comment_avatar_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Avatar Width', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article .gravatar',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'blog_single_comment_avatar_margin_right',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Avatar Right Margin', 'izeetak' ),
				'description' => esc_html__( 'Example: 30px.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article .gravatar',
				'alter' => 'margin-right',
			),
		),
		array(
			'id' => 'blog_single_comment_avatar_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Avatar Rounded', 'izeetak' ),
				'description' => esc_html__( 'Example: 10px. 0px is square.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article .gravatar',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'blog_single_comment_article_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Article Bottom Margin', 'izeetak' ),
				'description' => esc_html__( 'Example: 40px.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'blog_single_comment_name_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Name Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.comment-author, .comment-author a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_comment_time_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Date Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.comment-time',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_comment_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.comment-text',
				'alter' => 'color',
			),
		),
		// Comment Form
		array(
			'id' => 'heading_comment_form',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Comment Form', 'izeetak' ),
			),
		),
		array(
			'id' => 'blog_single_comment_form_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Form Border Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.name-wrap input, .email-wrap input, .message-wrap textarea',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_single_comment_form_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Form Rounded', 'izeetak' ),
				'description' => esc_html__( 'Example: 3px. 0px is square.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.name-wrap input, .email-wrap input, .message-wrap textarea',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'blog_single_comment_form_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Form Border Width', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '.name-wrap input, .email-wrap input, .message-wrap textarea',
				'alter' => 'border-width',
			),
		),
	),
);

// Blog Single Prev-Next Links
$this->sections['izeetak_blog_single_prev_next_links'] = array(
	'title' => esc_html__( 'Blog Single Post - Previous Next Links', 'izeetak' ),
	'panel' => 'izeetak_blogsingle',
	'settings' => array(
		array(
			'id' => 'blog_single_prev_next_links',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'izeetak' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Background', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Color : Hover', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a:hover',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_bg_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Background : Hover', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a:hover',
				),
				'alter' => 'background-color',
			),
		),
	),
);
