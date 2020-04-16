<?php
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'blog_show_breadcrumb',
    'label'       => esc_html__( 'Show Breadcrumb', 'seocify' ),
    'section'     => 'blog_section',
    'default'     => '1',
    'choices'     => array(
        'on'  => esc_html__( 'Enable', 'seocify' ),
        'off' => esc_html__( 'Disable', 'seocify' ),
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'blog_sidebar',
    'label'       => esc_html__( 'Blog Sidebar Position', 'seocify' ),
    'section'     => 'blog_section',
    'default'     => '3',
    'choices'     => array(
        '1'      => esc_html__('Full Width','seocify'),
        '2'      => esc_html__('Left Sidebar','seocify'),
        '3'      => esc_html__('Right Sidebar','seocify'),
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'blog_style',
    'label'       => esc_html__( 'Blog Style', 'seocify' ),
    'section'     => 'blog_section',
    'default'     => '1',
    'choices'     => array(
        '1'      => esc_html__('List View','seocify'),
        '2'      => esc_html__('Grid View','seocify'),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_date',
    'label'       => esc_html__( 'Show Date', 'seocify' ),
    'section'     => 'blog_section',
    'default'     => '',
    'choices'     => array(
        'on'  => esc_html__( 'Enable', 'seocify' ),
        'off' => esc_html__( 'Disable', 'seocify' ),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_social',
    'label'       => esc_html__( 'Show Social In Blog Single', 'seocify' ),
    'section'     => 'blog_section',
    'default'     => '',
    'choices'     => array(
        'on'  => esc_html__( 'Enable', 'seocify' ),
        'off' => esc_html__( 'Disable', 'seocify' ),
    ),
);