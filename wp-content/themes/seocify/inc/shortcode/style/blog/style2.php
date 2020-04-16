<div class="col-md-6 col-lg-<?php echo esc_attr( $count_col ); ?> recent-post">
    <div class="single-blog-post-thumb post-style-2">
        <?php
        if ( has_post_thumbnail() ):
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
                    <span class="meta-date"><i class="fa fa-circle"></i> <?php echo get_the_date(); ?></span>
                </div>

                <h4 class="entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="entry-content">
                    <a href="<?php echo esc_url(the_permalink()); ?>">
                        <i class="icon icon-plus"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>