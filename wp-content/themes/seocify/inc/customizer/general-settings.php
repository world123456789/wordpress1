<?php
$fields[] = array(
	'type'        => 'image',
	'settings'    => 'site_logo',
	'label'       => esc_html__( 'Logo', 'seocify' ),
	'section'     => 'general_section',
);

$fields[] = array(
	'type'        => 'image',
	'settings'    => 'sticky_logo',
	'label'       => esc_html__( 'Sticky Nav Logo', 'seocify' ),
	'section'     => 'general_section',
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'primary_color',
    'label'       => esc_html__( 'Primary Color', 'seocify' ),
    'section'     => 'general_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '#preloader',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.footer-widget .contact-form .submit-btn',
            'property'	=> 'border-color',
        ),
        array(
            'element' 	=> '.pagination li a:hover, .pagination li.active a',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.widget .tagcloud a:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.widget .tagcloud a:hover',
            'property'	=> 'border-color',
        ),
        array(
            'element' 	=> 'blockquote',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.sidebar .widget ul li a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.post-tags > span',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.post-tags > a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.single-post-nav .post-nav-title',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.footer-widget ul li a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-header.header-main .navSidebar-wraper .navSidebar-button:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-serach.style2 .search-btn',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.btn.btn-primary',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.blog-sidebar-wraper .widget .xs-title:before',
            'property'	=> 'background',
        ),
        array(
            'element' 	=> '.xs-list.bullet li::before',
            'property'	=> 'background',
        ),
        array(
            'element' 	=> '.xs-comments-area .comments-title:before',
            'property'	=> 'background',
        ),
        array(
            'element' 	=> '.entry-header .entry-meta i, .comment-author i',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-comments-area .reply .comment-reply-link',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> 'a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.subscribe-from p,.sideabr-list-widget span,.close-side-widget,.subscribe-from .sub-btn',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.widget.widget_recent_entries ul li a:hover, .widget.widget_recent_comments ul li a:hover, .widget.widget_meta ul li a:hover, .widget.widget_pages ul li a:hover, .widget.widget_archive ul li a:hover, .widget.widget_nav_menu ul li a:hover, .widget.widget_categories ul li a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.inner-banner-area',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.inner-banner-area',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.header .xs-top-bar',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.contact-info > a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-top-bar.version-2',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.header-new .btn-danger:not([class*=btn-outline-])',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-inline-form .check-btn:hover',
            'property'	=> 'background-color',
        ),

    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'secondary_color',
    'label'       => esc_html__( 'Secondary Color', 'seocify' ),
    'section'     => 'general_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-header.header-main .navSidebar-wraper .navSidebar-button',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-inline-form .check-btn',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.btn.btn-primary:hover',
            'property'	=> 'background-color',
        ),

    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'xs_grid_line_parallax_animation',
    'label'       => esc_html__( 'Enable grid line parallax animation', 'seocify' ),
    'section'     => 'general_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'xs_grid_line_parallax_animation_line_style',
    'label'       => esc_html__( 'Line Style', 'seocify' ),
    'section'     => 'general_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'seocify' ),
        'off' => esc_attr__( 'Disable', 'seocify' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'xs_grid_line_parallax_animation',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
);