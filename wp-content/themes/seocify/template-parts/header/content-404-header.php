<?php
/**
 * Blog Header
 *
 */
$bg_image = $heading  = $overlay	 = '';
$page_banner_title = $page_banner_subtitle = $page_banner_desc = $header_image = $header_buttons = $header_icons = '';

if ( defined( 'FW' ) ) {
	$global_page_show_breadcrumb = seocify_option( 'show_breadcrumb' );

	$global_page_banner_img		 = seocify_option( 'error_banner_img' );
	$global_page_banner_title	 = seocify_option( 'error_banner_title' );
	$global_show_page_banner	 = seocify_option( 'show_error_banner' );

	if ( $global_page_banner_img != '' ) {
		$bg_image = 'style="background-image: url(' . $global_page_banner_img . ')"';
	}


	if ( $global_page_banner_title != '' ) {
		$page_banner_title = $global_page_banner_title;
	}
	$page_show_breadcrumb = $global_page_show_breadcrumb;
}else{
	$bg_image = 'style="background-image: url(' . SEOCIFY_IMAGES_URI . '/backgrounds/background-1.png)"';
	$page_banner_title = esc_html__('404','seocify');
	$page_show_breadcrumb = 'no';
	$global_show_page_banner = 'yes';
}




if ( $global_show_page_banner ): ?>

	<section class="inner-banner-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner-banner-content">
						<h1 class="inner-banner-title">
							<?php echo esc_html( $page_banner_title ); ?>
	                    </h1>
						<?php if ( $page_show_breadcrumb ): ?>
							<?php seocify_get_breadcrumbs(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
	    </div>
		<?php if ( $bg_image ): ?>
			<div class="banner-image" <?php echo wp_kses_post( $bg_image ); ?>></div>
		<?php endif; ?>
	</section>

<?php endif; ?>