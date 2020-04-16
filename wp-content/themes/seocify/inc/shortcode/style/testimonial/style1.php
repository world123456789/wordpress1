<div class="testimonial-slider-preview owl-carousel" id="sync1">

    <?php if (!empty($testimonials)):

        foreach ($testimonials as $testimonial):

        if ($testimonial['image'] != '') {
            if( defined( 'FW' ) ):
                $img = fw_resize( $testimonial['image']['url'], 355, 195, true );
            else:
                $img = $testimonial['image']['url'];
            endif;
        }
        ?>
        <div class="single-testimonial-preview">
            <?php if (!empty($testimonial['review'])) : ?>
                <p>“ <?php echo esc_html($testimonial['review']); ?> ”</p>
            <?php endif; ?>
            <span class="border-line"></span>
        </div>
        <?php endforeach;
    endif; ?>
</div>
<div class="testimonial-slider-thumb owl-carousel" id="sync2">

    <?php if (!empty($testimonials)):

        foreach ($testimonials as $testimonial):

            if ($testimonial['image'] != '') {
                $img = $testimonial['image']['url'];
            }
            ?>

            <div class="single-bio-thumb">
                
                <?php if (!empty($img)): ?>
                    <div class="bio-image">
                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo seocify_get_alt_name($testimonial['image']['id']); ?>">
                    </div>
                <?php endif; ?>
                <div class="bio-info">
                    <h4 class="small"><?php echo esc_html($testimonial['client_name']); ?></h4>
                    <p><?php echo esc_html($testimonial['designation']); ?></p>
                </div>
            </div>
        <?php endforeach;
    endif; ?>
</div>
<?php if($show_watermark == 'yes'): ?>
    <div class="big-watermark-icon <?php if($watermark_style == 'small'){ echo 'small-version'; }?>">
        <i class="icon icon-quote"></i>
    </div>
<?php endif; ?>