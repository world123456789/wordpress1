<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}


Kirki::add_config( 'seocify_customizer', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );


function seocify_customizer_sections($wp_customize){
    $wp_customize->add_panel( 'theme_option', array(
        'priority'    => 10,
        'title'       => esc_html__( 'Theme Options', 'seocify' ),
    ) );

	$wp_customize->add_section( 'general_section', array(
		'title'			=> esc_html__( 'General Settings', 'seocify' ),
		'priority'		=> 1,
		'description'	=> esc_html__( 'to change logo,favicon etc', 'seocify' ),
        'panel'          => 'theme_option',
	) );

	$wp_customize->add_section( 'nav_section', array(
		'title'			=> esc_html__( 'Navigation Settings', 'seocify' ),
		'priority'		=> 2,
		'description'	=> esc_html__( 'Setting Your Menu', 'seocify' ),
        'panel'          => 'theme_option',
	) );
    $wp_customize->add_section( 'blog_banner_section', array(
        'title'         => esc_html__( 'Banner Settings', 'seocify' ),
        'priority'      => 3,
        'description'   => esc_html__( 'Setting Your Blog Banner', 'seocify' ),
        'panel'          => 'theme_option',
    ) );
	$wp_customize->add_section( 'page_section', array(
        'title'			=> esc_html__( 'Page Settings', 'seocify' ),
        'priority'		=> 4,
        'description'	=> esc_html__( 'Setting Your Page', 'seocify' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'blog_section', array(
        'title'         => esc_html__( 'Blog Settings', 'seocify' ),
        'priority'      => 5,
        'description'   => esc_html__( 'Setting Your Blog', 'seocify' ),
        'panel'          => 'theme_option',
    ) );
    $wp_customize->add_section( 'shop_section', array(
        'title'         => esc_html__( 'Shop Settings', 'seocify' ),
        'priority'      => 5,
        'description'   => esc_html__( 'Setting Your Shop', 'seocify' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'footer_section', array(
        'title'			=> esc_html__( 'Footer Settings', 'seocify' ),
        'priority'		=> 6,
        'description'	=> esc_html__( 'Setting Your Footer', 'seocify' ),
        'panel'          => 'theme_option',
    ) );
    $wp_customize->add_section( 'error_section', array(
        'title'			=> esc_html__( 'Error Page Settings', 'seocify' ),
        'priority'		=>7,
        'description'	=> esc_html__( 'Setting Your Error Page', 'seocify' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'styling_section', array(
        'title'			=> esc_html__( 'Styling Settings', 'seocify' ),
        'priority'		=> 8,
        'description'	=> esc_html__( 'Setting Your font', 'seocify' ),
        'panel'          => 'theme_option',
    ) );
}

add_action( 'customize_register', 'seocify_customizer_sections' );

require SEOCIFY_CUSTOMIZER_DIR . 'customizer-fields.php' ;
