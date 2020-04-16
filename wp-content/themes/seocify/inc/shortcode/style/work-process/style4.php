<div class="work-process-style4">
    <div class="owl-carousel owl-theme xs-workprocess-slider workprocess-sync2">

        <?php if(!empty($work_process_items)) :
            $i = 1;
            foreach ($work_process_items as $item) : ?>

                <div class="item <?php echo esc_attr( $i== 1 ? 'xs-selected' : ''); ?>">
                    <p><?php echo esc_html($item['socify_work_process_yes']); ?></p>

                    <?php if ( 'yes' == $seocify_workporeess_shadow_text ): ?>
                        <span class="xs-workprocess-water-mark"><?php echo esc_html($item['socify_work_process_yes']); ?></span>
                    <?php endif; ?>
                </div>

                <?php $i++; endforeach; endif; ?>

    </div>

    <div class="owl-carousel owl-theme xs-workprocess-posts workprocess-sync1">
        <?php if(!empty($work_process_items)) :
            $i = 1;
            foreach ($work_process_items as $item) :?>

                <div class="item">
                    <h3><?php echo esc_html($item['title']); ?></h3>
                    <p><?php echo esc_html($item['description']); ?></p>
                </div>

            <?php endforeach; endif; ?>
    </div>
</div>