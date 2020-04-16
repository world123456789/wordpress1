<ul class="nav nav-tabs main-tabs">
<?php
if (is_array($tabs_item) && !empty($tabs_item)):
    $id_int = 'xs-tabs-id-' . substr($this->get_id_int(), 0, 3);
    foreach ($tabs_item as $key => $item) :
        $active = ($key == 0) ? 'active show' : '';
        ?>
        <li class="nav-item">
            <a class="nav-link <?php echo esc_attr($active) ?>" data-toggle="tab"
               href="#<?php echo esc_attr($id_int . '-' . $key); ?>">
                <?php if (!empty($item['title_image']['url'])): ?>
                    <p><img src="<?php echo esc_url($item['title_image']['url']) ?>"
                            alt="<?php echo esc_attr(seocify_get_alt_name($item['title_image']['id'])) ?>"></p>
                <?php endif; ?>
                <?php echo esc_html($item['tab_title']) ?>
            </a>
        </li>
        <?php
    endforeach;
endif;
?>
</ul>

<div class="tab-content">
    <?php
    if (is_array($tabs_item) && !empty($tabs_item)):
        foreach ($tabs_item as $key => $item) :

            $active = ($key == 0) ? 'active show' : '';
            ?>
            <div class="tab-pane fadeInRight animated <?php echo esc_attr($active) ?>" id="<?php echo esc_attr($id_int . '-' . $key); ?>"
                 role="tabpanel">
                <div class="single-service-preview">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="service-preview-img">
                                <img src="<?php echo esc_url($item['content_image']['url']) ?>" alt="<?php echo esc_attr(seocify_get_alt_name($item['title_image']['id'])) ?>">
                            </div><!-- .service-preview-img END -->
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="service-preview-content">
                            <h4 class="xs-content-title"><?php echo esc_html($item['title']);?></h4>
                                <?php echo wp_kses_post($item['tab_content']); ?>
                                <div class="btn-wraper">
                                    <a href="<?php echo esc_url($item['button_link']['url']);?>" class="btn <?php echo esc_attr($item['btn_style']);?>"><?php echo esc_html($item['button_label']);?></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .row END -->
                </div><!-- .row END -->
            </div><!-- #webTransfer END -->
            <?php
        endforeach;
    endif;
    ?>
</div>
