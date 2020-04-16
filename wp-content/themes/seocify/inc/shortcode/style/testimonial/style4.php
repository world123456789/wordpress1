<div class="xs-seocify-testimonial-10 owl-carousel xs-seocify-testimonial-preview" data-nagivation="<?php echo esc_attr($seocify_hide_navigation); ?>">
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