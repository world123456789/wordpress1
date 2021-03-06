<?php if($carousel == 'yes'){ ?>
    <div class="case_study_3_item">
        <div class="single-case-studies single-cases-card text-center wow fadeInUp" data-wow-duration="1.2s">
            <?php
            if (has_post_thumbnail()):
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($xs_query->ID), 'full');
                $img = $img[0];
                ?>
                <div class="image card-image">
                    <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute($xs_query->ID); ?>">
                </div>
            <?php endif;
            if($seocify_hide_content_area == 'yes') :
                ?>
                <div class="case-body text-left cases-content">
                    <?php $categories = get_the_terms( get_the_ID(), 'case_study_cat' );
                    $tags = array();
                    foreach($categories as $category){
                        $tags[] = $category->name;
                    }
                    $tags_str = implode(', ', $tags);
                    ?>
                    <p class="tag"><?php echo esc_html($tags_str);?></p>
                    <h4 class="small"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p class="seocify-case-study-custom-link"><a  href="<?php echo esc_url(the_permalink()); ?>"><i class="icon icon-plus
"></i></a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php }else{ ?>
    <div class="<?php if($filter == 'yes'){ echo 'cases-grid-item'.' '.esc_attr($case_terms); }else{ echo ' col-md-6 col-lg-'.esc_attr($count_col);} ?>">
        <div class="single-case-studies single-cases-card text-center wow fadeInUp" data-wow-duration="1.2s">
            <?php
            if (has_post_thumbnail()):
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($xs_query->ID), 'full');
                $img = $img[0];
                ?>
                <div class="image card-image">
                    <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute($xs_query->ID); ?>">
                </div>
            <?php endif;
            if($seocify_hide_content_area == 'yes') :
                ?>
                <div class="case-body text-left cases-content">
                    <?php $categories = get_the_terms( get_the_ID(), 'case_study_cat' );
                    $tags = array();
                    foreach($categories as $category){
                        $tags[] = $category->name;
                    }
                    $tags_str = implode(', ', $tags);
                    ?>
                    <p class="tag"><?php echo esc_html($tags_str);?></p>
                    <h4 class="small"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p class="seocify-case-study-custom-link"><a  href="<?php echo esc_url(the_permalink()); ?>"><i class="icon icon-plus
"></i></a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php } ?>
