<div class="xs-heading style5 <?php echo esc_attr('text-'.$title_align); ?>">
    <?php if(!empty($sub_title)): ?>
        <h3 class="section-subtitle"><?php echo esc_html( $sub_title ); ?></h3>
    <?php endif; ?>
    <?php if(!empty($title)): ?>
        <h2 class="section-title"><?php echo seocify_kses(sprintf($title, '<span>', '</span>' ) ); ?></h2>
    <?php endif; ?>
    <?php if($xs_separator == 'yes'): ?>
        <span class="line"></span>
    <?php endif; ?>
</div>