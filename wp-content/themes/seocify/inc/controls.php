<?php

namespace Elementor;

class parallax_hook
{
    public function init()
    {
        add_action('elementor/element/section/section_layout/after_section_end', array( $this, 'after_section_end' ), 10, 2);
        add_action('elementor/frontend/section/after_render', array($this, 'after_section_render2'), 10, 2);
    }


    public function after_section_end($control, $args)
    {
        $control->start_controls_section(
            'ekit_section_parallax',
            array(
                'label' => esc_html__('Parallax Effects', 'seocify'),
                'tab' => Controls_Manager::TAB_LAYOUT,
            )
        );

        $control->add_control(
            'ekit_section_parallax_multi',
            array(
                'label' => esc_html__('Multi Item Parallax', 'seocify'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'seocify'),
                'label_off' => __('Hide', 'seocify'),
            )
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'parallax_style',  [
            'label' => __('Effect Type', 'seocify'),
            'type' => Controls_Manager::SELECT,
            'default' => 'animation',
            'options' => [
                'animation' => __('Css Animation', 'seocify'),
                'mousemove' => __('Mouse Move', 'seocify'),
                'onscroll' => __('On Scroll', 'seocify'),
                'tilt' => __('Parallax Tilt', 'seocify'),
            ],
        ]
        );
        $repeater->add_control(
            'item_source',
            [
                'label' => __( 'Item source', 'seocify' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'toggle' => false,
                'default' => 'image',
                'options' => [
                    'image' => [
                        'title' => 'Image',
                        'icon' => 'eicon-image',
                    ],
                    'shape' => [
                        'title' => 'Shape',
                        'icon' => 'eicon-divider-shape',
                    ],
                ],
                'classes' => 'elementor-control-start-end',
                'render_type' => 'ui',

            ]
        );
        $repeater->add_control(
            'image',[
                'label' => __('Choose Image', 'seocify'),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'item_source' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'shape',  [
                'label' => __('Choose Shape', 'seocify'),
                'type' => Controls_Manager::SELECT,
                'default' => 'angle',
                'options' => [
                    'angle' => __('Shape 1', 'seocify'),
                    'double_stroke' => __('Shape 2', 'seocify'),
                    'fat_stroke' => __('Shape 3', 'seocify'),
                    'fill_circle' => __('Shape 4', 'seocify'),
                    'round_triangle' => __('Shape 5', 'seocify'),
                    'single_stroke' => __('Shape 6', 'seocify'),
                    'stroke_circle' => __('Shape 7', 'seocify'),
                    'triangle' => __('Shape 8', 'seocify'),
                    'zigzag' => __('Shape 9', 'seocify'),
                    'zigzag_2' => __('Shape 10', 'seocify'),
                    'shape_1' => __('Shape 11', 'seocify'),
                    'shape_2' => __('Shape 12', 'seocify'),
                    'shape_3' => __('Shape 13', 'seocify'),
                    'shape_4' => __('Shape 14', 'seocify'),
                ],
                'condition' => [
                    'item_source' => 'shape',
                ]
            ]
        );

        $repeater->add_control(
             'shape_color',
            [
                'label' => __( 'Color', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'item_source' => 'shape',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-parallax-graphic" => 'fill: {{VALUE}}; stroke: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'width_type',
            [
                'label' => __( 'Width', 'seocify' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'Auto', 'seocify' ),
                    'custom' => __( 'Custom', 'seocify' ),
                ],

            ]
        );

        $repeater->add_responsive_control(
            'custom_width',
            [
                'label' => __( 'Custom Width', 'seocify' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'width_type' => 'custom',
                ],
                'device_args' => [
                    Controls_Stack::RESPONSIVE_TABLET => [
                        'condition' => [
                            'ekit_prlx_width_tablet' => [ 'custom' ],
                        ],
                    ],
                    Controls_Stack::RESPONSIVE_MOBILE => [
                        'condition' => [
                            'ekit_prlx_width_mobile' => [ 'custom' ],
                        ],
                    ],
                ],
                'size_units' => [ 'px', '%', 'vw' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-parallax-graphic' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'source_rotate', [
                'label' => __('Rotate', 'seocify'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-parallax-graphic" => 'transform: rotate({{SIZE}}{{UNIT}})',
                ],

            ]
        );

        $repeater->add_responsive_control(
            'pos_x', [
                'label' => __('Position X (%)', 'seocify'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 10,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}.ekit-section-parallax-layer" => 'left: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $repeater->add_responsive_control(
            'pos_y',[
                'label' => __('Position Y (%)', 'seocify'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 10,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}.ekit-section-parallax-layer" => 'top: {{SIZE}}{{UNIT}}',

                ],

            ]
        );
        $repeater->add_responsive_control(
            'animation',
            [
                'label' => __( 'Animation', 'seocify' ),
                'type' => Controls_Manager::SELECT2,
                'frontend_available' => true,
                'default' => 'ekit-fade',
                'options' => [
                    'ekit-fade'=> 'Fade',
                    'ekit-rotate'=> 'Rotate',
                    'ekit-bounce'=> 'Bounce',
                    'ekit-zoom'=> 'Zoom',
                    'ekit-rotate-box'=> 'RotateBox',
                    'ekit-left-right'=> 'Left Right',
                    'bounce'=> 'Bounce 2',
                    'flash'=> 'Flash',
                    'pulse'=> 'Pulse',
                    'shake'=> 'Shake',
                    'headShake'=> 'HeadShake',
                    'swing'=> 'Swing',
                    'tada'=> 'Tada',
                    'wobble'=> 'Wobble',
                    'jello'=> 'Jello',
                ],
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => '-webkit-animation-name:{{UNIT}}',
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-name:{{UNIT}}',
                ],
            ]
        );
        $repeater->add_control(
            'item_opacity',
            [
                'label' => __( 'Opacity', 'seocify' ),
                'description' => esc_html__( 'Opacity will be (0-1), default value 1', 'seocify' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',
                'min' => 0,
                'step' => 1,
                'render_type' => 'none',
                'frontend_available' => true,
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'opacity:{{UNIT}}'
                ],
            ]
        );

        $repeater->add_control(
            'animation_speed',
            [
                'label' => __( 'Animation speed', 'seocify' ) . ' (s)',
                'type' => Controls_Manager::NUMBER,
                'default' => '5',
                'min' => 1,
                'step' => 100,
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => '-webkit-animation-duration:{{UNIT}}s',
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-duration:{{UNIT}}s'
                ],
            ]
        );
        $repeater->add_control(
            'animation_iteration_count',
            [
                'label' => __( 'Animation Iteration Count', 'seocify' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'unset',
                'options' => [
                    'infinite' => __( 'Infinite', 'seocify' ),
                    'unset' => __( 'Unset', 'seocify' ),
                ],
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-iteration-count:{{UNIT}}'
                ],
            ]
        );
        $repeater->add_control(
            'animation_direction',
            [
                'label' => __( 'Animation Direction', 'seocify' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => __( 'Normal', 'seocify' ),
                    'reverse' => __( 'Reverse', 'seocify' ),
                    'alternate' => __( 'Alternate', 'seocify' ),
                ],
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-direction:{{UNIT}}'
                ],
            ]
        );

        $repeater->add_control(
            'parallax_speed', [
                'label' => __('Speed', 'seocify'),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('100', 'seocify'),
                'condition' => [
                    'parallax_style' => 'mousemove',
                ]
            ]
        );

        $repeater->add_control(
            'parallax_transform', [
                'label' => esc_html__( 'Parallax style', 'seocify' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'translateY',
                'options' => [
                    'translateX' => esc_html__( 'X axis', 'seocify' ),
                    'translateY' => esc_html__( 'Y axis', 'seocify' ),
                    'rotate' => esc_html__( 'rotate', 'seocify' ),
                    'rotateX' => esc_html__( 'rotateX', 'seocify' ),
                    'rotateY' => esc_html__( 'rotateY', 'seocify' ),
                    'scale' => esc_html__( 'scale', 'seocify' ),
                    'scaleX' => esc_html__( 'scaleX', 'seocify' ),
                    'scaleY' => esc_html__( 'scaleY', 'seocify' ),
                ],
                'condition' => [
                    'parallax_style' => 'onscroll'
                ],
            ]
        );
        $repeater->add_control(
            'parallax_transform_value', [
                'label' => esc_html__( 'Parallax Transition ', 'seocify' ),
                'description' => esc_html__( 'X, Y and Z Axis will be pixels, Rotate will be degrees (0-180), scale will be ratio', 'seocify' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '250',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'smoothness', [
                'label' => esc_html__( 'Smoothness', 'seocify' ),
                'description' => esc_html__( 'factor that slowdown the animation, the more the smoothier (default: 700)', 'seocify' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '700',
                'min' => 0,
                'max' => 1000,
                'step' => 100,
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'offsettop',[
                'label' => esc_html__( 'Offset Top', 'seocify' ),
                'description' => esc_html__( 'default: 0; when the element is visible', 'seocify' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'offsetbottom', [
                'label' => esc_html__( 'Offset Bottom', 'seocify' ),
                'description' => esc_html__( 'default: 0; when the element is visible', 'seocify' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'maxtilt',[
                'label' => esc_html__( 'MaxTilt', 'seocify' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '20',
                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'scale',[
                'label' => esc_html__( 'Image Scale', 'seocify' ),
                'description' => esc_html__( '2 = 200%, 1.5 = 150%, etc.. Default 1', 'seocify' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',
                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'disableaxis', [
                'label' => esc_html__( 'Disable Axis', 'seocify' ),
                'description' => esc_html__( 'What axis should be disabled. Can be X or Y.', 'seocify' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'None', 'seocify' ),
                    'x' => esc_html__( 'X axis', 'seocify' ),
                    'y' => esc_html__( 'Y axis', 'seocify' ),
                ],

                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'zindex',   [
                'label' => __('Z-index', 'seocify'),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('2', 'seocify'),
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'z-index: {{UNIT}}',
                ],
            ]
        );
        $control->add_control(
            'ekit_section_parallax_multi_items',
            [
                'label' => __( 'Parallax', 'seocify' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ parallax_style }}}',
                'condition' => [
                    'ekit_section_parallax_multi' => 'yes'
                ],

            ]
        );

        $control->end_controls_section();
    }

    public function after_section_render2(Element_Base $element)
    {
        $data     = $element->get_data();
        $settings = $data['settings'];

        if  (
            (isset($settings['ekit_section_parallax_multi']) && $settings['ekit_section_parallax_multi'] == 'yes') || 
            (isset($settings['ekit_section_parallax_bg']) && $settings['ekit_section_parallax_bg'] == 'yes')
            ){
            echo "
            <script>
                window.elementskit_section_parallax_data.section".$data['id']." = JSON.parse('".json_encode($settings)."');
            </script>
            ";
        }
    }

}

$x = new parallax_hook;
$x->init();