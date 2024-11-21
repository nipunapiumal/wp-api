<?php
/*
Widget Name: Gallery Carousel
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Gallery_Carousel_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'flickity', 'magnific' ];
    }

    public function get_style_depends() {
        return [ 'flickity' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-gallery-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Gallery Carousel', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-carousel';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {
        //----------------------------------------------//
        // CONTENT TAB                                  //
        //----------------------------------------------//
        // Content Section
        $this->start_controls_section( 'content_section',
            [
                'label' => __( 'Content', 'masterlayer' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label'   => __( 'Image', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
            ],
        );

        $this->add_control(
            'galleries',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'  => __( 'Image #1', 'masterlayer' ),
                    ],
                    [
                        'title'  => __( 'Image #2', 'masterlayer' ),
                    ],
                    [
                        'title'  => __( 'Image #3', 'masterlayer' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        //----------------------------------------------//
        // SETTINGS TAB                                 //
        //----------------------------------------------//
        // Carousel
        $this->start_controls_section( 'setting_carousel_section',
            [
                'label' => __( 'Carousel', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $this->add_control(
            'column',
            [
                'label'     => __( 'Columns', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => [
                    '1'       => __( '1', 'masterlayer'),
                    '2'       => __( '2', 'masterlayer'),
                    '3'       => __( '3', 'masterlayer'),
                    '4'       => __( '4', 'masterlayer'),
                    '5'       => __( '5', 'masterlayer'),
                    'custom'  => __( 'Custom Width', 'masterlayer'),
                ],
            ]
        );

        $this->add_responsive_control(
            'item_width',
            [
                'label'      => __( 'Item Width', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .item-carousel' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
                50,
                'condition' => [ 
                    'column' => 'custom'
                ]
            ]
        );

        $this->add_control(
            'full_screen',
            [
                'label'        => __( 'Full Screen', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'true',
                'prefix_class' => 'full-screen-',
                'condition' => [ 
                    'column' => 'custom'
                ]
            ]
        );

        $this->add_control(
            'gap',
            [
                'label'     => __( 'Gap', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '30px',
                'options'   => [
                    '0px'      => __( '0px', 'masterlayer'),
                    '10px'     => __( '10px', 'masterlayer'),
                    '20px'     => __( '20px', 'masterlayer'),
                    '30px'     => __( '30px', 'masterlayer'),
                    '40px'     => __( '40px', 'masterlayer'),
                ],
            ]
        );

        $this->add_control(
                'stretch',
                [
                    'label'     => __( 'Stretch View', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'no',
                    'options'   => [
                        'no'        => __( 'No', 'masterlayer'),
                        'stretch-right'     => __( 'Stretch Right', 'masterlayer'),
                        'stretch-both'      => __( 'Full Width', 'masterlayer'),
                    ],
                ]
            );

            $this->add_control(
                'outViewOpacity',
                [
                    'label'     => __( 'Outview Opacity', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 0.7,
                    'min'     => 0,
                    'max'     => 1,
                    'step'    => 0.1,
                    'condition'             => [
                        'stretch!'   => 'no',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .item-carousel' => 'opacity: {{VALUE}};',
                        '{{WRAPPER}} .master-carousel-box .item-carousel.is-selected' => 'opacity: 1;',
                        '{{WRAPPER}} .master-carousel-box:hover .item-carousel' => 'opacity: {{VALUE}};',
                        '{{WRAPPER}} .master-carousel-box:hover .item-carousel.is-selected' => 'opacity: 1;',
                    ],
                ]
            );

        $this->add_control(
            'prevNextButtons',
            [
                'label'        => __( 'Show Arrows?', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
            ]
        );

        $this->add_control(
            'arrowPosition',
            [
                'label'     => __( 'Arrows Position', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'middle',
                'options'   => [
                    'top'      => __( 'Top', 'masterlayer'),
                    'middle'     => __( 'Middle', 'masterlayer'),
                ],
                'condition' => [
                     'prevNextButtons' => 'true'
                ]
            ]
        );

        $this->add_control(
            'arrowMiddleOffset',
            [
                'label'     => __( 'Arrows Offset', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '60px',
                'options'   => [
                    '0px'      => __( '0px', 'masterlayer'),
                    '10px'      => __( '10px', 'masterlayer'),
                    '20px'      => __( '20px', 'masterlayer'),
                    '30px'      => __( '30px', 'masterlayer'),
                    '40px'      => __( '40px', 'masterlayer'),
                    '50px'      => __( '50px', 'masterlayer'),
                    '60px'      => __( '60px', 'masterlayer'),
                    '70px'      => __( '70px', 'masterlayer'),
                    '80px'      => __( '80px', 'masterlayer'),
                    '90px'      => __( '90px', 'masterlayer'),
                    '100px'      => __( '100px', 'masterlayer'),

                ],
                'condition' => [
                    'prevNextButtons' => 'true', 'arrowPosition' => 'middle'
                ]
            ]
        );

        $this->add_control(
            'arrowTopOffset',
            [
                'label'     => __( 'Arrows Offset', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '60px',
                'options'   => [
                    '0px'      => __( '0px', 'masterlayer'),
                    '10px'      => __( '10px', 'masterlayer'),
                    '20px'      => __( '20px', 'masterlayer'),
                    '30px'      => __( '30px', 'masterlayer'),
                    '40px'      => __( '40px', 'masterlayer'),
                    '50px'      => __( '50px', 'masterlayer'),
                    '60px'      => __( '60px', 'masterlayer'),
                    '70px'      => __( '70px', 'masterlayer'),
                    '80px'      => __( '80px', 'masterlayer'),
                    '90px'      => __( '90px', 'masterlayer'),
                    '100px'      => __( '100px', 'masterlayer'),

                ],
                'condition' => [
                    'prevNextButtons' => 'true', 'arrowPosition' => 'top'
                ]
            ]
        );

        $this->add_control(
            'pageDots',
            [
                'label'        => __( 'Show Bullets?', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
            ]
        );

        $this->add_responsive_control(
            'dotOffset',
            [
                'label' => __( 'Bullets Offset', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'render_type' => 'template',
                'condition' => [ 'pageDots' => 'true' ],
                'selectors' => [
                    '{{WRAPPER}} .master-carousel-box' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section( 'setting_image_section',
            [
                'label' => __( 'Image', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $this->add_control(
            'image_rounded',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .item-carousel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', 'masterlayer' ),
                'selector' => '{{WRAPPER}} .item-carousel',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .item-carousel',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $cls = 'mlr-' . rand() . ' master-galleries';
        $settings = $this->get_settings_for_display();
        $galleries = $this->get_settings_for_display( 'galleries' );

        // Data config for carousel
        $config['column'] = $settings['column'];
        $config['gap'] = $settings['gap'];
        $config['arrowPosition'] = $settings['arrowPosition'];
        $config['arrowMiddleOffset'] = $settings['arrowMiddleOffset'];
        $config['arrowTopOffset'] = $settings['arrowTopOffset'];
        
        $config['stretch'] = $settings['stretch'];
        $config['autoPlay'] = $settings['autoPlay'] == 'true' ? true : false;
        $config['prevNextButtons'] = $settings['prevNextButtons'] == 'true' ? true : false;
        $config['pageDots'] = $settings['pageDots'] == 'true' ? true : false;
        $config['groupCells'] = false;
        if ( $settings['column'] == 'custom' ) {
            $config['cellAlign'] = 'center';
            $config['wrapAround'] = true;
            $cls .= ' full-screen-true';
        } 

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        ?>

        <div class="master-carousel-box <?php echo esc_attr($cls); ?>" <?php echo $data; ?>>
            <?php
            foreach ( $galleries as $index => $item ) { 
                $image = $cls1 = "";
                
                // Image 
                if ( $item['image']['url'] )
                    $image = sprintf('<div class="thumb"><img src="%1$s" alt="Image" /></div>',
                        esc_url( $item['image']['url'] ) );
            
                // HTML render
                $cls1 = ' item-carousel ';

                ?>
                <div class="master-gallery <?php echo esc_attr($cls1); ?>">
                    <?php echo $image; ?>
                </div>
            <?php } ?>
        </div>

        <?php
    }

    protected function content_template() {}
}

