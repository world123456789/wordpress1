<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */

get_header();

get_template_part( 'template-parts/header/content', 'single-header' );
$sidebar = seocify_option('blog_sidebar');
$column = ($sidebar == 1  || !is_active_sidebar( 'sidebar-1' )) ? 'col-md-12' : 'col-md-8 col-sm-12';
?>
  
 <section class="xs-section-padding blog-single-post-section">
    <div class="container">
        <div class="row">
            <?php if($sidebar == 2){
                get_sidebar();
            } ?>
            <div class="<?php echo esc_attr($column); ?>">
                <div class="blog-post-group">
                    <?php 
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', 'single' );

                        seocify_post_nav();

                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile;
                    ?>
				</div>
            </div>
            <?php if($sidebar == 3){
                get_sidebar();
            } ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>