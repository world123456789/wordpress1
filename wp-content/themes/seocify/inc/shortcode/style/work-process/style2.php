<div class="workprocess-tab-area white-v">
    <ul class="nav nav-tabs workprocess-tab" id="myTab" role="tablist">
        
        <?php foreach($work_process_items as $key => $work_process_item):
            $active = ($key == 0) ? 'active' : '';
            $id_int = 'workprocess-id-' . substr($this->get_id_int(), 0, 3);
            if(!empty($work_process_item['image']['id'])){
                $alt = get_post_meta($work_process_item['image']['id'], '_wp_attachment_image_alt', true);
                if(!empty($alt)) {
                    $alt = $alt;
                }else{
                    $alt = get_the_title($work_process_item['image']['id']);
                }
            } ?>
            <li class="nav-item">
                <a class="nav-link <?php echo esc_attr($active) ?>" id="<?php echo esc_attr($id_int . '-' . $key); ?>-tab" data-toggle="tab" href="#<?php echo esc_attr($id_int . '-' . $key); ?>" role="tab"
                    aria-controls="<?php echo esc_attr($id_int . '-' . $key); ?>" aria-selected="true">
                    <img src="<?php echo esc_url($work_process_item['image']['url']);?>" alt="<?php echo esc_attr($alt); ?>"><span class="title"><?php echo esc_html($work_process_item['title']);?></span>
                    <span class="pin"></span>
                    <span class="glow-pin"></span>
                </a>
            </li>

        <?php endforeach; ?>
        <div class="glow-line"></div>
    </ul>
    <div class="tab-content" id="myTabContent">
        <?php foreach($work_process_items as $key => $work_process_item): 
            $active = ($key == 0) ? 'active show' : '';?>
            <div class="tab-pane fade text-center <?php echo esc_attr($active) ?>" id="<?php echo esc_attr($id_int . '-' . $key); ?>" role="<?php echo esc_attr($id_int . '-' . $key); ?>" aria-labelledby="planing-tab">
                <p><?php echo wp_kses_post($work_process_item['description']);?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
