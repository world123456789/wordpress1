<div class="row no-gutters working-process-group"><?php
    foreach($work_process_items as $work_process_item):

        if(!empty($work_process_item['image']['id'])){
            $alt = get_post_meta($work_process_item['image']['id'], '_wp_attachment_image_alt', true);
            if(!empty($alt)) {
                $alt = $alt;
            }else{
                $alt = get_the_title($work_process_item['image']['id']);
            }
        } 
    ?>
        <div class="col-lg-3 col-md-6">
            <div class="single-work-process">
                <div class="work-process-icon">
                    <img src="<?php echo esc_url($work_process_item['image']['url']);?>" alt="<?php echo esc_attr($alt); ?>" draggable="false">
                </div>
                <h4 class="small"><?php echo esc_html($work_process_item['title']);?></h4>
            </div>
        </div>
    <?php
    endforeach; 
?></div>