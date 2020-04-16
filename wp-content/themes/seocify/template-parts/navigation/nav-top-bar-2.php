<?php
$show_top_header = seocify_option('show_top_header');
$email_address = seocify_option('top_header_email');
$nav_social_links = seocify_option('nav_social_links');

$nav_search = seocify_option('nav_search');
$nav_sidebar = seocify_option('nav_sidebar');
$nav_cart = seocify_option('nav_cart');
$nav_cart_url = seocify_option('nav_cart_url');
$nav_lang = seocify_option('nav_lang');
?>
<?php if ($show_top_header): ?>
    <div class="xs-top-bar version-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="top-bar-infos">
                        <?php if ($email_address !=''):  ?>
                            <ul class="info-list list-inline">
                                <li><a href="mailto:<?php echo esc_attr($email_address); ?>"><i class="icon icon-contact"></i><span><?php echo esc_attr($email_address); ?></span></a></li>
                            </ul>
                        <?php endif; ?>
                        <?php if($nav_social_links): ?>
                            <ul class="xs-list list-inline">
                                <?php foreach($nav_social_links as $social){
                                        ?><li><a href="<?php echo esc_url($social['social_url']); ?>"><i class="<?php echo esc_attr($social['social_icon']); ?>"></i></a></li><?php
                                    } ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($nav_sidebar!='' || $nav_search!='' || $nav_lang!='' || $nav_cart!=''): ?>
                    <div class="col-lg-6 col-md-4">
                        <ul class=" xs-menu-tools">
                            <?php if ($nav_lang): ?>
                                <?php if (class_exists('SitePress')): 
                                    $languages = icl_get_languages('skip_missing=0&orderby=code');
                                    $flag_url = (isset($languages[ICL_LANGUAGE_CODE])) 
                                                ? $languages[ICL_LANGUAGE_CODE]['country_flag_url']
                                                : get_template_directory_uri() . '/assets/images/united-states.svg';
    
                                    $lang_code = (isset($languages[ICL_LANGUAGE_CODE])) 
                                                ? ICL_LANGUAGE_CODE
                                                : 'en';
                                ?>
                                    <li>
                                        <a href="#modal-popup-wpml" class="languageSwitcher-button xs-modal-popup">
                                            <span class="xs-flag" style="background-image: url(<?php echo esc_url($flag_url);?>"></span>
                                            <span class="lang-title text-uppercase"><?php echo esc_html($lang_code);?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($nav_search!=''): ?>
                                <li>
                                    <a href="#modal-popup-2" class="navsearch-button xs-modal-popup"><i class="icon icon-search"></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if ($nav_sidebar!=''): ?>
                                <li><a href="#" class="navSidebar-button"><i class="icon icon-menu-1"></i></a></li>
                            <?php endif; ?> 
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>