<div class="xs-pricing-group">
    <?php

    if($settings['seocify_team_menth_yearly_switch'] == 'yes') :

        if (!empty($monthly) && !empty($yearly)) : ?>
            <ul class="nav nav-tabs main-nav-tab tab-swipe" role="tablist">
                <li>
                    <a id="monthly-tab" class="active show" data-toggle="tab"
                       href="#<?php echo esc_html(strtolower($monthly)); ?>"><?php echo esc_html($monthly); ?></a>
                </li>
                <li>
                    <a id="yearly-tab" data-toggle="tab"
                       href="#<?php echo esc_html(strtolower($yearly)); ?>"><?php echo esc_html($yearly); ?></a>
                </li>
            </ul>
        <?php endif; endif; ?>
    <div class="tab-content">
        <?php if (isset($monthly_table) && !empty($monthly_table)) : ?>
            <div class="tab-pane fadeIn animated show active" id="<?php echo esc_html(strtolower($monthly)); ?>">
                <div class="row">
                    <?php foreach ($monthly_table as $table_value) : ?>
                        <div class="<?php echo esc_attr($grid);?> col-md-6">
                            <div class="xs-single-pricing <?php if ( $table_value['xs_featured_table'] == 'yes' ) echo 'active'; ?>">
                                <div class="pricing-header">
                                    <?php if (!empty($table_value['table_title'])) : ?>
                                        <h3 class="xs-content-title"><?php echo esc_html($table_value['table_title']); ?></h3>
                                    <?php endif; ?>
                                    <?php
                                    if (!empty($table_value['table_image']['url'])) :
                                        $alt = get_post_meta($table_value['table_image']['id'], '_wp_attachment_image_alt', true);
                                        ?>
                                        <div class="pricing-img-block">
                                            <img src="<?php echo esc_url($table_value['table_image']['url']); ?>"
                                                 alt="<?php echo esc_attr($alt); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <h2 class="price-table"><sup><?php echo esc_html($table_value['currency_icon']); ?></sup><?php echo esc_html($table_value['table_price']); ?> <sub>/<?php echo esc_html($table_value['table_duration']); ?></sub></h2>
                                </div><!-- .pricing-header END -->

                                <div class="pricing-body">
                                    <ul class="xs-list">
                                        <?php
                                        $table_contents = preg_split('/\r\n|[\r\n]/', $table_value['table_content']);
                                        if (is_array($table_contents) && !empty($table_contents)) :
                                            foreach ($table_contents as $tab_text) :
                                                echo ' <li>';
                                                echo seocify_kses($tab_text);
                                                echo '</li>';
                                            endforeach;
                                        endif;
                                        ?>
                                    </ul>
                                </div><!-- .pricing-body END -->
                                <?php if( !empty($table_value['button_text']) ) : ?>
                                    <?php $btn_target = ( $table_value['button_url']['is_external']) ? '_blank' : '_self'; ?>
                                    <div class="pricing-footer">
                                        <a href="<?php echo esc_url($table_value['button_url']['url']); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn-primary"><?php echo esc_html($table_value['button_text']); ?></a>
                                    </div><!-- .pricing-footer END -->
                                    <?php if($show_pulse_animation == 'yes'): ?><div class="pulse-anim"></div><?php endif; ?>
                                <?php endif; ?>
                            </div><!-- .xs-single-pricing END -->
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($yearly_table) && !empty($monthly_table)) : ?>
            <div class="tab-pane fadeIn animated" id="<?php echo esc_html(strtolower($yearly)); ?>">
                <div class="row">
                    <?php foreach ( $yearly_table as $table_value ) : ?>
                        <div class="<?php echo esc_attr($grid);?> col-md-6">
                            <div class="xs-single-pricing <?php if ( $table_value['xs_featured_table'] == 'yes' ) echo 'active'; ?>">
                                <div class="pricing-header">
                                    <?php if (!empty($table_value['table_title'])) : ?>
                                        <h3 class="xs-content-title"><?php echo esc_html($table_value['table_title']); ?></h3>
                                    <?php endif; ?>
                                    <?php
                                    if (!empty($table_value['table_top_image']['url'])) :
                                        $alt = get_post_meta($table_value['table_top_image']['id'], '_wp_attachment_image_alt', true);
                                        ?>
                                        <div class="pricing-img-block">
                                            <img src="<?php echo esc_url($table_value['table_top_image']['url']); ?>"
                                                 alt="<?php echo esc_attr($alt); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <h2 class="price-table"><sup><?php echo esc_html($table_value['currency_icon']); ?></sup><?php echo esc_html($table_value['table_price']); ?> <sub>/<?php echo esc_html($table_value['table_duration']); ?></sub></h2>
                                </div><!-- .pricing-header END -->

                                <div class="pricing-body">
                                    <ul class="xs-list">
                                        <?php
                                        $table_contents = preg_split('/\r\n|[\r\n]/', $table_value['table_content']);
                                        if (is_array($table_contents) && !empty($table_contents)) :
                                            foreach ($table_contents as $tab_text) :
                                                echo ' <li>';
                                                echo seocify_kses($tab_text);
                                                echo '</li>';
                                            endforeach;
                                        endif;
                                        ?>
                                    </ul>
                                </div><!-- .pricing-body END -->
                                <?php if( !empty($table_value['button_text']) ) : ?>
                                    <?php $btn_target = ( $table_value['button_url']['is_external']) ? '_blank' : '_self'; ?>
                                    <div class="pricing-footer">
                                        <a href="<?php echo esc_url($table_value['button_url']['url']); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn btn-primary"><?php echo esc_html($table_value['button_text']); ?></a>
                                    </div><!-- .pricing-footer END -->
                                    <?php if($show_pulse_animation == 'yes'): ?><div class="pulse-anim"></div><?php endif; ?>
                                <?php endif; ?>
                            </div><!-- .xs-single-pricing END -->
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>