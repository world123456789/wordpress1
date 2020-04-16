<?php
$image = seocify_option('nav_sidebar_logo');
$nav_sidebar_content = seocify_option('nav_sidebar_content');
$nav_contact_info = seocify_option('nav_contact_info');
$sidebar_show_subscribe = seocify_option('sidebar_show_subscribe');
$sidebar_subscribe_title = seocify_option('sidebar_subscribe_title');
$sidebar_subscribe_shortcode = seocify_option('sidebar_subscribe_shortcode');
$sidebar_social_icon = seocify_option('sidebar_social_icon');
$sidebar_btn = seocify_option('sidebar_btn');
$sidebar_btn_link = seocify_option('sidebar_btn_link');
?>

<div class="xs-sidebar-group info-group">
    <div class="xs-overlay black-bg"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">
                    <i class='icon icon-cross'></i>
                </a>
            </div>
            <div class="sidebar-textwidget">
                <?php if (!empty($image)): ?>
                    <div class="sidebar-logo-wraper">
                        <img src="<?php echo esc_url($image); ?>"
                             alt="<?php echo seocify_get_alt_name(get_the_ID()); ?>">
                    </div>
                <?php endif; ?> 
                <p><?php echo esc_html($nav_sidebar_content); ?></p>

                <?php if (is_array($nav_contact_info) && !empty($nav_contact_info)): ?>
                    <ul class="sideabr-list-widget">
                        <?php foreach ($nav_contact_info as $insex => $item): ?>
                            <li>
                                <div class="media">
                                    <?php if (!empty($item['image'])):
                                        $image = wp_get_attachment_image_src($item['image'], 'full');
                                        ?>
                                        <div class="d-flex">
                                            <img src="<?php echo esc_url($image[0]); ?>"
                                                 alt="<?php seocify_get_alt_name($item['image']); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="media-body">
                                        <?php if ($item['title'] !=''): ?>
                                            <p><?php echo esc_html($item['title']) ?></p>
                                        <?php endif; ?>
                                        <?php if ($item['sub_title'] !=''): ?>
                                            <span><?php echo esc_html($item['sub_title']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div><!-- address 1 -->
                            </li>
                        <?php endforeach; ?>
                    </ul><!-- .sideabr-list-widget -->
                <?php endif; ?>

                <?php if ($sidebar_show_subscribe): ?>
                    <div class="subscribe-from">
                        <p><?php echo esc_html($sidebar_subscribe_title); ?></p>
                        <?php  echo do_shortcode($sidebar_subscribe_shortcode); ?>
                    </div>
                <?php endif; ?>
                <?php if (is_array($sidebar_social_icon) && !empty($sidebar_social_icon)): ?>
                    <ul class="social-list version-2">
                        <?php foreach($sidebar_social_icon as $index => $item):
                            
                                $icon_class = $item['icon'].' ';
                                if (preg_match('/fa fa-(.*?) /', $icon_class, $match) == 1 || preg_match('/icon icon-(.*?) /', $icon_class, $match) == 1) {
                                    $class = $match[1];
                                }
                            ?>
                            <li><a href="<?php echo esc_url($item['link']); ?>" class="<?php echo esc_attr($class);?>"><i class="<?php echo esc_attr($item['icon']) ?>"></i></a></li>
                        <?php endforeach; ?>
                    </ul><!-- .social-list -->
                <?php endif; ?>
                <?php if($sidebar_btn !=''): ?>
                <div class="text-center">
                    <a href="<?php echo esc_url($sidebar_btn_link); ?>" class="btn btn-primary"><?php echo esc_html($sidebar_btn) ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>