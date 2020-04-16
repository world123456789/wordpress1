<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
class XS_Work_Process_Widget extends Widget_Base {
    public function get_name() {
        return 'xs-work-process';
    }
    public function get_title() {
        return esc_html__( 'Seocify Work Process', 'seocify' );
    }
    public function get_icon() {
        return 'eicon-work-process';
    }
    public function get_categories() {
        return [ 'seocify-elements' ];
    }
    protected function _register_controls() {
        $this->start_controls_section(
            'work_process',
            [
                'label' => esc_html__('Work Process', 'seocify'),
            ]
        );
        $this->add_control(
            'style',
            [
                'label' => esc_html__('Choose Style', 'seocify'),
                'type' => Custom_Controls_Manager::IMAGECHOOSE,
                'default' => 'style1',
                'options' => [
                    'style1' => [
                        'title' => __( 'Image style 1', 'seocify' ),
                        'imagelarge' => SEOCIFY_IMAGES . '/admin/elementor/work-progress/1.png',
                        'imagesmall' => SEOCIFY_IMAGES . '/admin/elementor/work-progress/1.png',
                        'width' => '33%',
                    ],
                    'style2' => [
                        'title' => __( 'Image style 2', 'seocify' ),
                        'imagelarge' => SEOCIFY_IMAGES . '/admin/elementor/work-progress/2.png',
                        'imagesmall' => SEOCIFY_IMAGES . '/admin/elementor/work-progress/2.png',
                        'width' => '33%',
                    ],
                    'style3' => [
                        'title' => __( 'Image style 3', 'seocify' ),
                        'imagelarge' => SEOCIFY_IMAGES . '/admin/elementor/work-progress/3.png',
                        'imagesmall' => SEOCIFY_IMAGES . '/admin/elementor/work-progress/3.png',
                        'width' => '33%',
                    ],
                    'style4' => [
                        'title' => __( 'Image style 3', 'seocify' ),
                        'imagelarge' => SEOCIFY_IMAGES . '/admin/elementor/work-progress/4.png',
                        'imagesmall' => SEOCIFY_IMAGES . '/admin/elementor/work-progress/4.png',
                        'width' => '33%',
                    ],
                    'style5' => [
                        'title' => __( 'Image style 3', 'seocify' ),
                        'imagelarge' => SEOCIFY_IMAGES . '/admin/elementor/work-progress/5.jpg',
                        'imagesmall' => SEOCIFY_IMAGES . '/admin/elementor/work-progress/5.jpg',
                        'width' => '33%',
                    ],
                ],
            ]
        );
        /*Work Process*/
        $this->add_control(
            'work_process_items',
            [
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'title' => esc_html__('Planning','seocify'),
                    ]
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Title', 'seocify'),
                        'default'   =>  esc_html__('Planning','seocify'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'image',
                        'type' => Controls_Manager::MEDIA,
                        'label' => esc_html__('Image', 'seocify'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'description',
                        'type' => Controls_Manager::TEXTAREA,
                        'label' => esc_html__('Description', 'seocify'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'socify_work_process_yes',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Year', 'seocify'),
                        'label_block' => true,
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_title_style',
            [
                'label'     => esc_html__( 'Title Styles', 'seocify' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-work-process h4' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .xs-workprocess-posts .item > h3' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .workprocess-tab-style-5 h3.title' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Title Hover Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-work-process:hover h4' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .xs-workprocess-posts .item:hover > h3' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .workprocess-tab-style-5 .nav-item:hover > h3' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'seocify'),
                'selector' => '{{WRAPPER}} .single-work-process:hover h4, {{WRAPPER}} .xs-workprocess-posts .item > h3, {{WRAPPER}} .workprocess-tab-style-5 h3.title',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_content_style',
            [
                'label'     => esc_html__( 'Content Style', 'seocify' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style4'
                ]
            ]
        );
        $this->add_control(
            'seocify_workporeess_content_color',
            [
                'label'     => esc_html__( 'Content Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-workprocess-posts .item > p' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'seocify_content_typography',
                'label' => esc_html__('Typography', 'seocify'),
                'selector' => '{{WRAPPER}} .xs-workprocess-posts .item > p',
            ]
        );
        $this->add_control(
            'seocify_workporeess_content_year_color',
            [
                'label'     => esc_html__( 'Year Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-workprocess-slider .item > p' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .xs-workprocess-slider .item > .xs-workprocess-water-mark' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'seocify_year_typography',
                'label' => esc_html__('Year Typography', 'seocify'),
                'selector' => '{{WRAPPER}} .xs-workprocess-slider .item > p',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'seocify_shadow_year_typography',
                'label' => esc_html__('Water Mark Typography', 'seocify'),
                'selector' => '{{WRAPPER}} .xs-workprocess-slider .item > .xs-workprocess-water-mark',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_line_style',
            [
                'label'     => esc_html__( 'Line Style', 'seocify' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style4'
                ]
            ]
        );
        $this->add_control(
            'seocify_workporeess_shadow_text',
            [
                'label'     => esc_html__( 'Shadow Text', 'seocify' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control(
            'seocify_workporeess_line_color',
            [
                'label'     => esc_html__( 'line Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-workprocess-slider .owl-stage-outer:before' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'seocify_workporeess_line_active_color',
            [
                'label'     => esc_html__( 'Active line Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-workprocess-slider .owl-item.active .item.xs-selected:before' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'seocify_workporeess_pointer_color',
            [
                'label'     => esc_html__( 'Pointer Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-workprocess-slider .item > p:before' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'seocify_workporeess_arrows_color',
            [
                'label'     => esc_html__( 'Arrows Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#172182',
                'selectors' => [
                    '{{WRAPPER}} .xs-workprocess-slider .owl-nav button.owl-prev' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xs-workprocess-slider .owl-nav button.owl-next' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xs-workprocess-slider .owl-nav [class*=owl-]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_image_style',
            [
                'label'     => esc_html__( 'Circle Style', 'seocify' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style!' => 'style4'
                ]
            ]
        );
        $this->add_control(
            'circle_bg_color',
            [
                'label'     => esc_html__( 'Circle BG Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-work-process .work-process-icon' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'circle_bg_hover_color',
            [
                'label'     => esc_html__( 'Circle BG Hover Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-work-process:hover .work-process-icon' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'circle_border_color',
            [
                'label'     => esc_html__( 'Circle Border Hover Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-work-process:hover .work-process-icon' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'circle_border_hover_color',
            [
                'label'     => esc_html__( 'Circle Border Hover Color', 'seocify' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-work-process:hover .work-process-icon' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function render( ) {
        $settings = $this->get_settings();
        extract($settings);
        require SEOCIFY_SHORTCODE_DIR_STYLE .'/work-process/'.$style.'.php';
    }
    protected function _content_template() { }
}