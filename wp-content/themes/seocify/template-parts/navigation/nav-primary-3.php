<?php
if ( defined( 'FW' ) ) {
    //Page settings
    $custom_logo	 = fw_get_db_post_option( get_the_ID(), 'custom_logo' );
}
if(isset($custom_logo['url']) && $custom_logo['url'] !=''){
    $logo = $custom_logo['url'];
}else{
    $logo = seocify_option('site_logo');
}
$sticky_logo = seocify_option('sticky_logo');

$nav_search = seocify_option('nav_search');
$nav_sidebar = seocify_option('nav_sidebar');
$nav_cart = seocify_option('nav_cart');
$nav_cart_url = seocify_option('nav_cart_url');
$nav_lang = seocify_option('nav_lang');
$is_sticky_header = seocify_option('is_sticky_header');

$phn_no = seocify_option('top_header_phn');
$call_now_text = seocify_option('call_now_text');

$cta_text = seocify_option('cta_text');
$cta_url = seocify_option('cta_url');



?>

<header class="header-style3 xs-header header-main">
    <div class="container-fluid">
        <div class="navbar">

            <div class="xs-logo-wraper">
                <div class=" header-info">
                    <a href="<?php echo esc_url(home_url('/'));?>" class="xs-logo">
                        <?php if(!empty($logo)): ?>
                            <img src="<?php echo esc_url($logo);  ?>" alt="<?php echo get_bloginfo(); ?>">
                        <?php else: ?>
                            <span><?php bloginfo('name'); ?></span>
                        <?php endif ?>
                        <?php if(!empty($sticky_logo) && $is_sticky_header): ?>
                            <img src="<?php echo esc_url($sticky_logo);  ?>" alt="<?php echo get_bloginfo(); ?>" class="logo-sticky">
                        <?php endif ?>
                    </a>
                </div>
            </div>
            <nav class="xs-menus mr-auto">
                <div class="nav-header">
                    <a class="nav-brand" href="<?php echo esc_url(home_url('/'));?>"></a>
                    <div class="nav-toggle"></div>
                </div>
                <div class="nav-menus-wrapper clearfix">
                    <?php
                    if(has_nav_menu('primary')) {
                        wp_nav_menu(
                            array(
                                'theme_location'	 => 'primary',
                                'container'	         => '',
                                'container_class'	 => '',
                                'menu_class'		 => 'nav-menu single-page-menu',
                                'fallback_cb'		 => false,
                                'menu_id'			 => 'main-menu',
                                'walker'			 => new Seocify_Custom_Nav_Walker(),
                            )
                        );
                    }
                    ?>
                </div>
            </nav>



            <ul class="xs-menu-tools">
                <?php if ($nav_lang):

                    if (class_exists('SitePress')):
                        $languages = icl_get_languages('skip_missing=0&orderby=code');
                        $flag_url = $languages[ICL_LANGUAGE_CODE]['country_flag_url'];
                        $lang_code = ICL_LANGUAGE_CODE;
                    else:
                        $flag_url = get_template_directory_uri() . '/assets/images/united-states.svg';
                        $lang_code = 'en';
                    endif; ?>
                    <li>
                        <a href="#modal-popup-wpml" class="languageSwitcher-button xs-modal-popup">
                            <span class="xs-flag" style="background-image: url(<?php echo esc_url($flag_url);?>"></span>
                            <span class="lang-title text-uppercase"><?php echo esc_html($lang_code);?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <li>
                    <?php if ($phn_no !=''): ?>
                        <div class="header-info">
								<span class="contact-info">
									<img src="<?php echo SEOCIFY_IMAGES_URI;?>/phone_icon.png" alt="Phone">
									<a href="tel:<?php echo esc_html($phn_no); ?>">
										<?php echo esc_html($phn_no); ?>
									</a>
								</span>
                        </div>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ($cta_text !=''): ?>
                        <div class="nav-btn">
                            <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-danger"><?php echo esc_html($cta_text); ?></a>
                        </div>
                    <?php endif; ?>
                </li>
                <?php if(class_exists( 'woocommerce' )): ?>
                    <li class="woo_cart_url">
                        <a href="<?php echo esc_url(wc_get_page_permalink('cart')); ?>" class="woo_cart_url xs-modal-popup">
                            <i class="icon icon-online-shopping-cart"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($nav_search): ?>
                    <li class="nav-search-3">
                        <a href="#modal-popup-2" class="navsearch-button xs-modal-popup">
                            <i class="icon icon-search"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($nav_sidebar): ?>
                    <li class="nav-dot">
                        <a href="#" class="navSidebar-button">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>