<?php
$show_top_header = seocify_option('show_top_header');
$phn_no = seocify_option('top_header_phn');
$email_address = seocify_option('top_header_email');
$nav_social_links = seocify_option('nav_social_links');
?>
<?php if ($show_top_header): ?>
    <div class="xs-top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="xs-top-bar-info">
                        <?php if ($phn_no !=''): ?>
                            <li>
                                <p><a class="top-tel" href="tel:<?php echo esc_html($phn_no); ?>"><i class="icon icon-phone"></i><?php echo esc_html($phn_no); ?></a></p>
                            </li>
                        <?php endif; ?>
                        <?php if ($email_address !=''): ?>
                            <li>
                                <a class="top-mail" href="mailto:<?php echo esc_attr($email_address); ?>"><i
                                            class="icon icon-email"></i><?php echo esc_html($email_address); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php if($nav_social_links): ?>
                    <div class="col-md-6">
                        <ul class="xs-list list-inline">
                            <?php foreach($nav_social_links as $social){
                                    ?><li><a href="<?php echo esc_url($social['social_url']); ?>"><i class="<?php echo esc_attr($social['social_icon']); ?>"></i></a></li><?php
                                } ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>