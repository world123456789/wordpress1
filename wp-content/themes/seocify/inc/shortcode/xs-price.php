<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class XS_Price_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-price';
    }

    public function get_title() {
        return esc_html__( 'Seocify Price Table', 'seocify' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'seocify-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'pricing_plan',
            [
                'label' => esc_html__('Pricing Plans', 'seocify'),
            ]
        );
        $this->add_control(

            'columns', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Number of columns', 'seocify'),
                'default' => '3',
                'options' => [
                    '2' => esc_html__('2', 'seocify'),
                    '3' => esc_html__('3', 'seocify'),
                    '4' => esc_html__('4', 'seocify'),
                ],
            ]
        );

        $this->add_control(
            'seocify_team_menth_yearly_switch',
            [
                'label' => esc_html__( 'Show monthly/yearly Switch', 'seocify' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'seocify' ),
                'label_off' => esc_html__( 'Hide', 'seocify' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'monthly_pricing_table',
            [
                'label' => esc_html__( 'Monthly Package', 'seocify' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Monthly','seocify'),
                'condition' => [
                    'seocify_team_menth_yearly_switch' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'yearly_pricing_table',
            [
                'label' => esc_html__( 'Yearly Package', 'seocify' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Yearly','seocify'),
                'condition' => [
                    'seocify_team_menth_yearly_switch' => 'yes'
                ],
            ]
        );

        /*Pricing Table Style 1*/
        $this->add_control(
            'monthly_table_name',
            [
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'table_title' => esc_html__('Cloud Hosting','seocify'),
                    ]

                ],
                'fields' => [
                    [
                        'name' => 'xs_featured_table',
                        'type' => Controls_Manager::SWITCHER,
                        'label' => esc_html__('Do you want to feature it?', 'seocify'),
                        'label_block'       => true,
                        'default' => 'label_off',
                        'label_on' => esc_html__( 'Yes', 'seocify' ),
                        'label_off' => esc_html__( 'No', 'seocify' ),
                    ],

                    [
                        'name' => 'table_title',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Table Title', 'seocify'),
                        'default'   =>  esc_html__('Cloud Hosting','seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_image',
                        'type' => Controls_Manager::MEDIA,
                        'label' => esc_html__('Table Image', 'seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_content',
                        'type' => Controls_Manager::TEXTAREA,
                        'label' => esc_html__('Table Content', 'seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'currency_icon',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Currency', 'seocify'),
                        'default'   => '$',
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_price',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Price', 'seocify'),
                        'default'   => esc_html__('29.99', 'seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_duration',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Duration', 'seocify'),
                        'default'   => esc_html__('Month', 'seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'button_text',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Button Text', 'seocify'),
                        'default'   => esc_html__('Buy Now', 'seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name'          => 'button_url',
                        'type'          => Controls_Manager::URL,
                        'label'         => esc_html__('Button URL', 'seocify'),
                        'placeholder'   => esc_url('http://example.com'),
                        'label_block'   => true,
                    ],

                ],
                'title_field' => '{{{ table_title }}}',
            ]
        );

        /*Yearly Package Repeater*/
        $this->add_control(
            'yearly_table_name',
            [
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'table_title' => esc_html__('Cloud Hosting','seocify'),
                    ]

                ],
                'fields' => [
                    [
                        'name' => 'xs_featured_table',
                        'type' => Controls_Manager::SWITCHER,
                        'label' => esc_html__('Do you want to feature it?', 'seocify'),
                        'label_block'       => true,
                        'default' => 'label_off',
                        'label_on' => esc_html__( 'Yes', 'seocify' ),
                        'label_off' => esc_html__( 'No', 'seocify' ),
                    ],

                    [
                        'name' => 'table_top_image',
                        'type' => Controls_Manager::MEDIA,
                        'label' => esc_html__('Table Top Image', 'seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_title',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Table Title', 'seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_content',
                        'type' => Controls_Manager::TEXTAREA,
                        'label' => esc_html__('Table Content', 'seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'currency_icon',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Currency', 'seocify'),
                        'default'   => '$',
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_price',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Price', 'seocify'),
                        'default'   => '29.99',
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_duration',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Duration', 'seocify'),
                        'default'   => esc_html__('Month', 'seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'button_text',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Button Text', 'seocify'),
                        'default'   => 'Buy Now',
                        'label_block' => true,
                    ],

                    [
                        'name'          => 'button_url',
                        'type'          => Controls_Manager::URL,
                        'label'         => esc_html__('Button URL', 'seocify'),
                        'placeholder'   => esc_url('http://example.com'),
                        'label_block'   => true,
                    ],

                ],
                'title_field' => '{{{ table_title }}}',
                'condition' => [
                    'seocify_team_menth_yearly_switch' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' 	=> esc_html__( 'Styles', 'seocify' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'table_title_color',
            [
                'label'		=> esc_html__( 'Table Title Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing .xs-content-title' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tab_price_color',
            [
                'label'		=> esc_html__( 'Price Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-header .price-table' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tab_price_body_color',
            [
                'label'		=> esc_html__( 'Table Body Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing .pricing-body ul li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tab_price_body_bg',
            [
                'label'     => esc_html__( 'Table Body BG', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tab_price_body_border_color',
            [
                'label'     => esc_html__( 'Table Body Border Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_price_btn_color',
            [
                'label'		=> esc_html__( 'Button Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_btn_hover_color',
            [
                'label'		=> esc_html__( 'Button Hover Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'tab_price_btn_bg',
            [
                'label'		=> esc_html__( 'Button BG Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-pricing-group .main-nav-tab.tab-swipe' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .btn-primary' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'tab_btn_hover_bg',
            [
                'label'		=> esc_html__( 'Button Hover BG Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary:hover ' => 'background-color: {{VALUE}} !important;;'
                ],
            ]
        );
        $this->add_control(
            'tab_btn_hover_border_color',
            [
                'label'		=> esc_html__( 'Button Hover Boreder Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary:hover ' => 'border-color: {{VALUE}} !important;;'
                ],
            ]
        );
        $this->add_control(
            'btn_border_color_title',
            [
                'label' => esc_html__( 'Border', 'seocify' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border_color',
                'label' => __( 'Button Border', 'seocify' ),
                'selector' => '{{WRAPPER}} .xs-single-pricing a.btn',
            ]
        );
        $this->add_control(
            'btn_border_color_title_hover',
            [
                'label' => esc_html__( 'Hover Border', 'seocify' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border_color_hover',
                'label' => __( 'Button Hover Border', 'seocify' ),
                'selector' => '{{WRAPPER}} .xs-single-pricing a.btn',
            ]
        );


        $this->end_controls_section();

        /*Featured Table*/

        $this->start_controls_section(
            'section_featured_title_style',
            [
                'label' 	=> esc_html__( 'Featured Table Style', 'seocify' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'featured_bg_color',
                'selector' => '{{WRAPPER}} .xs-single-pricing.active',
            )
        );

        $this->add_control(
            'table_featured_title_color',
            [
                'label'		=> esc_html__( 'Table Title Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .xs-content-title' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tab_featured_price_color',
            [
                'label'		=> esc_html__( 'Price Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .pricing-header .price-table' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tab _featured_price_body_color',
            [
                'label'		=> esc_html__( 'Table Body Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .pricing-body ul li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tab_featured_price_btn_color',
            [
                'label'		=> esc_html__( 'Button Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .btn-primary' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_featured_btn_hover_color',
            [
                'label'		=> esc_html__( 'Button Hover Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .btn-primary:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'tab_featured_price_btn_bg',
            [
                'label'		=> esc_html__( 'Button BG Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .btn-primary' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'tab_featured_btn_hover_bg',
            [
                'label'		=> esc_html__( 'Button Hover BG Color', 'seocify' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .btn-primary:hover ' => 'background-color: {{VALUE}} !important;;'
                ],
            ]
        );

        $this->add_control(
            'btn_border_color_featured_title',
            [
                'label' => esc_html__( 'Border', 'seocify' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border_color_featured',
                'label' => __( 'Button Border', 'seocify' ),
                'selector' => '{{WRAPPER}} .xs-single-pricing.active a.btn',
            ]
        );
        $this->add_control(
            'btn_border_color_hover_featured_title',
            [
                'label' => esc_html__( 'Hover Border', 'seocify' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border_color_hover_featured',
                'label' => __( 'Button Hover Border', 'seocify' ),
                'selector' => '{{WRAPPER}} .xs-single-pricing.active a.btn',
            ]
        );


        $this->end_controls_section();

        /*Pulse Animation*/

        $this->start_controls_section(
            'section_pulse_animation_style',
            [
                'label' 	=> esc_html__( 'Pulse Animation Style', 'seocify' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_pulse_animation',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => esc_html__('Show Pulse Animation', 'seocify'),
                'label_block'       => true,
                'default' => 'label_off',
                'label_on' => esc_html__( 'Yes', 'seocify' ),
                'label_off' => esc_html__( 'No', 'seocify' ),
            ]
        );

        $this->add_control(
            'pulse_anime_width',
            [
                'label' => esc_html__( 'Animation Width', 'seocify' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 165,
                ],
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing .pulse-anim' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'pulse_anime_height',
            [
                'label' => esc_html__( 'Animation height', 'seocify' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 165,
                ],
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing .pulse-anim' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        $monthly = $settings['monthly_pricing_table'];
        $columns = $settings['columns'];
        $yearly = $settings['yearly_pricing_table'];

        $monthly_table = $settings['monthly_table_name'];
        $yearly_table = $settings['yearly_table_name'];
        $show_pulse_animation = $settings['show_pulse_animation'];
        if($columns == '4'){
            $grid = 'grid col-lg-3';
        }elseif($columns == '3'){
            $grid = 'grid col-lg-4';
        }else{
            $grid = 'grid col-lg-6';
        }
        /*General Package Contents*/

        require SEOCIFY_SHORTCODE_DIR_STYLE .'/price-table/style1.php';


    }


    protected function _content_template() { }
}