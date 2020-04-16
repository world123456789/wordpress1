<?php 
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_breadcrumb',
    'label'       => esc_html__( 'Show Breadcrumb', 'seocify' ),
    'section'     => 'blog_banner_section',
    'default'     => false,
    'choices'     => array(
        true  => esc_html__( 'Enable', 'seocify' ),
        false => esc_html__( 'Disable', 'seocify' ),
    ),
);
$fields[]= array(
	'type'        => 'color',
	'settings'    => 'banner_overlay',
	'label'       => __( 'Background Color Control', 'seocify' ),
	'section'     => 'blog_banner_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.inner-banner-area',
            'property'	=> 'background-color',
        ),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_page_banner',
    'label'       => esc_html__( 'Show Page Banner', 'seocify' ),
    'section'     => 'blog_banner_section',
    'default'     => true,
    'choices'     => array(
        true  => esc_html__( 'Enable', 'seocify' ),
        false => esc_html__( 'Disable', 'seocify' ),
    ),
);

$fields[] = array(
    'type'        => 'image',
    'settings'    => 'page_banner_img',
    'label'       => esc_html__( 'Page Banner Image', 'seocify' ),
    'section'     => 'blog_banner_section',
    'default'     => '',
    'required'      => array(
        array(
            'setting'   => 'show_page_banner',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'page_banner_title',
    'label'       => esc_html__( 'Page Banner Title', 'seocify' ),
    'section'     => 'blog_banner_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.inner-banner-content .inner-banner-title',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( '', 'seocify' ),
    'required'      => array(
        array(
            'setting'   => 'show_page_banner',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
);



$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_blog_banner',
    'label'       => esc_html__( 'Show Blog Banner', 'seocify' ),
    'section'     => 'blog_banner_section',
    'default'     => true,
    'choices'     => array(
        true  => esc_html__( 'Enable', 'seocify' ),
        false => esc_html__( 'Disable', 'seocify' ),
    ),
);
$fields[] = array(
        'type'        => 'image',
        'settings'    => 'blog_banner_img',
        'label'       => esc_html__( 'Banner Image', 'seocify' ),
        'section'     => 'blog_banner_section',
        'default'     => '',
        'required'      => array(
            array(
                'setting'   => 'show_blog_banner',
                'operator'  => '==',
                'value'     => 1,
            )
        ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'blog_banner_title',
    'label'       => esc_html__( 'Blog Banner Title', 'seocify' ),
    'section'     => 'blog_banner_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.inner-banner-content .inner-banner-title',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( '', 'seocify' ),
    'required'      => array(
        array(
            'setting'   => 'show_blog_banner',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
);


$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_single_banner',
    'label'       => esc_html__( 'Show Single Banner', 'seocify' ),
    'section'     => 'blog_banner_section',
    'default'     => true,
    'choices'     => array(
        true  => esc_html__( 'Enable', 'seocify' ),
        false => esc_html__( 'Disable', 'seocify' ),
    ),
);
$fields[] = array(
        'type'        => 'image',
        'settings'    => 'single_banner_img',
        'label'       => esc_html__( 'Blog Details Banner Image', 'seocify' ),
        'section'     => 'blog_banner_section',
        'default'     => '',
        'required'      => array(
            array(
                'setting'   => 'show_single_banner',
                'operator'  => '==',
                'value'     => 1,
            )
        ),
);
$fields[]= array( 
    'type'        => 'text',
    'settings'    => 'single_banner_title',
    'label'       => esc_html__( 'Blog Details Banner Title', 'seocify' ),
    'section'     => 'blog_banner_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.inner-banner-content .inner-banner-title',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( '', 'seocify' ),
    'required'      => array(
        array(
            'setting'   => 'show_single_banner',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_shop_banner',
    'label'       => esc_html__( 'Show Shop Banner', 'seocify' ),
    'section'     => 'blog_banner_section',
    'default'     => true,
    'choices'     => array(
        true  => esc_html__( 'Enable', 'seocify' ),
        false => esc_html__( 'Disable', 'seocify' ),
    ),
);
$fields[] = array(
        'type'        => 'image',
        'settings'    => 'shop_banner_img',
        'label'       => esc_html__( 'Shop Banner Image', 'seocify' ),
        'section'     => 'blog_banner_section',
        'default'     => '',
        'required'      => array(
            array(
                'setting'   => 'show_shop_banner',
                'operator'  => '==',
                'value'     => 1,
            )
        ),
);

$fields[]= array( 
    'type'        => 'text',
    'settings'    => 'shop_banner_title',
    'label'       => esc_html__( 'Shop Banner Title', 'seocify' ),
    'section'     => 'blog_banner_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.inner-banner-content .inner-banner-title',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( '', 'seocify' ),
    'required'      => array(
        array(
            'setting'   => 'show_shop_banner',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
);


$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_search_banner',
    'label'       => esc_html__( 'Show Search Banner', 'seocify' ),
    'section'     => 'blog_banner_section',
    'default'     => true,
    'choices'     => array(
        true  => esc_html__( 'Enable', 'seocify' ),
        false => esc_html__( 'Disable', 'seocify' ),
    ),
);
$fields[] = array(
        'type'        => 'image',
        'settings'    => 'search_banner_img',
        'label'       => esc_html__( 'Search Banner Image', 'seocify' ),
        'section'     => 'blog_banner_section',
        'default'     => '',
        'required'      => array(
            array(
                'setting'   => 'show_search_banner',
                'operator'  => '==',
                'value'     => 1,
            )
        ),
);


$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_error_banner',
    'label'       => esc_html__( 'Show Error Banner', 'seocify' ),
    'section'     => 'blog_banner_section',
    'default'     => true,
    'choices'     => array(
        true  => esc_html__( 'Enable', 'seocify' ),
        false => esc_html__( 'Disable', 'seocify' ),
    ),
);

$fields[] = array(
        'type'        => 'image',
        'settings'    => 'error_banner_img',
        'label'       => esc_html__( 'Error Banner Image', 'seocify' ),
        'section'     => 'blog_banner_section',
        'default'     => '',
        'required'      => array(
            array(
                'setting'   => 'show_error_banner',
                'operator'  => '==',
                'value'     => 1,
            )
        ),
);

$fields[]= array( 
    'type'        => 'text',
    'settings'    => 'error_banner_title',
    'label'       => esc_html__( 'Error Banner Title', 'seocify' ),
    'section'     => 'blog_banner_section',
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'  => '.inner-banner-content .inner-banner-title',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( '', 'seocify' ),
    'required'      => array(
        array(
            'setting'   => 'show_error_banner',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
);