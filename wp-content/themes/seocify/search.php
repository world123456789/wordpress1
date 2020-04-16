<?php
/**
 * search.php
 *
 * The template for displaying search results.
 */
get_header();
get_template_part( 'template-parts/header/content', 'search-header' );
$sidebar = seocify_option('blog_sidebar');
$column = ($sidebar == 1 ) ? 'col-md-12' : 'col-md-8';
?>
<div class="blog xs-section-padding" role="main">
    <div class="main-content">
        <div class="container">
            <div class="row">
                <?php
                if($sidebar == 2){
                    get_sidebar();
                }
                ?>
                <div class="<?php echo esc_attr($column); ?>">
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/post/content', get_post_format() );
                        endwhile;
                        seocify_paging_nav();
                    else :
                        get_template_part( 'template-parts/post/content', 'none' );
                    endif;
                    ?>
                </div> <!-- end main-content -->

                <?php
                if($sidebar == 3){
                    get_sidebar();
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>