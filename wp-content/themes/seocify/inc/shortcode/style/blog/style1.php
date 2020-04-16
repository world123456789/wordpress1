<div class="col-md-6 col-lg-<?php echo esc_attr( $count_col ); ?> recent-post">
    <div class="single-blog-post-thumb">
        <?php
        if( has_post_thumbnail() ):
            $img = wp_get_attachment_image_src( get_post_thumbnail_id( $xs_query->ID ), 'full' );
            if( defined( 'FW' ) ):
                $img = fw_resize( $img[ 0 ], 355, 195, true );
            else:
                $img = $img[ 0 ];
            endif;
            ?>
            <div class="post-image">
                <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute( $xs_query->ID ); ?>">
            </div>
        <?php endif; ?>
        <div class="post-body">
            <div class="entry-header">
                <?php if( $meta_pos != 'yes' ) : ?>
                    <div class="entry-meta">
                        <span class="meta-date"><i class="icon icon-clock"></i> <?php echo get_the_date(); ?></span>
                        <?php
                        $category_list = get_the_category_list( ', ' );
                        if( $category_list ){
                            echo '<span class="post-cat"><i class="icon icon-folders"></i>   '.$category_list.' </span>';
                        }
                        ?>
                    </div>
                <?php endif; ?>
                <h4 class="entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="entry-content">
                    <?php seocify_content_read_more( '12', false ); ?>
                </div>
                <?php if( $meta_pos == 'yes' ) : ?>
                    <div class="entry-meta">
                        <span class="meta-date"><i class="icon icon-clock"></i> <?php echo get_the_date(); ?></span>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>