<?php

/*
 * TGM REQUIRE PLUGIN
 * require or recommend plugins for your WordPress themes
 */

/** @internal */
function _action_seocify_register_required_plugins() {
	$plugins	 = array(
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
			'version'	 => '1.2',
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
		
	);


	$config = array(
		'id'			 => 'seocify', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	 => '', // Default absolute path to bundled plugins.
		'menu'			 => 'seocify-install-plugins', // Menu slug.
		'parent_slug'	 => 'themes.php', // Parent menu slug.
		'capability'	 => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'	 => true, // Show admin notices or not.
		'dismissable'	 => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	 => '', // If 'dismissable' is false, this message will be output at top of nag.
		'message'		 => '', // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', '_action_seocify_register_required_plugins' );