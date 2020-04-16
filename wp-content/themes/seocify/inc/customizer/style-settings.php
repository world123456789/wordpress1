<?php
$fields[] = array(
    'type'        => 'typography',
    'settings'    => 'body_font',
    'label'       => esc_html__( 'Body Font', 'seocify' ),
    'section'     => 'styling_section',
    'default'     => array(
        'font-family'    => '"Nunito", sans-serif',
        'variant'        => '',
        'font-size'      => '1rem',
        'font-weight'      => '400',
        'line-height'    => '1.7333333333',
        'color'          => '#192225'
    ),
    'output'      => array(
        array(
            'element' => 'body',
        ),
    ),
); 
$fields[] = array(
    'type'        => 'typography',
    'settings'    => 'heading_font',
    'label'       => esc_html__( 'Heading Font', 'seocify' ),
    'section'     => 'styling_section',
    'default'     => array(
        'font-family'    => '"Nunito", sans-serif',
        'variant'        => '',
        'font-size'      => '',
        'font-weight'      => '700',
        'line-height'    => '',
        'color'          => '#192225'
    ),
    'output'      => array(
        array(
            'element' => 'h1,h2,h3,h4,h5,h6',
        ),
    ),
);

$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Partical Effects 1 color ', 'seocify' ),
    'section'     => 'styling_section',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Color', 'seocify' ),
    ),
    'settings'    => 'partiacl_color_1',
    'default'     => array(
        array(
            'color_partical' => '',
        ),
    ),
    'fields' => array(
        'color_partical' => array(
            'type'        => 'color',
            'label'       => esc_attr__( 'Color', 'seocify' ),
            'default'     => '',
        ),

    )
);

$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Partical Effects 2 color ', 'seocify' ),
    'section'     => 'styling_section',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Color', 'seocify' ),
    ),
    'settings'    => 'partiacl_color_2',
    'default'     => array(
        array(
            'color_partical' => '',
        ),
    ),
    'fields' => array(
        'color_partical' => array(
            'type'        => 'color',
            'label'       => esc_attr__( 'Color', 'seocify' ),
            'default'     => '',
        ),

    )
);