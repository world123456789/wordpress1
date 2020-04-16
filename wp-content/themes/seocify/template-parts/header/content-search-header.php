<?php
/**
 * Blog Header
 *
 */
$bg_image				 = $heading				 = $overlay				 = $overlay				 = '';

if ( defined( 'FW' ) ) {

	$global_page_show_breadcrumb = seocify_option( 'show_breadcrumb' );

	$global_page_banner_img		 = seocify_option( 'search_banner_img' );
	$global_show_page_banner	 = seocify_option( 'show_search_banner' );

	if ( $global_page_banner_img != '' ) {
		$bg_image = 'style="background-image: url(' . $global_page_banner_img . ')"';
	} else {
		$bg_image = 'style="background-image: url(' . SEOCIFY_IMAGES_URI . '/backgrounds/background-1.png)"';
	}

	$page_show_breadcrumb = $global_page_show_breadcrumb;

}else{
	$bg_image = 'style="background-image: url(' . SEOCIFY_IMAGES_URI . '/backgrounds/background-1.png)"';
	$page_show_breadcrumb = 'no';
	$global_show_page_banner = 'yes';
}

if ( $global_show_page_banner ):
	?>

	<section class="inner-banner-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner-banner-content">
						<h1 class="inner-banner-title">
							<?php printf( esc_html__( 'Search Results for: %s', 'seocify' ), get_search_query() ); ?>
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