<?php

$fields[] = array(
    'type'        => 'image',
    'settings'    => 'footer_bg_image',
    'label'       => esc_html__( 'Background Image', 'seocify' ),
    'section'     => 'footer_section',
    'output'      => array(
        array(
            'element' 	=> '.xs-footer-section',
            'property'	=> 'background-image',
        ),
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_bg_color',
    'label'       => esc_html__( 'Background Color', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-footer-section',
            'property'	=> 'background-color',
        ),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_footer_top',
    'label'       => esc_html__( 'Show Footer top area', 'seocify' ),
    'section'     => 'footer_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);

$fields[] = array(
    'type'        => 'image',
    'settings'    => 'footer_logo',
    'label'       => esc_html__( 'Footer Logo', 'seocify' ),
    'section'     => 'footer_section',
    'required'      => array(
        array(
            'setting'   => 'show_footer_top',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
);
$fields[] = array(
    'type'        => 'image',
    'settings'    => 'footer_map_pin_img',
    'label'       => esc_html__( 'Address Map Pin Image', 'seocify' ),
    'section'     => 'footer_section',
    'required'      => array(
        array(
            'setting'   => 'show_footer_top',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'footer_address',
    'label'       => esc_html__( 'Address text', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.footer-top-area .address-info-list li .addr a',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( '1010 Grand Avenue <br> New York, USA', 'seocify' ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'footer_map_url',
    'label'       => esc_html__( 'Google Map URL', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'postMessage',
    'default'     => esc_url( 'https://www.google.com/maps/place/1010+Grand+St,+Brooklyn,+NY+11211,+USA/@40.7133521,-73.9370686,17z/data=!3m1!4b1!4m5!3m4!1s0x89c25954b2d0b20d:0xb03e8d55cdb687bc!8m2!3d40.7133521!4d-73.9348799' ),
);
$fields[] = array(
    'type'        => 'image',
    'settings'    => 'footer_contact_img',
    'label'       => esc_html__( 'Contact Image', 'seocify' ),
    'section'     => 'footer_section',
    'required'      => array(
        array(
            'setting'   => 'show_footer_top',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
);
$fields[]= array(
    'type'        => 'textarea',
    'settings'    => 'footer_address',
    'label'       => esc_html__( 'Address text', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.footer-top-area .address-info-list li .addr a',
            'function' => 'html'
        ),
    ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'footer_phn',
    'label'       => esc_html__( 'Phone', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.footer-top-area .address-info-list li a.phn',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( '009-215-5596', 'seocify' ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'footer_email',
    'label'       => esc_html__( 'Email', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.footer-top-area .address-info-list li a.email',
            'function' => 'html'
        ),
    ),
    'default'     => sanitize_email( 'info@example.com' ),
);




$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_footer_widget',
    'label'       => esc_html__( 'Show Footer widget area', 'seocify' ),
    'section'     => 'footer_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_layout',
    'label'       => esc_html__( 'Footer Widget Per Row', 'seocify' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '12' => esc_attr__( '1', 'seocify' ),
        '6' => esc_attr__( '2', 'seocify' ),
        '4' => esc_attr__( '3', 'seocify' ),
        '3' => esc_attr__( '4', 'seocify' ),
    ),
);


$fields[] = array(
    'type'        => 'color',
    'settings'    => 'widget_title_color',
    'label'       => esc_html__( 'Widget Title Color', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.footer-widget .xs-content-title',
            'property'	=> 'color',
        ),
    ),
); 

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_text_color',
    'label'       => esc_html__( 'Footer text color', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> 'footer.xs-footer-section.footer-group p',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.footer-widget ul li a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.footer-widget ul li p',
            'property'	=> 'color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_link_color',
    'label'       => esc_html__( 'Footer link color', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> 'footer.xs-footer-section.footer-group a',
            'property'	=> 'color',
        )
    ),
);

/*
 *
 * Partners Area
 *
 */
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_partner_area',
    'label'       => esc_html__( 'Show Partners Area', 'seocify' ),
    'section'     => 'footer_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'partner_prefix',
    'label'       => esc_html__( 'Logo Prefix Text', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.partner-area .xs-lsit li.title',
            'function' => 'html'
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'show_partner_area',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
    'default'     => esc_html__( 'PARTNERSHIP:', 'seocify' ),
);
$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Partners Logo', 'seocify' ),
    'section'     => 'footer_section',
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Logo', 'seocify' ),
    ),
    'settings'    => 'partner_logo',
    'default'     => array(
        array(
            'image' => '',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'show_partner_area',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
    'fields' => array(
        'image' => array(
            'type'        => 'image',
            'label'       => esc_html__( 'Logo', 'seocify' ),
            'default'     => '',
        )
    )
);

$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Card Logo', 'seocify' ),
    'section'     => 'footer_section',
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Logo', 'seocify' ),
    ),
    'settings'    => 'payment_logo',
    'default'     => array(
        array(
            'image' => '',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'show_partner_area',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
    'fields' => array(
        'image' => array(
            'type'        => 'image',
            'label'       => esc_html__( 'Logo', 'seocify' ),
            'default'     => '',
        )
    )
);

$fields[]= array(
    'type'        => 'textarea',
    'settings'    => 'copyright_text',
    'label'       => esc_html__( 'Copyright text', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.copyright .copyright-text p',
            'function' => 'html'
        ), 
    ),
    'default'     => esc_html__( 'Copyrights By Xpeedstudio - 2018', 'seocify' ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_bg_color',
    'label'       => esc_html__( 'Background color', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.copyright',
            'property'	=> 'background-color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_text_color',
    'label'       => esc_html__( 'Text color', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.copyright .copyright-text p',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.copyright .copyright-text',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-social-list li.xs-text-content ',
            'property'	=> 'color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_link_color',
    'label'       => esc_html__( 'Link color', 'seocify' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.copyright .copyright-text p a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.copyright .copyright-text p a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.copyright .copyright-text p a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-social-list li a',
            'property'	=> 'color',
        ),
    ),
);


$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Social Control', 'seocify' ),
    'section'     => 'footer_section',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_html__('Social Profile', 'seocify' ),
    ),
    'settings'    => 'footer_social_links',
    'default'     => array(
        array(
            'social_icon' => '',
            'social_url'  => '',
        ),
    ),
    'fields' => array(
        'social_icon' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Social Icon', 'seocify' ),
            'default'     => '',
        ),
        'social_url' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Social URL', 'seocify' ),
            'default'     => '',
        ),

    )
);