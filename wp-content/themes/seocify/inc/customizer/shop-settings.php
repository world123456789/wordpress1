<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'shop_sidebar',
    'label'       => esc_html__( 'Shop Sidebar Position', 'seocify' ),
    'section'     => 'shop_section',
    'default'     => '1',
    'choices'     => array(
        '1'      => esc_html__('Full Width','seocify'),
        '2'      => esc_html__('Left Sidebar','seocify'),
        '3'      => esc_html__('Right Sidebar','seocify'),
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'shop_grid_column',
    'label'       => esc_html__( 'Grid Per Row', 'seocify' ),
    'section'     => 'shop_section',
    'default'     => '4',
    'choices'     => array(
        '6'     => esc_html__( '2 Column', 'seocify' ),
        '4'     => esc_html__( '3 Column', 'seocify' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'shop_sidebar',
            'operator'  => '==',
            'value'     => 1
        )
    ),
);
