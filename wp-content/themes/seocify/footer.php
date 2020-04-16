<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 */

$show_partner_area = seocify_option('show_partner_area');
$footer_style = seocify_option('footer_style');
$footer_columns = seocify_option('footer_widget_layout');
$footer_logo = seocify_option('footer_logo');
$footer_map_pin_img = seocify_option('footer_map_pin_img');
$footer_contact_img = seocify_option('footer_contact_img');
$footer_address = seocify_option('footer_address');
$footer_map_url = seocify_option('footer_map_url');
$footer_email = seocify_option('footer_email');
$footer_phn = seocify_option('footer_phn');
$footer_social_links = seocify_option('footer_social_links');
$partner_prefix = seocify_option('partner_prefix');
$partner_logo = seocify_option('partner_logo');
$payment_logo = seocify_option('payment_logo');
$show_footer_top = seocify_option('show_footer_top');

if ($footer_columns == 12) {
    $footer_column = 1;
} elseif ($footer_columns == 6) {
    $footer_column = 2;
} elseif ($footer_columns == 4) {
    $footer_column = 3;
} elseif ($footer_columns == 3) {
    $footer_column = 4;
}

$show_footer_widget = seocify_option('show_footer_widget');

?>
<footer class="xs-footer-section">
<?php if($show_footer_top): ?>
<div class="container">
    <div class="footer-top-area">
        <div class="row">
            <div class="col-md-4">
                <?php  if (!empty($footer_logo)) { ?>
                    <div class="footer-logo">
                        <a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php echo esc_url($footer_logo);?>" alt="<?php esc_attr_e('footer logo','seocify');?>"></a>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-8">
                <ul class="address-info-list list-inline">
                    <li>
                        <?php  if (!empty($footer_map_pin_img)) { ?>
                            <div class="address-icon">
                                <img src="<?php echo esc_url($footer_map_pin_img);?>" alt="<?php esc_attr_e('footer logo','seocify');?>">
                            </div>
                        <?php } ?>
                        <div class="address-info addr"><a href="<?php echo wp_kses_post($footer_map_url); ?>"><?php echo wp_kses_post($footer_address); ?></a></div>
                    </li>
                    <li>
                        <?php  if (!empty($footer_contact_img)) { ?>
                            <div class="address-icon">
                                <img src="<?php echo esc_url($footer_contact_img);?>" alt="<?php esc_attr_e('footer logo','seocify');?>">
                            </div>
                        <?php } ?>
                        <div class="address-info"><a class="phn" href="tel:<?php echo esc_html($footer_phn);?>"><?php echo esc_html($footer_phn);?></a> <br> <a class="email" href="mailto:<?php echo sanitize_email($footer_email);?>"><?php echo sanitize_email($footer_email);?></a></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

    <?php if($show_footer_widget): ?>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <?php for ($i = 1; $i <= $footer_column; $i++): ?>
                    <div class="col-md-<?php echo esc_attr($footer_columns); ?>">
                        <?php
                        if (is_active_sidebar('footer-widget-' . $i)):
                            dynamic_sidebar('footer-widget-' . $i);
                        endif;
                        ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <?php if ($show_partner_area): ?>
        <div class="partner-area-wraper">
            <div class="container">
                <div class="partner-area">
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="xs-lsit list-inline">
                                <li class="title"><?php echo esc_html($partner_prefix);?></li>
                                <?php if (is_array($partner_logo) && !empty($partner_logo)): ?>
                                    <?php foreach ($partner_logo as $index => $item): ?>
                                        <?php
                                        $img = '';
                                        if (!empty($item['image'])) {
                                            $imgs = wp_get_attachment_image_src($item['image'], 'full');
                                            $img = $imgs[0];
                                            echo '<li><img src="' . esc_url($img) . '" alt="' . seocify_get_alt_name($item) . '"></li>';
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="xs-list list-inline text-right">
                                <?php if (is_array($payment_logo) && !empty($payment_logo)): ?>
                                    <?php foreach ($payment_logo as $index => $item): ?>
                                        <?php
                                        $img = '';
                                        if (!empty($item['image'])) {
                                            $imgs = wp_get_attachment_image_src($item['image'], 'full');
                                            $img = $imgs[0];
                                            echo '<li><img src="' . esc_url($img) . '" alt="' . seocify_get_alt_name($item) . '"></li>';
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright-text">
                        <p><?php echo seocify_option('copyright_text'); ?></p>
                    </div><!-- .copyright-text END -->
                </div>
                <?php if($footer_social_links) { ?>
                    <div class="col-md-6">
                        <ul class="social-list">
                            <?php foreach($footer_social_links as $social){
                                $icon_class = $social['social_icon'].' ';
                                if (preg_match('/fa fa-(.*?) /', $icon_class, $match) == 1 || preg_match('/icon icon-(.*?) /', $icon_class, $match) == 1) {
                                    $class = $match[1];
                                }
                                ?><li><a class="<?php echo esc_attr($class);?>" href="<?php echo esc_url($social['social_url']); ?>"><i class="<?php echo esc_attr($social['social_icon']); ?>"></i></a></li><?php
                            } ?>
                        </ul>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </div>
</footer>
<?php
get_template_part( 'template-parts/navigation/nav','search' );
get_template_part( 'template-parts/navigation/nav','sidebar' );
get_template_part( 'template-parts/navigation/nav','wpml' );
?>
<?php wp_footer(); ?>
</body>
</html>