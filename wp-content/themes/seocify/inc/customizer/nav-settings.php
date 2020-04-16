<?php
/*
 * Top Header
 *
*/
$fields[] = array(
    'type'        => 'radio-image',
    'settings'    => 'header_style',
    'label'       => esc_html__( 'Header Lauout', 'seocify' ),
    'section'     => 'nav_section',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
        '1'   => SEOCIFY_IMAGES_URI . '/admin/kirki/header/1.png',
        '2'   => SEOCIFY_IMAGES_URI . '/admin/kirki/header/2.png',
        '3'   => SEOCIFY_IMAGES_URI . '/admin/kirki/header/3.png',
        '4'   => SEOCIFY_IMAGES_URI . '/admin/kirki/header/4.png',
    ),
);


$fields[] = array(
    'type'        => 'custom',
    'settings'    => 'top_header_title',
    'label'       => '',
    'section'     => 'nav_section',
    'default'     => '<div class="xs-title-divider">'.esc_html__("Top Header Section","seocify").'</div>',
    'priority'    => 10,
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'is_sticky_header',
    'label'       => esc_html__( 'Make Sticky Header', 'seocify' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'is_transparent_header',
    'label'       => esc_html__( 'Make Transparent Header', 'seocify' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_top_header',
    'label'       => esc_html__( 'Show Top Header', 'seocify' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'top_background_color',
    'label'       => esc_html__( 'Top Background Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.header .xs-top-bar',
            'property'	=> 'background-color',
        ),
    ),
);


$fields[] = array(
    'type'        => 'color',
    'settings'    => 'top_text_color',
    'label'       => esc_html__( 'Top  Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.xs-top-bar-info li p, .xs-top-bar-info li a',
            'property'	=> 'color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'top_link_color',
    'label'       => esc_html__( 'Top Link Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.xs-top-bar .xs-list li a',
            'property'	=> 'color',
        ),
    ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'cta_text',
    'label'       => esc_html__( 'Header CTA Button Text', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'header_style',
            'operator'  => '!=',
            'value'     => 1,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.header-new .btn-danger:not([class*=btn-outline-])',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( 'Free Analysis', 'seocify' ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'cta_url',
    'label'       => esc_html__( 'Header CTA Button URL', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'header_style',
            'operator'  => '!=',
            'value'     => 2,
        )
    ),
    'default'     => '#',
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'call_now_text',
    'label'       => esc_html__( 'Call Now Text', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'header_style',
            'operator'  => '==',
            'value'     => 2,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-logo-wraper .header-info .contact-info',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( 'Call Now', 'seocify' ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'top_header_phn',
    'label'       => esc_html__( 'Top Phone Number', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '!=',
            'value'     => 5,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-top-bar-info li a.top-tel',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( '009-215-5596', 'seocify' ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'top_header_email',
    'label'       => esc_html__( 'Top Email Address', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-top-bar-info li a.top-mail',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( 'info@domain.com', 'seocify' ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_bg_color',
    'label'       => esc_html__( 'Navigation Background Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'is_transparent_header',
            'operator'  => '==',
            'value'     => false,
        ),
    ),
    'output'      => array(
        array(
            'element' 	=> '.header .xs-header.header-main, .xs-header.header-new',
            'property'	=> 'background-color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'sticky_nav_bg_color',
    'label'       => esc_html__( 'Sticky Nav Background Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'is_sticky_header',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
    'output'      => array(
        array(
            'element' 	=> '.header.sticky .xs-header.header-main',
            'property'	=> 'background-color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'sticky_nav_color',
    'label'       => esc_html__( 'Sticky Nav Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'is_sticky_header',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
    'output'      => array(
        array(
            'element' 	=> '.sticky-header.header.sticky .xs-header.header-main .xs-menus .nav-menu > li > a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.sticky-header.header.sticky .xs-header.header-main .xs-menus .nav-menu > li > a::before',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.sticky-header.header.sticky .xs-header.header-main .xs-menus .nav-menu > li > a',
            'property'	=> 'border-color',
        ),
        array(
            'element' 	=> '.sticky-header.header.sticky .xs-header.header-main .xs-menus .nav-menu > li.active > a::before',
            'property'	=> 'box-shadow',
            'value_pattern' => '9px 0px 0px 0px #181818, 18px 0px 0px 0px #181818',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_menu_color',
    'label'       => esc_html__( 'Menu Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-header.header-main .xs-menus .nav-menu li a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.header .xs-header.header-main .xs-menus .nav-menu > li > a::before',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.header .xs-header.header-main .xs-menus .nav-menu > li > a .submenu-indicator-chevron',
            'property'	=> 'border-color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'active_nav_menu_color',
    'label'       => esc_html__( 'Active Menu Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.header-transparent:not(.sticky-header) .xs-header.header-main .xs-menus:not(.xs_nav-portrait) .nav-menu > li.active > a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.header:not(.sticky-header) .xs-header.header-main .xs-menus:not(.xs_nav-portrait) .nav-menu > li.active > a::before',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.header-transparent:not(.sticky-header) .xs-header.header-main .xs-menus:not(.xs_nav-portrait) .nav-menu > li.active > a .submenu-indicator-chevron',
            'property'	=> 'border-color',
        ),
        array(
            'element' 	=> '.header-transparent:not(.sticky-header) .xs-header.header-main .xs-menus:not(.xs_nav-portrait) .nav-menu > li.active > a::before',
            'property'	=> 'box-shadow',
            'value_pattern' => '9px 0px 0px 0px #ffffff, 18px 0px 0px 0px #ffffff',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_menu_hover_color',
    'label'       => esc_html__( 'Menu Hover Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.header .xs-menus .nav-menu > li > a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-menus .nav-menu .xs-icon-menu .single-menu-item a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.header .xs-menus .nav-menu > li > a::before',
            'property'	=> 'border-color',
        ),
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_submenu_color',
    'label'       => esc_html__( 'Sub Menu Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-header.header-main .xs-menus .nav-menu .nav-submenu li a',
            'property'	=> 'color',
        ),
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_submenu_hover_color',
    'label'       => esc_html__( 'Sub Menu Hover Color', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-header.header-main .xs-menus .nav-menu .nav-submenu li a:hover',
            'property'	=> 'color',
        ),
    ),
);
$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Social Control', 'seocify' ),
    'section'     => 'nav_section',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Social Profile', 'seocify' ),
    ),
    'settings'    => 'nav_social_links',
    'default'     => array(
        array(
            'social_icon' => '',
            'social_url'  => '',
        ),
    ),
    'fields' => array(
        'social_icon' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social Icon', 'seocify' ),
            'default'     => '',
        ),
        'social_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social URL', 'seocify' ),
            'default'     => '',
        ),

    )
);
/*
 *
 * Main Nav
 *
 */
$fields[] = array(
    'type'        => 'custom',
    'settings'    => 'nav_header_title',
    'label'       => '',
    'section'     => 'nav_section',
    'default'     => '<div class="xs-title-divider">'.esc_html__("Navigation Section","seocify").'</div>',
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'nav_lang',
    'label'       => esc_html__( 'Show Language Switcher', 'seocify' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'nav_search',
    'label'       => esc_html__( 'Show Search', 'seocify' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'nav_sidebar',
    'label'       => esc_html__( 'Show Sidebar', 'seocify' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);

$fields[]= array(
    'type'        => 'textarea',
    'settings'    => 'nav_sidebar_content',
    'label'       => esc_html__( 'Content', 'seocify' ),
    'section'     => 'nav_section',
    'transport'   => 'postMessage',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-top-bar-info li p',
            'function' => 'html'
        ),
    ),
    'default'     => '',
);

/*
 *
 * Nevigation Sidebar
 *
 *
 */

$fields[] = array(
    'type'        => 'image',
    'settings'    => 'nav_sidebar_logo',
    'label'       => esc_html__( 'Logo', 'seocify' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
);

$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Contact Info', 'seocify' ),
    'section'     => 'nav_section',
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Contact Info', 'seocify' ),
    ),
    'settings'    => 'nav_contact_info',
    'default'     => array(
        array(
            'image' => '',
            'title'  => esc_html__('759 Pinewood Avenue','seocify'),
            'sub_title'  => esc_html__('Marquette, Michigan','seocify'),
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
    'fields' => array(
        'image' => array(
            'type'        => 'image',
            'label'       => esc_html__( 'Image', 'seocify' ),
            'default'     => '',
        ),
        'title' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Title', 'seocify' ),
            'default'     => '',
        ),
        'sub_title' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Sub Title', 'seocify' ),
            'default'     => '',
        ),
    )
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'sidebar_show_subscribe',
    'label'       => esc_html__( 'Show Subscribe Form', 'seocify' ),
    'section'     => 'nav_section',
    'default'     => true,
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'sidebar_subscribe_title',
    'label'       => esc_html__( 'Subscribe Form Title', 'seocify' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        ),
        array(
            'setting'   => 'sidebar_show_subscribe',
            'operator'  => '==',
            'value'     => 1,
        ),

    ),
    'default'     => esc_html__('Get Subscribed!','seocify'),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'sidebar_subscribe_shortcode',
    'label'       => esc_html__( 'Subscribe Form Shortcode', 'seocify' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        ),
        array(
            'setting'   => 'sidebar_show_subscribe',
            'operator'  => '==',
            'value'     => 1,
        ),

    ),
);

$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Social Icon', 'seocify' ),
    'section'     => 'nav_section',
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Social Icon', 'seocify' ),
    ),
    'settings'    => 'sidebar_social_icon',
    'default'     => array(
        array(
            'icon' => 'fa fa-facebook',
            'link'  => '#',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
    'fields' => array(
        'icon' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Icon', 'seocify' ),
            'default'     => '',
        ),
        'link' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Link', 'seocify' ),
            'default'     => '#',
        ),
    )
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'sidebar_btn',
    'label'       => esc_html__( 'Button Label', 'seocify' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        )
    ),

    'default'     => esc_html__( 'Purchase Now', 'seocify' ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'sidebar_btn_link',
    'label'       => esc_html__( 'Button Link', 'seocify' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        )
    ),

    'default'     => '#',
);
