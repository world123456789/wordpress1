<?php $nav_lang_display = seocify_option('nav_lang');

if($nav_lang_display) :
?>
<div class="zoom-anim-dialog mfp-hide modal-language" id="modal-popup-wpml">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="language-content">
                <p><?php esc_html_e('Switch The Language','seocify');?></p>      
                <?php if (class_exists('SitePress')): ?>
                    <?php seocify_languages_list_popup(); ?>
                <?php else: ?>
                    <ul class="flag-lists">
                        <li><a href="#"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/flags/006-united-states.svg" alt="<?php esc_attr_e('English','seocify');?>"><span><?php esc_html_e('English','seocify');?></span></a></li>
                        <li><a href="#"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/flags/002-canada.svg" alt="<?php esc_attr_e('English','seocify');?>"><span><?php esc_html_e('English','seocify');?></span></a></li>
                        <li><a href="#"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/flags/003-vietnam.svg" alt="<?php esc_attr_e('Vietnamese','seocify');?>"><span><?php esc_html_e('Vietnamese','seocify');?></span></a></li>
                        <li><a href="#"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/flags/004-france.svg" alt="<?php esc_attr_e('French','seocify');?>"><span><?php esc_html_e('French','seocify');?></span></a></li>
                        <li><a href="#"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/flags/005-germany.svg" alt="<?php esc_attr_e('German','seocify');?>"><span><?php esc_html_e('German','seocify');?></span></a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>