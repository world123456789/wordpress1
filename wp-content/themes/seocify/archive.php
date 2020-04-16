<?php
/**
 * archive.php
 *
 * The template for displaying archive pages.
 */
?>

<?php get_header();

get_template_part( 'template-parts/header/content', 'blog-header' );
$sidebar = seocify_option('blog_sidebar');
$blog_style = seocify_option('blog_style');
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