<?php



namespace Elementor;



if ( ! defined( 'ABSPATH' ) ) exit;



class Xs_Image_Box_Widget extends Widget_Base {



    public function get_name() {

        return 'xs-image-box';

    }



    public function get_title() {

        return esc_html__( 'Seocify Image Box', 'seocify' );

    }



    public function get_icon() {

        return 'eicon-insert-image';

    }



    public function get_categories() {

        return [ 'seocify-elements' ];

    }



    protected function _register_controls() {

        $this->start_controls_section(

            'section_tab',

            [

                'label' =>esc_html__('Seocify Image Box', 'seocify'),

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

                        'title' => __( 'image style 1', 'seocify' ),

                        'imagelarge' => SEOCIFY_IMAGES . '/imagechoose/image-box/1.png',

                        'imagesmall' => SEOCIFY_IMAGES . '/imagechoose/image-box/1.png',

                        'width' => '50%',

                    ],

                    'style2' => [

                        'title' => __( 'image style 2', 'seocify' ),

                        'imagelarge' => SEOCIFY_IMAGES . '/imagechoose/image-box/2.png',

                        'imagesmall' => SEOCIFY_IMAGES . '/imagechoose/image-box/2.png',

                        'width' => '50%',

                    ],
                    'style3' => [

                        'title' => __( 'image style 3', 'seocify' ),

                        'imagelarge' => SEOCIFY_IMAGES . '/imagechoose/image-box/4.jpg',

                        'imagesmall' => SEOCIFY_IMAGES . '/imagechoose/image-box/4.jpg',

                        'width' => '50%',

                    ],


                ],

            ]

        );

        $this->add_control(

            'image',

            [

                'label' =>esc_html__( 'Image', 'seocify' ),

                'type' => Controls_Manager::MEDIA,

                'default' => [

                    'url' => Utils::get_placeholder_image_src(),

                ],

            ]

        );




        $this->add_group_control(

            Group_Control_Image_Size::get_type(),

            [

                'name' => 'image',

                'label' =>esc_html__( 'Image Size', 'seocify' ),

                'default' => 'full',

            ]

        );



        $this->add_control(

            'image_background',

            [

                'label' =>esc_html__( 'Background Image', 'seocify' ),

                'type' => Controls_Manager::MEDIA,

                'default' => [

                    'url' => Utils::get_placeholder_image_src(),

                ],
                'condition' => [
                    'style' => 'style3',
                ]

            ]

        );


        $this->add_control(

            'title',

            [

                'label' =>esc_html__( 'Title', 'seocify' ),

                'type' => Controls_Manager::TEXT,

                'label_block' => true,

                'placeholder' =>esc_html__( '99.9% Uptime Guarantee', 'seocify' ),

                'default' =>esc_html__( 'Add Title', 'seocify' ),

            ]

        );



        $this->add_control(

            'sub_title',

            [

                'label' =>esc_html__( 'Sub Title', 'seocify' ),

                'type' => Controls_Manager::TEXTAREA,

                'label_block' => true,

                'default' => esc_html__( 'Share processes and data secure lona need to know basis', 'seocify' ),



            ]

        );



        $this->add_control(

            'seocify_image_box_show_footer_icon',

            [

                'label' => esc_html__( 'Show Footer Icon', 'seocify' ),

                'type' => Controls_Manager::SWITCHER,

                'label_on' => esc_html__( 'Show', 'seocify' ),

                'label_off' => esc_html__( 'Hide', 'seocify' ),

                'return_value' => 'yes',

                'default' => '',

            ]

        );



        $this->add_control(

            'seocify_image_box_footer_icon',

            [

                'label' => esc_html__( 'Footer Icons', 'seocify' ),

                'type' => Controls_Manager::ICON,

                'default' => 'icon icon-plus-circle',

                'condition' => [

                    'seocify_image_box_show_footer_icon' => 'yes'

                ]

            ]

        );



        $this->add_control(

            'website_link',

            [

                'label' => esc_html__( 'Link', 'seocify' ),

                'type' =>  Controls_Manager::URL,

                'placeholder' => esc_html__( 'https://your-link.com', 'seocify' ),

                'show_external' => true,

                'default' => [

                    'url' => '',

                    'is_external' => true,

                    'nofollow' => true,

                ],



                'condition' => [

                    'seocify_image_box_show_footer_icon' => 'yes'

                ]

            ]

        );







        $this->add_responsive_control(

            'box_align', [
                'label'			 =>esc_html__( 'Alignment', 'seocify' ),
                'type'			 => Controls_Manager::CHOOSE,
                'options'		 => [
                    'left'		 => [
                        'title'	 =>esc_html__( 'Left', 'seocify' ),
                        'icon'	 => 'fa fa-align-left',
                    ],
                    'center'	 => [
                        'title'	 =>esc_html__( 'Center', 'seocify' ),
                        'icon'	 => 'fa fa-align-center',
                    ],
                    'right'		 => [
                        'title'	 =>esc_html__( 'Right', 'seocify' ),
                        'icon'	 => 'fa fa-align-right',
                    ],
                    'justify'	 => [
                        'title'	 =>esc_html__( 'Justified', 'seocify' ),
                        'icon'	 => 'fa fa-align-justify',
                    ],

                ],

                'default'		 => 'center',

                'selectors' => [

                    '{{WRAPPER}} .why-choose-us-block' => 'text-align: {{VALUE}};'

                ],

            ]

        );

        $this->end_controls_section();



        /**

         *

         *Container Style

         *

         */

         $this->start_controls_section(

			'content_style_tab',

			[

				'label' => __( 'Content', 'seocify' ),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);



		$this->add_responsive_control(

			'choose_us_block_spacing',

			[

				'label' => __( 'Padding', 'seocify' ),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', '%', 'em' ],

				'devices' => [ 'desktop', 'tablet', 'mobile' ],

				'desktop_default' => [

					'size' => 60,

					'unit' => 'px',

				],

				'tablet_default' => [

					'size' => 30,

					'unit' => 'px',

				],

				'mobile_default' => [

					'size' => 10,

					'unit' => 'px',

				],

				'selectors' => [

					'{{WRAPPER}} .why-choose-us-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);



		$this->end_controls_section();





        /**

         *

         *Title Style

         *

         */



        $this->start_controls_section(

            'section_title_tab',

            [

                'label' =>esc_html__( 'Title', 'seocify' ),

                'tab' => Controls_Manager::TAB_STYLE,

            ]

        );





        $this->start_controls_tabs('secify_title_style_tabs' );



        $this->start_controls_tab(

            'secify_title_style_normal_tab',

            [

                'label' => esc_html__( 'Normal', 'seocify' ),

            ]

        );

         $this->add_control(

            'title_color',

            [

                'label' =>esc_html__( 'Color', 'seocify' ),

                'type' => Controls_Manager::COLOR,

                'default' => '',

                'selectors' => [

                    '{{WRAPPER}} .why-choose-us-block h4.xs-content-title' => 'color: {{VALUE}};',

                ],

            ]

        );

        $this->end_controls_tab();



        $this->start_controls_tab(

            'seocify_style_title_hover_tab',

            [

                'label' => esc_html__( 'Hover', 'seocify' ),

            ]

        );



        $this->add_control(

			'title_hover_text__color',

			[

				'label' =>esc_html__( 'Box Shadow Color', 'seocify' ),

				'type' => Controls_Manager::COLOR,

				'selectors' => [

					'{{WRAPPER}} .why-choose-us-block:hover h4.xs-content-title' => 'color: {{VALUE}}',

				],

			]

		);







		$this->add_group_control(

            Group_Control_Text_Shadow::get_type(),

            [

                'name' => 'title_shadow',

                'selector' => '{{WRAPPER}} .why-choose-us-block:hover h4.xs-content-title',

            ]

        );



        $this->end_controls_tab();



        $this->end_controls_tabs();



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'title_typography',

                'label' => esc_html__( 'Typography', 'seocify' ),

                'selector' => '{{WRAPPER}} .why-choose-us-block .xs-content-title, h4',

            ]

        );



        $this->end_controls_section();





        /**

         *

         *Sub Title Style

         *

         */



        $this->start_controls_section(

            'section_sub_title_tab',

            [

                'label' => esc_html__( 'Sub Title', 'seocify' ),

                'tab' => Controls_Manager::TAB_STYLE,

            ]

        );



        $this->add_control(

            'sub_title_color',

            [

                'label' => esc_html__( 'Color', 'seocify' ),

                'type' => Controls_Manager::COLOR,

                'default' => '',

                'selectors' => [

                    '{{WRAPPER}} .why-choose-us-block p ' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'sub_title_typography',

                'label' => esc_html__( 'Typography', 'seocify' ),

                'selector' => '{{WRAPPER}} .why-choose-us-block p',

            ]

        );



        $this->end_controls_section();



        /**

         *

         *Image Style

         *

         */



        $this->start_controls_section(

            'section_image_tab',

            [

                'label' => esc_html__( 'Image', 'seocify' ),

                'tab' => Controls_Manager::TAB_STYLE,

            ]

        );



        $this->add_control(

            'image_margin_bottom',

            [

                'label' => esc_html__( 'Margin Bottom', 'seocify' ),

                'type' => Controls_Manager::SLIDER,

                'default' => [

                    'size' => '',

                ],



                'size_units' => [ 'px'],

                'selectors' => [

                    '{{WRAPPER}} .why-choose-us-block .choose-us-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',

                ],

            ]

        );



        $this->end_controls_section();



        //  Icon style



        $this->start_controls_section(

            'section_icon_style',

            [

                'label' => esc_html__( 'Icon', 'seocify' ),

                'tab' => Controls_Manager::TAB_STYLE,

                'condition' => [

                    'seocify_image_box_show_footer_icon' => 'yes'

                ]

            ]

        );



        $this->start_controls_tabs('secify_icon_style_tabs' );



        $this->start_controls_tab(

            'secify_icon_style_normal_tab',

            [

                'label' => esc_html__( 'Normal', 'seocify' ),

            ]

        );

        $this->add_control(

            'seocify_icon_color',

            [

                'label' => esc_html__( 'Color', 'seocify' ),

                'type' => Controls_Manager::COLOR,

                'default' => '',

                'selectors' => [

                    '{{WRAPPER}} .btn.btn-imagebox-footer ' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'seocify_iocn_typography',

                'label' => esc_html__( 'Typography', 'seocify' ),

                'selector' => '{{WRAPPER}} .btn.btn-imagebox-footer',

            ]

        );

        $this->end_controls_tab();



        $this->start_controls_tab(

            'seocify_style_hover_tab',

            [

                'label' => esc_html__( 'Hover', 'seocify' ),

            ]

        );



        $this->add_control(

            'seocify_icon_color_hover',

            [

                'label' => esc_html__( 'Color', 'seocify' ),

                'type' => Controls_Manager::COLOR,

                'default' => '',

                'selectors' => [

                    '{{WRAPPER}} .btn.btn-imagebox-footer:hover ' => 'color: {{VALUE}};',

                    '{{WRAPPER}} .why-choose-us-block:hover .btn.btn-imagebox-footer ' => 'color: {{VALUE}};',

                    '{{WRAPPER}} .service-info-block:hover .btn.btn-imagebox-footer ' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->end_controls_tab();



        $this->end_controls_tabs();



        $this->end_controls_section();



        $this->start_controls_section(

            'section_bg_tab',

            [

                'label' => esc_html__( 'Background', 'seocify' ),

                'tab' => Controls_Manager::TAB_STYLE,

                'condition' => [

                    'style' => 'style2'

                ]

            ]

        );



        $this->add_group_control(

            Group_Control_Background::get_type(),

            [

                'name' => 'background',

                'label' => __( 'Background', 'seocify' ),

                'types' => [ 'gradient' ],

                'selector' => '{{WRAPPER}} .service-info-block',

            ]

        );



        $this->add_control(

            'btn_box_shadow_dimensions',

            [

                'label' => _x( 'Dimensions', 'Border Control', 'seocify' ),

                'type' => Controls_Manager::DIMENSIONS,

                'selectors' => [

                    '{{WRAPPER}} .service-info-block' => 'box-shadow: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} var(--box-shadow-color);',

                ],

            ]

        );

        $this->add_control(

            'btn_box_shadow_color',

            [

                'label' =>esc_html__( 'Box Shadow Color', 'seocify' ),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .service-info-block' => '--box-shadow-color: {{VALUE}};',

                ],

            ]

        );





        $this->end_controls_section();

    }



    protected function render( ) {



        $settings = $this->get_settings();

        $title = $settings['title'];

        $sub_title = $settings['sub_title'];

        $style = $settings['style'];

        $icon = $settings['seocify_image_box_footer_icon'];



        if ( ! empty( $settings['website_link']['url'] ) ) {

            $this->add_render_attribute( 'button', 'href', $settings['website_link']['url'] );



            if ( $settings['website_link']['is_external'] ) {

                $this->add_render_attribute( 'button', 'target', '_blank' );

            }



            if ( $settings['website_link']['nofollow'] ) {

                $this->add_render_attribute( 'button', 'rel', 'nofollow' );

            }

        }



        $this->add_render_attribute( 'button', 'class', 'btn btn-imagebox-footer' );



        if($style == 'style1') :

            ?>

            <div class="why-choose-us-block wow fadeInUp">

                <div class="choose-us-img">

                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>

                </div>

                <h4 class="xs-content-title"><?php echo esc_html( $title ); ?></h4>

                <p><?php echo esc_html( $sub_title ); ?></p>



                <?php if($settings['seocify_image_box_show_footer_icon'] == 'yes') : ?>



                    <div class="seocify-image-box-footer">

                        <a <?php echo seocify_return($this->get_render_attribute_string( 'button' )); ?>>

                            <?php if($icon != '') : ?>

                                <i class="<?php echo esc_attr($icon); ?>"></i>

                            <?php endif; ?>

                        </a>

                    </div>



                <?php endif; ?>

            </div>

        <?php
        elseif($style =='style3') : ?>
        <div class="why-choose-us-block style-3 wow fadeInUp">

<div class="choose-us-img">

    <div class="xs_forground_image">
        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
    </div>
    <div class="xs_background_image">
        <img src="<?php echo esc_url($settings['image_background']['url']) ?>" alt="background">
    </div>

</div>

<h4 class="xs-content-title"><?php echo esc_html( $title ); ?></h4>

<p><?php echo esc_html( $sub_title ); ?></p>



<?php if($settings['seocify_image_box_show_footer_icon'] == 'yes') : ?>



    <div class="seocify-image-box-footer">

        <a <?php echo seocify_return($this->get_render_attribute_string( 'button' )); ?>>

            <?php if($icon != '') : ?>

                <i class="<?php echo esc_attr($icon); ?>"></i>

            <?php endif; ?>

        </a>

    </div>



<?php endif; ?>

</div>
        <?php
        else:

            ?>

            <div class="service-info-block <?php echo esc_attr($settings['box_align'] != '' ? 'text-'.$settings['box_align'] : 'text-center'); ?>">

                <div class="info-block-header">

                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>

                </div>

                <h3 class="service-info-title"><?php echo esc_html( $title ); ?></h3>

                <p> <?php echo esc_html( $sub_title ); ?></p>



                <?php if($settings['seocify_image_box_show_footer_icon'] == 'yes') : ?>



                    <div class="seocify-image-box-footer">

                        <a <?php echo seocify_return($this->get_render_attribute_string( 'button' )); ?>>

                            <?php if($icon != '') : ?>

                                <i class="<?php echo esc_attr($icon); ?>"></i>

                            <?php endif; ?>

                        </a>

                    </div>



                <?php endif; ?>

            </div>

        <?php

        endif;

    }

    protected function _content_template() { }

}