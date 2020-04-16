<div class="col-md-6 col-lg-<?php echo esc_attr( $count_col ); ?> recent-post">
    <div class="single-blog-post-thumb post-style-3">
        <?php
        if ( has_post_thumbnail()) :
            $img = wp_get_attachment_image_src( get_post_thumbnail_id( $xs_query->ID ), 'full' );
            $img = $img[ 0 ];
            ?>
            <div class="post-image">
                <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute( $xs_query->ID ); ?>">
            </div>
        <?php endif; ?>
        <div class="post-body">
            <div class="entry-header">

                <div class="entry-meta">
                    <span class="meta-date"><i class="icon icon-calendar-1"></i> <?php echo get_the_date(); ?></span>
                    <?php
                    $category_list = get_the_category_list( ', ' );
                    if ( $category_list ) {
                        echo '<span class="post-cat"><i class="icon icon-folders"></i>   ' . $category_list . ' </span>';
                    }
                    ?>
                </div>

                <h4 class="entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="entry-content">
                    <div class="seocify-author">
                      <span class="author-img">
                          <?php echo get_avatar( get_the_author_meta( "ID" ), 25 ); ?>
                      </span>
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="seocify-author-name"><?php the_author_meta('display_name'); ?></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>