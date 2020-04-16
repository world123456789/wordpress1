<div class="<?php echo esc_attr($seocify_hide_navigation == 'yes'? 'row' : ''); ?>" >
    <?php if($seocify_hide_navigation == 'yes') : ?>
        <div class="col-lg-5 xs-responsive-hidden">
            <div class="xs-seocify-testimonial-thumb-wrap">
                <div class="xs-seocify-testimonial xs-seocify-testimonial-v2 owl-carousel">

                    <?php if(!empty($testimonials)) {

                    foreach ($testimonials as $testimonial) :
                        if($testimonial['image']['url'] != '') : ?>

                            <div class="xs-seocify-testimonial-thumb wow bounceIn">
                                <?php if($testimonial['image']['id'] != '') :

                                    echo wp_get_attachment_image($testimonial['image']['id'], 'full'); ?>

                                <?php else:  ?>
                                    <img src="<?php echo esc_url($testimonial['image']['url']) ?>" alt="<?php echo esc_attr('Placeholder Image') ?>">
                                <?php endif; ?>
                            </div>

                        <?php endif; endforeach;  ?>

                </div>
                <div class="xs-seocify-testimonial-big-thumb d-flex justify-content-md-center align-items-center" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/images/tbg.png);">

                    <img src="<?php echo esc_url($testimonials[0]['image']['url']) ?>" alt="<?php echo esc_attr('Placeholder Image') ?>">

                </div>
                <?php } ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="<?php echo esc_attr($seocify_hide_navigation == 'yes'? 'col-lg-7' : ''); ?>">
        <div class="xs-seocify-testimonial-preview owl-carousel" data-nagivation="<?php echo esc_attr($seocify_hide_navigation); ?>">
            <?php if(!empty($testimonials)) {

                foreach ($testimonials as $testimonial) {

                    ?>
                    <div class="xs-seocify-testimonial-review">
                        <?php if ( $testimonial['icon'] ): ?>
                            <i class="<?php echo esc_attr( $testimonial['icon'] );  ?>"></i>
                        <?php endif ?>

                        <div class="xs-seocify-testimonial-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <?php if($testimonial['review']) : ?>

                            <p><?php echo esc_html($testimonial['review']); ?></p>

                        <?php endif;

                        if($testimonial['client_name']) : ?>
                            <h4><?php echo esc_html($testimonial['client_name']); ?></h4>
                        <?php endif;

                        if($testimonial['designation']): ?>

                            <h5><?php echo esc_html($testimonial['designation']); ?></h5>

                        <?php endif; ?>
                    </div>
                <?php } } ?>



        </div>
    </div>
</div><!-- .row END -->