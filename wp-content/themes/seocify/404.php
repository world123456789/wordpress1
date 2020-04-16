<?php
/**
 * 404.php
 *
 * The template for displaying 404 pages (Not Found).
 */
?>

<?php 
get_header();
get_template_part( 'template-parts/header/content', '404-header' );

    $title	 = html_entity_decode(seocify_option( 'error_title' ));
    $subtitle	 = html_entity_decode(seocify_option( 'error_subtitle' ));
    $back_to_home_label	 = seocify_option('back_to_home_label' );
    $logo	 = seocify_option('error_logo' );

?>
<section class="xs-section-padding" data-scrollax-parent="true">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center">
                <div class="content-404">
                    <h2 class="title-404"><?php echo seocify_kses(sprintf($title, '<span>', '</span>' ) ); ?></h2>
                    <p><?php echo seocify_kses(sprintf($subtitle, '<span>', '</span>' ) ); ?></p>
                    <a href="<?php echo esc_url(home_url('/'));?>" class="btn btn-primary"><?php echo esc_html($back_to_home_label);?></a>
                </div>
            </div>
            <div class="col-lg-8 mx-auto text-center">
            <?php if($logo != ''):?>
                <div class="img-404">
                    <img src="<?php echo esc_url($logo);?>" data-scrollax="properties: { translateY: '-50%' }" alt="<?php esc_attr_e('404-logo','seocify');?>">
                </div>
            <?php endif; ?>


                
            </div>
        </div><!-- .row END -->
    </div><!-- .container END -->
</section><!-- end 404 section -->
<?php get_footer(); ?>