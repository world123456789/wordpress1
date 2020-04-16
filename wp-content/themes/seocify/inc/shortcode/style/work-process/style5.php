<div class="workprocess-tab-area white-v">
    <ul class="nav nav-tabs workprocess-tab-style-5 modern-style" id="myTab2" role="tablist">
        <?php foreach($work_process_items as $key => $work_process_item):
            $active = ($key == 0) ? 'active' : '';
            $id_int = 'workprocess-id2-' . substr($this->get_id_int(), 0, 3);
            if(!empty($work_process_item['image']['id'])){
                $alt = get_post_meta($work_process_item['image']['id'], '_wp_attachment_image_alt', true);
                if(!empty($alt)) {
                    $alt = $alt;
                }else{
                    $alt = get_the_title($work_process_item['image']['id']);
                }
            } ?>
            <li class="nav-item text-center">
                <a class="nav-link <?php echo esc_attr($active) ?>" id="<?php echo esc_attr($id_int . '-' . $key); ?>-tab" data-toggle="tab" href="#<?php echo esc_attr($id_int . '-' . $key); ?>" role="tab"
                   aria-controls="<?php echo esc_attr($id_int . '-' . $key); ?>" aria-selected="true">
                    <span class="tab-icon d-block">
                        <img src="<?php echo esc_url($work_process_item['image']['url']);?>" alt="<?php echo esc_attr($alt); ?>">
                    </span>
                    <h3 class="title"><?php echo esc_html($work_process_item['title']);?></h3>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content" id="myTabContent2">
        <?php foreach($work_process_items as $key => $work_process_item):
            $active = ($key == 0) ? 'active show' : '';?>
            <div class="tab-pane fade text-center <?php echo esc_attr($active) ?>" id="<?php echo esc_attr($id_int . '-' . $key); ?>" role="<?php echo esc_attr($id_int . '-' . $key); ?>" aria-labelledby="planing-tab">
                <p><?php echo wp_kses_post($work_process_item['description']);?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>