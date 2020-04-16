<?php
/**
 * Blog Header
 *
 */
$bg_image				 = $heading				 = $overlay				 = $overlay				 = '';
$page_banner_title		 = $page_banner_subtitle	 = $page_banner_desc		 = $header_image			 = $header_buttons			 = $header_icons			 = '';

if ( defined( 'FW' ) ) {

	$global_page_show_breadcrumb = seocify_option( 'show_breadcrumb' );


	$global_page_banner_img		 = seocify_option( 'shop_banner_img' );
	$global_page_banner_title	 = seocify_option( 'shop_banner_title' );
	$global_show_page_banner	 = seocify_option( 'show_shop_banner' );


	if ( $global_page_banner_img != '' ) {
		$bg_image = 'style="background-image: url(' . $global_page_banner_img . ')"';
	}


	if ( $global_page_banner_title != '' ) {
		$page_banner_title = $global_page_banner_title;
	}


	$page_show_breadcrumb = $global_page_show_breadcrumb;

}else{
	$bg_image = 'style="background-image: url(' . SEOCIFY_IMAGES_URI . '/backgrounds/background-1.png)"';
	$page_show_breadcrumb = 'no';
	$global_show_page_banner = 'yes';
	$page_banner_title = '';
}

if ( $global_show_page_banner ):
	?>

	<section class="inner-banner-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner-banner-content">

			
			<header class="woocommerce-products-header">
				
				<?php
				if($page_banner_title !=''){
					?><h1 class="inner-banner-title woocommerce-products-header__title page-title"><?php echo esc_html($page_banner_title); ?></h1><?php
				}else{
					?><h1 class="inner-banner-title woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1><?php
				}

				/**
				 * Hook: woocommerce_before_main_content.
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 * @hooked WC_Structured_Data::generate_website_data() - 30
				 */
				do_action( 'woocommerce_before_main_content' );

				?>
				
			</header>
					</div>
				</div>
			</div>
	    </div>
		<?php if ( $bg_image ): ?>
			<div class="banner-image" <?php echo wp_kses_post( $bg_image ); ?>></div>
		<?php endif; ?>
	</section>

<?php endif; ?>