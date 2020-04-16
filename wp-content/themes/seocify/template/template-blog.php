<?php
/**
 * template-blank.php
 *
 * Template Name:  Blog Template
 */
get_header();

get_template_part( 'template-parts/header/content', 'blog-header' );
$blog_style = seocify_option('blog_style');
$sidebar = seocify_option('blog_sidebar');
$column = ($sidebar == 1 ) ? 'col-md-12' : 'col-md-8';
if($blog_style == '1'):
?>
<section class="xs-section-padding">
    <div class="container">
        <div class="row">
        <?php
            if($sidebar == 2){
                get_sidebar();
            }
            ?>
            <div class="<?php echo esc_attr($column); ?>">
                <div class="blog-post-lists">
				<?php
				global $paged, $wp_query, $wp;

				if ( empty( $paged ) ) {
					if ( !empty( $_GET[ 'paged' ] ) ) {
						$paged = $_GET[ 'paged' ];
					} elseif ( !empty( $wp->matched_query ) && $args = wp_parse_args( $wp->matched_query ) ) {

						if ( !empty( $args[ 'paged' ] ) ) {
							$paged = $args[ 'paged' ];
						}
					}
					if ( !empty( $paged ) )
						$wp_query->set( 'paged', $paged );
				}
				$temp		 = $wp_query;
				$wp_query	 = null;
 
				$wp_query = new WP_Query();
				$wp_query->query( "post_type=post&paged=" . $paged ); ?>
                    <!-- 1st post start -->
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                    <?php endwhile; ?>
                        <?php seocify_paging_nav(); ?>
                    <?php else : ?>
                        <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                    <?php endif; ?>

                </div>
            </div><!-- Content Col end -->

            <?php
            if($sidebar == 3){
                get_sidebar();
            }
            ?>
        </div><!-- Main row end -->

    </div><!-- Container end -->
</section><!-- Main container end -->
<?php else: ?>
<section class="xs-section-padding blog-grid-sidebar-area">
    <div class="container">
        <div class="row">
            <?php
            if($sidebar == 2){
                get_sidebar();
            } 
            ?>
            <div class="<?php echo esc_attr($column); ?>">
                <div class="row blog-inner-page blog-grid">
				<?php
				global $paged, $wp_query, $wp;

				if ( empty( $paged ) ) {
					if ( !empty( $_GET[ 'paged' ] ) ) {
						$paged = $_GET[ 'paged' ];
					} elseif ( !empty( $wp->matched_query ) && $args = wp_parse_args( $wp->matched_query ) ) {

						if ( !empty( $args[ 'paged' ] ) ) {
							$paged = $args[ 'paged' ];
						}
					}
					if ( !empty( $paged ) )
						$wp_query->set( 'paged', $paged );
				}
				$temp		 = $wp_query;
				$wp_query	 = null; 
 
				$wp_query = new WP_Query();
				$wp_query->query( "post_type=post&paged=" . $paged ); ?>
                    <!-- 1st post start -->
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                    <?php endwhile; ?>
                        
                    <?php else : ?>
                        <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                    <?php endif; ?>

                </div>
                <?php seocify_paging_nav(); ?>
            </div><!-- Content Col end -->
            
            <?php
            if($sidebar == 3){
                get_sidebar();
            }
            ?>
        </div><!-- Main row end -->

    </div><!-- Container end -->
</section><!-- Main container end -->
<?php endif; ?>
<?php get_footer(); ?>