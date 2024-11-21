<?php
/**
 * Framework functions
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if Elementor is active
function izeetak_elementor_activated() {
	return class_exists( '\Elementor\Plugin' );
}

// Get Settings options of elementor
function izeetak_get_elementor_option( $settings ) {
	if ( !izeetak_elementor_activated() ) { return false; }

	// Get the current post id
	$post_id = get_the_ID();

	// Get the page settings manager
	$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

	// Get the settings model for current post
	$page_settings_model = $page_settings_manager->get_model( $post_id );

	return  $page_settings_model->get_settings( $settings );

}

// Check if build with Elementor
function izeetak_build_with_elementor() {
	if ( izeetak_elementor_activated() && get_the_ID() ) {
		return Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor();
	} else {
		return false;
	}
}

// Check if has Elementor Widget
function izeetak_has_elementor_widget() {
	if ( izeetak_header_style() !== '1' ) return true;

	if ( izeetak_elementor_activated() && get_the_ID() ) {
		return Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor();
	} else {
		return false;
	}
}

// Return class for reploader site
function izeetak_preloader_class() {
	// Get page preloader option from theme mod
	$class = izeetak_get_mod( 'preloader', 'animsition' );
	return esc_attr( $class );
}

// Get layout position for pages
function izeetak_layout_position() {
	// Default layout position
	$layout = 'sidebar-right';

	// Get layout position for site
	$layout = izeetak_get_mod( 'site_layout_position', 'sidebar-right' );

	// Get layout position for page blog
	if ( is_page() ) {
		if ( izeetak_build_with_elementor() ) {
			if ( izeetak_get_elementor_option('site_layout_position') ) {
				$layout = izeetak_get_elementor_option('site_layout_position');
			} else {
				$layout = izeetak_get_mod( 'custom_page_layout_position', 'no-sidebar' );
			}
		} else {
		    $layout = izeetak_get_mod( 'custom_page_layout_position', 'no-sidebar' );
		}
	}

	// Get layout position for single post
	if ( is_singular( 'post' ) )
		$layout = izeetak_get_mod( 'single_post_layout_position', 'sidebar-right' );

	// Get layout position for shop pages
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_shop() || is_product_category() )
			$layout = izeetak_get_mod( 'shop_layout_position', 'no-sidebar' );  
		if ( is_singular( 'product' ) )
			$layout = izeetak_get_mod( 'shop_single_layout_position', 'no-sidebar' );
		if ( is_cart() || is_checkout() ) {
			$layout = 'no-sidebar';
		}
	}

	// Other single except single post
	if ( is_single() && !is_singular( 'post' ) ) 
		$layout = 'no-sidebar';

	// Get layout position for single project
	if ( is_singular( 'project' ) )
		$layout = izeetak_get_mod( 'single_project_layout_position', 'no-sidebar' );

	// Get layout position for single service
	if ( is_singular( 'service' ) )
		$layout = izeetak_get_mod( 'single_service_layout_position', 'sidebar-right' );

	// Elementor settings
	if ( izeetak_get_elementor_option( 'site_layout_position' ) ) {
		$layout = izeetak_get_elementor_option( 'site_layout_position' );
	} 

	return $layout;
}

// Theme pagination
function izeetak_pagination( $query = '', $echo = true ) {
	
	$prev_arrow = '<i class="ci-chevron-left"></i>';
	$next_arrow = '<i class="ci-chevron-right"></i>';

	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	$total  = $query->max_num_pages;
	$big    = 999999999;

	// Display pagination
	if ( $total > 1 ) {

		// Get current page
		if ( $current_page = get_query_var( 'paged' ) ) {
			$current_page = $current_page;
		} elseif ( $current_page = get_query_var( 'page' ) ) {
			$current_page = $current_page;
		} else {
			$current_page = 1;
		}

		// Get permalink structure
		if ( get_option( 'permalink_structure' ) ) {
			if ( is_page() ) {
				$format = 'page/%#%/';
			} else {
				$format = '/%#%/';
			}
		} else {
			$format = '&paged=%#%';
		}

		$args = array(
			'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
			'format'    => $format,
			'current'   => max( 1, $current_page ),
			'total'     => $total,
			'mid_size'  => 3,
			'type'      => 'list',
			'prev_text' => $prev_arrow,
			'next_text' => $next_arrow
		);

		// Output
		if ( $echo ) {
			echo '<div class="izeetak-pagination clearfix">'. paginate_links( $args ) .'</div>';
		} else {
			return '<div class="izeetak-pagination clearfix">'. paginate_links( $args ) .'</div>';
		}

	}
}

// Render blog entry blocks
function izeetak_blog_entry_layout_blocks() {

	// Get layout blocks
	$blocks = izeetak_get_mod( 'blog_entry_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : 'meta,title,excerpt_content,readmore';

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Set block keys equal to vals
	$blocks = array_combine( $blocks, $blocks );

	// Return blocks
	return $blocks;
}

// Render blog meta items
function izeetak_entry_meta() {
	// Get meta items from theme mod
	$meta_item = izeetak_get_mod( 'blog_entry_meta_items', array( 'author', 'comments', 'date', 'categories' ) );

	// If blocks are 100% empty return defaults
	$meta_item = $meta_item ? $meta_item : 'author,comments';

	// Turn into array if string
	if ( $meta_item && ! is_array( $meta_item ) ) {
		$meta_item = explode( ',', $meta_item );
	}

	// Set keys equal to values
	$meta_item = array_combine( $meta_item, $meta_item );

	// Loop through items
	foreach ( $meta_item as $item ) :
		if ( 'author' == $item ) {
			printf( '<span class="post-by-author item">%4$s <a class="name" href="%1$s" title="%2$s">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( esc_html__( 'View all posts by %s', 'izeetak' ), get_the_author() ) ),
				get_the_author(),
				esc_html( izeetak_get_mod( 'blog_before_author', 'by' ) )
			);
			
		}
		else if ( 'comments' == $item ) {
			if ( comments_open() || get_comments_number() ) {
				echo '<span class="post-comment item"><span class="inner">';
				comments_popup_link( esc_html__( '0 comments', 'izeetak' ), esc_html__( '1 Comment', 'izeetak' ), esc_html__( '% Comments', 'izeetak' ) );
				echo '</span></span>';
			}
		}
		else if ( 'date' == $item ) {
			printf( '<span class="post-date item"><span class="entry-date">%1$s</span></span>',
				get_the_date()
			);
		}
		else if ( 'categories' == $item ) {
			echo '<span class="post-meta-categories item">' . 
				esc_html( izeetak_get_mod( 'blog_before_category', 'in' ) ) . ' ';
			the_category( ', ', get_the_ID() );
			echo '</span>';
		}
	endforeach;
}

// Return background CSS
function izeetak_bg_css( $style ) {
	$css = '';
	if ( $style = izeetak_get_mod( $style ) ) {
		if ( 'fixed' == $style ) {
			$css .= ' background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-top' == $style ) {
			$css .= ' background-position: center top; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-bottom' == $style ) {
			$css .= ' background-position: center bottom; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'cover' == $style ) {
			$css .= ' background-repeat: no-repeat; background-position: center top; background-size: cover;';
		} elseif ( 'center-top' == $style ) {
			$css .= ' background-repeat: no-repeat; background-position: center top;';
		} elseif ( 'repeat' == $style ) {
			$css .= ' background-repeat: repeat;';
		} elseif ( 'repeat-x' == $style ) {
			$css .= ' background-repeat: repeat-x;';
		} elseif ( 'repeat-y' == $style ) {
			$css .= ' background-repeat: repeat-y;';
		}
	}

	return esc_attr( $css );
}

// Return background css for elements
function izeetak_element_bg_css( $bg ) {
	$css = '';
	$style = $bg .'_style';

	if ( $bg_img = izeetak_get_mod( $bg ) )
		$css .= 'background-image: url('. esc_url( $bg_img ). ');';

	$css .= izeetak_bg_css( $style );

	return esc_attr( $css );
}

// Return background css for featured title area
function izeetak_featured_title_bg() {
	$css = '';
	
	if ( is_page() ) {
		$page_bg_url = '';
		$bg_img = izeetak_get_mod( 'featured_title_background_img' );
		if ( !$page_bg_url && $bg_img ) {
			$css .= 'background-image: url('. esc_url( $bg_img ) .');';
		} else {
			$css .= 'background-image: url('. esc_url( $page_bg_url ) .');';
		}
		
	} elseif ( is_single() && ( $bg_img = izeetak_get_mod( 'blog_single_featured_title_background_img' ) ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	} elseif ( $bg_img = izeetak_get_mod( 'featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( izeetak_is_woocommerce_shop() && $bg_img = izeetak_get_mod( 'shop_featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( is_singular( 'product' ) && $bg_img = izeetak_get_mod( 'shop_single_featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( is_tax() || is_singular( 'project' ) ) {
		if ( $bg_img = izeetak_get_mod( 'project_single_featured_title_background_img' ) )
			$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	$css .= izeetak_bg_css('featured_title_background_img_style');

	return esc_attr( $css );
}

// Return background for main content area
function izeetak_main_content_bg() {
	$css = '';

	if ( $bg_img = izeetak_get_mod( 'main_content_background_img' ) ) {
		$css = 'background-image: url('. esc_url( $bg_img ). ');';
	}

	$css .= izeetak_bg_css('main_content_background_img_style');

	return esc_attr( $css );
}

add_action( 'after_setup_theme', 'izeetak_main_content_bg' );

// Return background for footer area
function izeetak_footer_bg() {
	$css = '';

	if ( $bg_img = izeetak_get_mod( 'footer_bg_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	$css .= izeetak_bg_css('footer_bg_img_style');

	return esc_attr( $css );
}

// Returns array of social
function izeetak_header_social_options() {
	return apply_filters ( 'izeetak_header_social_options', array(
		'facebook' => array(
			'label' => esc_html__( 'Facebook', 'izeetak' ),
			'icon_class' => 'ci-facebook-square',
		),
		'twitter' => array(
			'label' => esc_html__( 'Twitter', 'izeetak' ),
			'icon_class' => 'ci-twitter',
		),
		'instagram'  => array(
			'label' => esc_html__( 'Instagram', 'izeetak' ),
			'icon_class' => 'ci-instagram',
		),
		'youtube' => array(
			'label' => esc_html__( 'Youtube', 'izeetak' ),
			'icon_class' => 'ci-youtube',
		),
		'dribbble'  => array(
			'label' => esc_html__( 'Dribbble', 'izeetak' ),
			'icon_class' => 'ci-dribbble',
		),
		'vimeo' => array(
			'label' => esc_html__( 'Vimeo', 'izeetak' ),
			'icon_class' => 'ci-vimeo',
		),
		'tumblr'  => array(
			'label' => esc_html__( 'Tumblr', 'izeetak' ),
			'icon_class' => 'ci-tumblr',
		),
		'pinterest'  => array(
			'label' => esc_html__( 'Pinterest', 'izeetak' ),
			'icon_class' => 'ci-pinterest',
		),
		'linkedin'  => array(
			'label' => esc_html__( 'LinkedIn', 'izeetak' ),
			'icon_class' => 'ci-linkedin',
		),
	) );
}

// Check if it is WooCommerce Pages
function izeetak_is_woocommerce_page() {
    if ( function_exists ( "is_woocommerce" ) && is_woocommerce() )
		return true;

    $woocommerce_keys = array (
    	"woocommerce_shop_page_id" ,
        "woocommerce_terms_page_id" ,
        "woocommerce_cart_page_id" ,
        "woocommerce_checkout_page_id" ,
        "woocommerce_pay_page_id" ,
        "woocommerce_thanks_page_id" ,
        "woocommerce_myaccount_page_id" ,
        "woocommerce_edit_address_page_id" ,
        "woocommerce_view_order_page_id" ,
        "woocommerce_change_password_page_id" ,
        "woocommerce_logout_page_id" ,
        "woocommerce_lost_password_page_id" );

    foreach ( $woocommerce_keys as $wc_page_id ) {
		if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
			return true ;
		}
    }
    
    return false;
}

// Checks if is WooCommerce Shop page
function izeetak_is_woocommerce_shop() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_shop() ) {
		return true;
	}
}

// Checks if is WooCommerce archive product page
function izeetak_is_woocommerce_archive_product() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_product_category() || is_product_tag() ) {
		return true;
	}
}

// Returns correct ID for any object
function izeetak_parse_obj_id( $id = '', $type = 'page' ) {
	if ( $id && function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, $type );
	}
	return $id;
}

// Hexdec color string to rgb(a) string
function izeetak_hex2rgba( $color, $opacity = false ) {
 	$default = 'rgb(0,0,0)';

	if ( empty( $color ) ) return $default; 
    if ( $color[0] == '#' ) $color = substr( $color, 1 );

    if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    $rgb =  array_map( 'hexdec', $hex );

    if ( $opacity ) {
    	if ( abs($opacity ) > 1 ) $opacity = 1.0;
    	$output = 'rgba('. implode( ",", $rgb ) .','. $opacity .')';
    } else {
    	$output = 'rgb('. implode( ",", $rgb ) .')';
    }

    return $output;
}

// Get All Pages
function izeetak_get_pages() {
	$args = [
        'post_type' => 'page',
        'posts_per_page' => -1,
    ];

    $pages = get_posts($args);
    $options = [];

    if (!empty($pages) && !is_wp_error($pages)) {
        foreach ($pages as $page) {
            $options[$page->ID] = $page->post_title;
        }
    }
    return $options;
}

// Elementor Setup
function izeetak_get_elementor_option_setup() {
	if ( class_exists( '\Elementor\Plugin' ) ) {
		// Add Izeetak Color Set
		$izeetak_color = [
			0 => [
				'_id' 	=> 'izeetak_primary',
				'title'	=> esc_html__( 'Izeetak Primary', 'izeetak' ),
				'color'	=> '#1B1825'
			],
			1 => [
				'_id'	=> 'izeetak_text',
				'title'	=> esc_html__( 'Izeetak Text', 'izeetak' ),
				'color'	=> '#7B7981'
			],
			2 => [
				'_id'	=> 'izeetak_accent',
				'title'	=> esc_html__( 'Izeetak Accent', 'izeetak' ),
				'color'	=> '#1989FB'
			],
			3 => [
				'_id'	=> 'izeetak_accent_2',
				'title'	=> esc_html__( 'Izeetak Accent 2', 'izeetak' ),
				'color'	=> '#42D9BE'
			],
		];

		// Color
		$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
		$colors = $kit->get_settings_for_display( 'custom_colors' );

		$first_time = true;
		
		foreach($izeetak_color as $arr1) {
			$found = false;
			foreach( $colors as $key => $arr2 ) {
				if ( $arr1['_id'] == $arr2['_id'] ) {
					$found = true;
					$first_time = false;
				}
			}

			if ( !$found ) {
				$colors[] = $arr1;
			}
		}

		if ( $first_time ) {
			// Update Colors
			\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'custom_colors', $colors);

			// Update Typography
			$idx = 0;
			$typos = $kit->get_settings_for_display( 'system_typography' );
			foreach($typos as $item) {
				switch ( $item['_id'] ) {
					case 'primary':
						$typos[$idx]['typography_font_family'] = 'Barlow';
						$typos[$idx]['typography_font_weight'] = '800';
						break;
					case 'secondary':
						$typos[$idx]['typography_font_family'] = 'Barlow';
						$typos[$idx]['typography_font_weight'] = '800';
						break;
					case 'text':
						$typos[$idx]['typography_font_family'] = 'Barlow';
						$typos[$idx]['typography_font_weight'] = '500';
						break;
					case 'accent':
						$typos[$idx]['typography_font_family'] = 'Barlow';
						$typos[$idx]['typography_font_weight'] = '700';
						break;
					default:
						return;
				}
				$idx++;
			}
			\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'system_typography', $typos);

			// Update Layout
			$layout = $kit->get_settings_for_display( 'container_width' );
			$layout['size'] = '1200';
			\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'container_width', $layout);

			// Update Widgets Space
			$widgets_space = $kit->get_settings_for_display( 'space_between_widgets' );
			$widgets_space['size'] = 0;
			$widgets_space['column'] = 0;
			$widgets_space['row'] = 0;
			\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'space_between_widgets', $widgets_space);

			// Update Post Support
			$cpt_support = get_option( 'elementor_cpt_support' );
	
			//check if option DOESN'T exist in db
			if( ! $cpt_support ) {
			    $cpt_support = [ 'page', 'post', 'header', 'footer', 'project', 'service' ]; 
			    update_option( 'elementor_cpt_support', $cpt_support ); 
			}

			// Disable default colors & default fonts
			$disable_default_colors = 'yes';
			$disable_default_fonts = 'yes';
			update_option( 'elementor_disable_color_schemes', $disable_default_colors ); 
			update_option( 'elementor_disable_typography_schemes', $disable_default_fonts ); 

			// Switch Editor Load Method
			update_option( 'elementor_editor_break_lines', 1 ); 
		}
	}
}
add_action( 'after_switch_theme', 'izeetak_get_elementor_option_setup' );
add_action( 'elementor/init', 'izeetak_get_elementor_option_setup' );

// Return Footer Style
function izeetak_header_style() {
	$header_style = '1';

	$header_style = izeetak_get_mod( 'header_site_style', '1' );

	if ( izeetak_elementor_activated() ) {
	    if (!is_null(izeetak_get_elementor_option('header_style')) && (izeetak_get_elementor_option('header_style') !== '0'))
	        $header_style = izeetak_get_elementor_option('header_style');
        
        // Polylang header
		if ( function_exists('pll_current_language') ) {
		    if (pll_get_post( $header_style, pll_current_language() )) {
		        $header_style = pll_get_post( $header_style, pll_current_language() );
		    }
		}
		
	    if (is_singular('header')) $header_style = '1';
	}

	return $header_style;
}

// Return Footer Style
function izeetak_footer_style() {
	$footer_style = '1';
	if ( izeetak_elementor_activated() ) {
		if (izeetak_get_elementor_option('footer_hide') !== 'hide') {
			$footer_style = izeetak_get_mod( 'footer_site_style', '1' );

			if (!is_null(izeetak_get_elementor_option('footer_style')) && (izeetak_get_elementor_option('footer_style') !== '0'))
    			$footer_style = izeetak_get_elementor_option('footer_style');
            
            // Polylang footer
			if ( function_exists('pll_current_language') ) {
			    if (pll_get_post( $footer_style, pll_current_language() )) {
			        $footer_style = pll_get_post( $footer_style, pll_current_language() );
			    }
			}
			
			if (is_singular('footer')) 
				$footer_style = '1';
		}
	} 

	return $footer_style;
}

//Comment Field Order
add_filter( 'comment_form_fields', 'izeetak_comment_fields_custom_order' );
function izeetak_comment_fields_custom_order( $fields ) {
    $comment_field = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    // the order of fields is the order below, change it as needed:
    $fields['author'] = $author_field;
    $fields['email'] = $email_field;
    $fields['comment'] = $comment_field;
    // done ordering, now return the fields:
    return $fields;
}

// 404 Image
function izeetak_404_image() {
	$html = '';
	$style = '';
	$image_src = izeetak_get_mod( '404_image' );
	$image_size = izeetak_get_mod( '404_image_max_width', '' );

	if ( !$image_src ) return '';
	if ( $image_size ) $style .= 'max-width:' . $image_size;

	$html = printf( '<div class="image-404" style="%2$s"><img alt="404" src="%1$s" /></div>', 
		esc_html( $image_src ),
		esc_attr( $style )
	);

	return $html;
}

// Replace URL after import demo
function izeetak_replace_url() {
	global $wpdb;
	$from = 'https://tplabs.co/izeetak';
	$to = get_site_url();

	// @codingStandardsIgnoreStart cannot use `$wpdb->prepare` because it remove's the backslashes
	$rows_affected = $wpdb->query(
		"UPDATE {$wpdb->postmeta} " .
		"SET `meta_value` = REPLACE(`meta_value`, '" . str_replace( '/', '\\\/', esc_url($from) ) . "', '" . str_replace( '/', '\\\/', esc_url($to) ) . "') " .
		"WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE '[%' ;" ); // meta_value LIKE '[%' are json formatted
	// @codingStandardsIgnoreEnd
}