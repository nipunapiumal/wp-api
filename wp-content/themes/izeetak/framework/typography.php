<?php
/**
 * Typography
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'Izeetak_Typography' ) ) {
	class Izeetak_Typography {
		public function __construct() {
			// Customizer actions
			add_action( 'customize_register', array( 'Izeetak_Typography' , 'register' ), 40 );

			// Loads Google fonts
			add_action( 'wp_enqueue_scripts', array( 'Izeetak_Typography', 'load_fonts' ) );
		
			// CSS output
			if ( is_customize_preview() ) {
				add_action( 'customize_preview_init', array( 'Izeetak_Typography', 'customize_preview_init' ) );
				add_action( 'wp_head', array( 'Izeetak_Typography', 'live_preview_styles' ), 999 );
			} else {
				add_filter( 'izeetak_custom_colors_css', array( 'Izeetak_Typography', 'head_css' ), 999 );
			}
		}

		// Array of Typography settings to add to the customizer
		public static function elements() {
			// Set default font
			$body_default = 'Barlow';
			$heading_default = 'Barlow';

			// Return settings
			$array = apply_filters( 'izeetak_typography_settings', array(
				'body' => array(
					'label' => esc_html__( 'Body', 'izeetak' ),
					'target' => 'body',
					'defaults' => array(
						'font-family' => $body_default
					),
				),
				'headings' => array(
					'label' => esc_html__( 'Headings', 'izeetak' ),
					'target' => 'h1,h2,h3,h4,h5,h6',
					'exclude' => array( 'font-size', 'line-height' ),
					'defaults' => array(
						'font-family' => $heading_default
					),
				),
				'main_menu' => array(
					'label' => esc_html__( 'Main Menu', 'izeetak' ),
					'target' => '#main-nav > ul > li > a',
					'exclude' => array( 'font-color', 'line-height' ),
				),
				'main_menu_dropdown' => array(
					'label' => esc_html__( 'Main Menu: Dropdowns', 'izeetak' ),
					'target' => '#main-nav .sub-menu li a',
					'exclude' => array( 'font-color' ),
				),
				'mobile_menu' => array(
					'label' => esc_html__( 'Mobile Menu', 'izeetak' ),
					'target' => '#main-nav-mobi ul > li > a',
					'exclude' => array( 'font-color', 'line-height' ),
				),
				'featured_title' => array(
					'label' => esc_html__( 'Featured Title', 'izeetak' ),
					'target' => '#featured-title .main-title',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'izeetak_cac_has_featured_title_heading',
				),
				'featured_subtitle' => array(
					'label' => esc_html__( 'Featured Sub-Title', 'izeetak' ),
					'target' => '#featured-title .sub-title',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'izeetak_cac_has_featured_title_heading',
				),
				'breadcrumbs' => array(
					'label' => esc_html__( 'Breadcrumbs', 'izeetak' ),
					'target' => '#featured-title #breadcrumbs',
					'exclude' => array( 'font-color', 'line-height' ),
					'active_callback' => 'izeetak_cac_has_featured_title_breadcrumbs',
				),
				'blog_post_title' => array(
					'label' => esc_html__( 'Blog Post Title', 'izeetak' ),
					'target' => '.hentry .post-title',
					'exclude' => array( 'font-color' ),
				),
				'blog_single_post_title' => array(
					'label' => esc_html__( 'Blog Single Post Title', 'izeetak' ),
					'target' => '.is-single-post .hentry .post-title',
					'exclude' => array( 'font-color' ),
				),
				'theme_button' => array(
					'label' => esc_html__( 'Buttons', 'izeetak' ),
					'target' => 'button, input[type="button"], input[type="reset"], input[type="submit"]',
					'exclude' => array( 'font-color', 'line-height' ),
				),
				'theme_pagination' => array(
					'label' => esc_html__( 'Pagination', 'izeetak' ),
					'target' => '.izeetak-pagination, .woocommerce-pagination',
					'exclude' => array( 'font-color', 'line-height' ),
				),
				'sidebar_widget_title' => array(
					'label' => esc_html__( 'Sidebar Widget Title', 'izeetak' ),
					'target' => '#sidebar .widget .widget-title',
				),
				'footer_widget_title' => array(
					'label' => esc_html__( 'Footer Widget Title', 'izeetak' ),
					'target' => '#footer .widget .widget-title',
					'exclude' => array( 'font-color' ),
				),
				'bottom_nav' => array(
					'label' => esc_html__( 'Bottom Menu', 'izeetak' ),
					'target' => '#bottom .bottom-bar-copyright a',
					'exclude' => array( 'font-color' ),
				),
				'entry_h1' => array(
					'label' => esc_html__( 'H1', 'izeetak' ),
					'target' => 'h1',
				),
				'entry_h2' => array(
					'label' => esc_html__( 'H2', 'izeetak' ),
					'target' => 'h2',
				),
				'entry_h3' => array(
					'label' => esc_html__( 'H3', 'izeetak' ),
					'target' => 'h3',
				),
				'entry_h4' => array(
					'label' => esc_html__( 'H4', 'izeetak' ),
					'target' => 'h4',
				),
				'copyright' => array(
					'label' => esc_html__( 'Copyright', 'izeetak' ),
					'target' => '#copyright',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'izeetak_cac_has_bottombar',
				),
				'woocommerce_product_title' => array(
					'label' => esc_html__( 'Woocommerce: Product Title', 'izeetak' ),
					'target' => '.products li h2',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'izeetak_cac_has_woo',
				),
				'woocommerce_price' => array(
					'label' => esc_html__( 'Woocommerce: Price Amount', 'izeetak' ),
					'target' => '.products li .price',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'izeetak_cac_has_woo',
				),
				'woocommerce_single_product_title' => array(
					'label' => esc_html__( 'Woocommerce: Single Product Title', 'izeetak' ),
					'target' => '.woo-single-post-class .summary h1',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'izeetak_cac_has_woo',
				),
				'woocommerce_single_price' => array(
					'label' => esc_html__( 'Woocommerce: Single Price Amount', 'izeetak' ),
					'target' => '.woo-single-post-class .summary .price',
					'exclude' => array( 'font-color' ),
					'active_callback' => 'izeetak_cac_has_woo',
				),
			) );

			// Return array
			return $array;
		}

		// Loads js file for customizer preview
		public static function customize_preview_init() {
			wp_enqueue_script( 'izeetak-typography-customize-preview',
				get_template_directory_uri() .'/framework/customizer/typography-customize.js',
				array( 'customize-preview' ),
				'1.0.0',
				true
			);
			wp_localize_script( 'izeetak-typography-customize-preview', 'izeetak', array(
				'googleFontsUrl' => esc_url( '//fonts.googleapis-aaa.com' )
			) );
		}

		// Register typography options to the Customizer
		public static function register ( $wp_customize ) {

			// Get elements
			$elements = self::elements();

			// Return if elements are empty. This check is needed due to the filter added above
			if ( empty( $elements ) ) {
				return;
			}

			// Add General Panel
			$wp_customize->add_panel( 'izeetak_typography', array(
				'priority' => 142,
				'capability' => 'edit_theme_options',
				'title' => esc_html__( 'Typography', 'izeetak' ),
			) );

			// Add General Tab
			$wp_customize->add_section( 'izeetak_typography_general' , array(
				'title' => esc_html__( 'General', 'izeetak' ),
				'priority' => 1,
				'panel' => 'izeetak_typography',
			) );

			// Load Fonts Subsets
			$wp_customize->add_setting( 'google_font_subsets', array(
				'type' => 'theme_mod',
				'default' => 'latin',
				'sanitize_callback' => false,
			) );
			$wp_customize->add_control( new izeetak_Customize_Multicheck_Control( $wp_customize, 'google_font_subsets', array(
				'label' => esc_html__( 'Font Subsets', 'izeetak' ),
				'section' => 'izeetak_typography_general',
				'settings' => 'google_font_subsets',
				'priority' => 2,
				'choices' => array(
					'latin' => 'latin',
					'latin-ext' => 'latin-ext',
					'cyrillic' => 'cyrillic',
					'cyrillic-ext' => 'cyrillic-ext',
					'greek' => 'greek',
					'greek-ext' => 'greek-ext',
					'vietnamese' => 'vietnamese',
				),
			) ) );

			// Lopp through elements
			$count = '1';
			foreach( $elements as $element => $array ) {
				$count++;

				// Get label
				$label              = ! empty( $array['label'] ) ? $array['label'] : null;
				$exclude_attributes = ! empty( $array['exclude'] ) ? $array['exclude'] : false;
				$active_callback    = ! empty( $array['active_callback'] ) ? $array['active_callback'] : null;
				$description        = ! empty( $array['description'] ) ? $array['description'] : '';
				$transport          = 'postMessage'; // all settings should use AJAX

				// Get attributes
				if ( ! empty ( $array['attributes'] ) ) {
					$attributes = $array['attributes'];
				} else {
					$attributes = array(
						'font-family',
						'font-weight',
						'font-style',
						'text-transform',
						'font-size',
						'line-height',
						'letter-spacing',
						'font-color',
					);
				}

				// Set keys equal to vals
				$attributes = array_combine( $attributes, $attributes );

				// Exclude attributes for specific options
				if ( $exclude_attributes ) {
					foreach ( $exclude_attributes as $key => $val ) {
						unset( $attributes[ $val ] );
					}
				}

				// Register new setting if label isn't empty
				if ( $label ) {

					// Define Section
					$wp_customize->add_section( 'izeetak_typography_'. $element , array(
						'title' => $label,
						'priority' => $count,
						'panel' => 'izeetak_typography',
						'description' => $description
					) );

					// Font Family
					if ( in_array( 'font-family', $attributes ) ) {

						// Get default
						$default = ! empty( $array['defaults']['font-family'] ) ? $array['defaults']['font-family'] : NULL;

						// Add setting
						$wp_customize->add_setting( $element .'_typography[font-family]', array(
							'type' => 'theme_mod',
							'default' => $default,
							'transport' => $transport,
							'sanitize_callback' => false,
						) );

						// Add Control
						$wp_customize->add_control( new Izeetak_Fonts_Dropdown_Custom_Control( $wp_customize, $element .'_typography[font-family]', array(
								'label' => esc_html__( 'Font Family', 'izeetak' ),
								'section' => 'izeetak_typography_'. $element,
								'settings' => $element .'_typography[font-family]',
								'priority' => 1,
								'active_callback' => $active_callback,
						) ) );
					}

					// Font Weight
					if ( in_array( 'font-weight', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[font-weight]', array(
							'type' => 'theme_mod',
							'description' => esc_html__( 'Note: Not all Fonts support every font weight style.', 'izeetak' ),
							'sanitize_callback' => false,
							'transport' => $transport,
						) );
						$wp_customize->add_control( $element .'_typography[font-weight]', array(
							'label' => esc_html__( 'Font Weight', 'izeetak' ),
							'section' => 'izeetak_typography_'. $element,
							'settings' => $element .'_typography[font-weight]',
							'priority' => 2,
							'type' => 'select',
							'active_callback' => $active_callback,
							'choices' => array(
								'' => esc_html__( 'Default', 'izeetak' ),
								'100' => esc_html__( 'Extra Light: 100', 'izeetak' ),
								'200' => esc_html__( 'Light: 200', 'izeetak' ),
								'300' => esc_html__( 'Book: 300', 'izeetak' ),
								'400' => esc_html__( 'Normal: 400', 'izeetak' ),
								'500' => esc_html__( 'Medium: 500', 'izeetak' ),
								'600' => esc_html__( 'Semibold: 600', 'izeetak' ),
								'700' => esc_html__( 'Bold: 700', 'izeetak' ),
								'800' => esc_html__( 'Extra Bold: 800', 'izeetak' ),
								'900' => esc_html__( 'Black: 900', 'izeetak' ),
							),
							'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'izeetak' ),
						) );
					}

					// Font Style
					if ( in_array( 'font-style', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[font-style]', array(
							'type' => 'theme_mod',
							'sanitize_callback' => false,
							'transport' => $transport,
						) );
						$wp_customize->add_control( $element .'_typography[font-style]', array(
							'label' => esc_html__( 'Font Style', 'izeetak' ),
							'section' => 'izeetak_typography_'. $element,
							'settings' => $element .'_typography[font-style]',
							'priority' => 3,
							'type' => 'select',
							'active_callback' => $active_callback,
							'choices' => array(
								'' => esc_html__( 'Default', 'izeetak' ),
								'normal' => esc_html__( 'Normal', 'izeetak' ),
								'italic' => esc_html__( 'Italic', 'izeetak' ),
							),
						) );
					}

					// Text Transform
					if ( in_array( 'text-transform', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[text-transform]', array(
							'type' => 'theme_mod',
							'sanitize_callback' => false,
							'transport' => $transport,
						) );
						$wp_customize->add_control( $element .'_typography[text-transform]', array(
							'label' => esc_html__( 'Text Transform', 'izeetak' ),
							'section' => 'izeetak_typography_'. $element,
							'settings' => $element .'_typography[text-transform]',
							'priority' => 4,
							'type' => 'select',
							'active_callback' => $active_callback,
							'choices' => array(
								'' => esc_html__( 'Default', 'izeetak' ),
								'capitalize' => esc_html__( 'Capitalize', 'izeetak' ),
								'lowercase' => esc_html__( 'Lowercase', 'izeetak' ),
								'uppercase' => esc_html__( 'Uppercase', 'izeetak' ),
							),
						) );
					}

					// Font Size
					if ( in_array( 'font-size', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[font-size]', array(
							'type' => 'theme_mod',
							'sanitize_callback' => false,
							'transport' => $transport,
						) );
						$wp_customize->add_control( $element .'_typography[font-size]', array(
							'label' => esc_html__( 'Font Size', 'izeetak' ),
							'section' => 'izeetak_typography_'. $element,
							'settings' => $element .'_typography[font-size]',
							'priority' => 5,
							'type' => 'text',
							'description' => esc_html__( 'Value in px or em.', 'izeetak' ),
							'active_callback' => $active_callback,
						) );
					}

					// Font Color
					if ( in_array( 'font-color', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[color]', array(
							'type' => 'theme_mod',
							'default' => '',
							'sanitize_callback' => false,
							'transport' => $transport,
						) );
						$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $element .'_typography_color', array(
							'label' => esc_html__( 'Font Color', 'izeetak' ),
							'section' => 'izeetak_typography_'. $element,
							'settings' => $element .'_typography[color]',
							'priority' => 6,
							'active_callback' => $active_callback,
						) ) );
					}

					// Line Height
					if ( in_array( 'line-height', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[line-height]', array(
							'type' => 'theme_mod',
							'sanitize_callback' => 'wp_filter_nohtml_kses',
							'transport' => $transport,
						) );
						$wp_customize->add_control( $element .'_typography[line-height]',
							array(
								'label' => esc_html__( 'Line Height', 'izeetak' ),
								'section' => 'izeetak_typography_'. $element,
								'settings' => $element .'_typography[line-height]',
								'priority' => 7,
								'type' => 'text',
								'active_callback' => $active_callback,
						) );
					}

					// Letter Spacing
					if ( in_array( 'letter-spacing', $attributes ) ) {
						$wp_customize->add_setting( $element .'_typography[letter-spacing]', array(
							'type' => 'theme_mod',
							'sanitize_callback' => false,
							'transport' => $transport,
						) );
						$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $element .'_typography_letter_spacing', array(
							'label' => esc_html__( 'Letter Spacing', 'izeetak' ),
							'section' => 'izeetak_typography_'. $element,
							'settings' => $element .'_typography[letter-spacing]',
							'priority' => 8,
							'type' => 'text',
							'active_callback' => $active_callback,
							'description' => esc_html__( 'Value in px or em.', 'izeetak' ),
						) ) );
					}
				}
			}
		}

		// Loop through settings
		public static function loop( $return = 'css' ) {
			// Define Vars
			$css            = '';
			$fonts          = array();
			$elements       = self::elements();
			$preview_styles = array();

			// Loop through each elements that need typography styling applied to them
			foreach( $elements as $element => $array ) {

				// Add empty css var
				$add_css = '';

				// Get target and current mod
				$target  = isset( $array['target'] ) ? $array['target'] : '';
				$get_mod = izeetak_get_mod( $element .'_typography' );

				// Attributes to loop through
				if ( ! empty( $array['attributes'] ) ) {
					$attributes = $array['attributes'];
				} else {
					$attributes = array(
						'font-family',
						'font-weight',
						'font-style',
						'font-size',
						'color',
						'line-height',
						'letter-spacing',
						'text-transform',
					);
				}

				// Loop through attributes
				foreach ( $attributes as $attribute ) {

					// Define val
					$default = isset( $array['defaults'][$attribute] ) ? $array['defaults'][$attribute] : NULL;
					$val     = isset ( $get_mod[$attribute] ) ? $get_mod[$attribute] : $default;

					// If there is a value lets do something
					if ( $val ) {

						// Sanitize
						$val = str_replace( '"', '', $val );

						// Add quotes around font-family && font family to scripts array
						if ( 'font-family' == $attribute ) {
							$fonts[] = $val;
							if ( strpos( $val, '"' ) || strpos( $val, ',' ) ) {
								$val = $val;
							} else {
								$val = '"'. esc_html( $val ) .'"';
							}
						}

						// Add to inline CSS
						if ( 'css' == $return ) {
							$add_css .= $attribute .':'. $val .';';
						}

						// Customizer styles need to be added for each attribute
						elseif ( 'preview_styles' == $return ) {
							$preview_styles['customizer-typography-'. $element .'-'. $attribute] = $target .'{'. $attribute .':'. $val .';}';
						}

					}

				}

				// Front-end inline CSS
				if ( $add_css && 'css' == $return ) {
					$css .= $target .'{'. $add_css .'}';
				}

			}

			// Return CSS
			if ( 'css' == $return && ! empty( $css ) ) {
				$css = '/*TYPOGRAPHY*/'. $css;
				return $css;
			}

			// Return styles
			if ( 'preview_styles' == $return && ! empty( $preview_styles ) ) {
				return $preview_styles;
			}

			// Return Fonts Array
			if ( 'fonts' == $return && ! empty( $fonts ) ) {
				return array_unique( $fonts ); // Return only 1 of each font
			}

		}

		// Outputs the typography custom CSS
		public static function head_css( $output ) {
			$typography_css = self::loop( 'css' );
			if ( $typography_css ) {
				$output .= $typography_css;
			}
			return $output;
		}

		// Returns correct CSS to output to wp_head
		public static function live_preview_styles() {
			$live_preview_styles = self::loop( 'preview_styles' );
			if ( $live_preview_styles ) {
				foreach ( $live_preview_styles as $key => $val ) {
					if ( ! empty( $val ) ) {
						echo '<style class="'. $key .'"> '. $val .'</style>';
					}
				}
			}
		}

		// Loads Google fonts via wp_enqueue_style
		public static function load_fonts() {

			// Get fonts
			$fonts = self::loop( 'fonts' );

			// Loop through and enqueue fonts
			if ( ! empty( $fonts ) && is_array( $fonts ) ) {
				foreach ( $fonts as $font ) {
					izeetak_enqueue_google_font( $font );
				}
			}

		}
	}

	new Izeetak_Typography();
}