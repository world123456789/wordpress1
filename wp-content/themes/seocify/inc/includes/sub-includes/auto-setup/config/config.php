<?php

if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );



return array(
	/**
	 * Array for demos
	 */
	'plugins'			 => array(
		array(
			'name'		 => esc_html__( 'Unyson', 'seocify' ),
			'slug'		 => 'unyson',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Elementor', 'seocify' ),
			'slug'		 => 'elementor',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Kirki', 'seocify' ),
			'slug'		 => 'kirki',
			'required'	 => true,  
		),
		array(
			'name'		 => esc_html__( 'Seocify Assistance', 'seocify' ),
			'slug'		 => 'seocify-assistance',
			'required'	 => true,
			'source'	 =>  SEOCIFY_REMOTE_URL . '/seocify-assistance.zip' ,
		),
        array(
            'name'		 => esc_html__( 'Contact Form 7', 'seocify' ),
            'slug'		 => 'contact-form-7',
            'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'MailChimp for WordPress', 'seocify' ),
			'slug'		 => 'mailchimp-for-wp',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Slider Revolution', 'seocify' ),
			'slug'		 => 'revslider',
			'required'	 => true,
			'source'	 =>  SEOCIFY_REMOTE_URL . '/revslider.zip' ,
		),
	),
	'theme_id'			 => 'seocify',
	'child_theme_source' => SEOCIFY_REMOTE_URL . '/seocify-child.zip',
	'has_demo_content'	 => true
);
