<?php

if (!defined('ABSPATH'))
    die('Direct access forbidden.');

function seocify_action_theme_include_custom_option_types() {
    if (is_admin()) {
        $dir = SEOCIFY_INC . '/includes';
        require_once $dir . '/option-types/new-icon/class-fw-option-type-new-icon.php';
        require_once $dir . '/option-types/fw-multi-inline/class-fw-option-type-fw-multi-inline.php';
        // and all other option types
    }
}

add_action('fw_option_types_init', 'seocify_action_theme_include_custom_option_types');
load_template( get_template_directory().'/inc/includes/sub-includes/auto-setup/class-fw-auto-install.php', true );