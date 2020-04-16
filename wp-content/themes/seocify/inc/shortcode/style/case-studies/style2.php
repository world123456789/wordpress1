<?php if($carousel == 'yes'){ ?>
    <div class="case-study-slider-item">
        <div class="single-case-studies text-center wow fadeInUp" data-wow-duration="1.2s">
            
            <?php
                if (has_post_thumbnail()):
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($xs_query->ID), 'full');
                $img = $img[0];

            ?>
            
            <div class="image">
                <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute($xs_query->ID); ?>">
            </div>
            <?php endif;?>
            <div class="case-body">
                <h4 class="small"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                
                <?php $categories = get_the_terms( get_the_ID(), 'case_study_cat' ); 

                $tags = array();
                foreach($categories as $category){
                    $tags[] = $category->name;
                }
                $tags_str = implode(', ', $tags);
                ?>
                <p><?php echo esc_html($tags_str);?></p>
            </div>
        </div>
    </div>
<?php }else{ ?>
<div class="<?php if($filter == 'yes'){ echo 'cases-grid-item'.' '.esc_attr($case_terms); }else{ echo ' col-md-6 col-lg-'.esc_attr($count_col);} ?>">
    <div class="single-case-studies text-center wow fadeInUp" data-wow-duration="1.2s">
        
        <?php
                if (has_post_thumbnail()):
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($xs_query->ID), 'full');
                $img = $img[0];

            ?>
            
            <div class="image">
                <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute($xs_query->ID); ?>">
            </div>
        <?php endif;?>
        <div class="case-body">
            <h4 class="small"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
            
            <?php $categories = get_the_terms( get_the_ID(), 'case_study_cat' ); 

            $tags = array();
            foreach($categories as $category){
               $tags[] = $category->name;
            }
            $tags_str = implode(', ', $tags);
            ?>
            <p><?php echo esc_html($tags_str);?></p>
        </div>
    </div>

</div>
<?php } ?>