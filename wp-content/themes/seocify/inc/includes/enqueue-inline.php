<?php

function seocify_action_xs_hook_css() {
    if ( defined( 'FW' ) ) {
        $main_color = fw_get_db_settings_option( 'main_color' );
        //custom css
        $custom_css	 = seocify_get_option( 'custom_css' );
        $output		 = 
            $custom_css."
            .woocommerce ul.products li.product .added_to_cart:hover,
            .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover{background-color: $main_color;}
            .woocommerce ul.products li.product .button,.woocommerce ul.products li.product .added_to_cart,
			.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,
			.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.sponsor-web-link a:hover i
		{background-color: $main_color;}" ;
        if(!empty($output)){
            wp_add_inline_style( 'seocify-style', $output );
        }
    }
}
 
add_action( 'wp_enqueue_scripts', 'seocify_action_xs_hook_css', 90 );