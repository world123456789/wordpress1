<?php

if (!defined('ABSPATH'))
    die('Direct access forbidden.');
/**
 * Include static files: javascript and css for backend
 */
wp_enqueue_style('xs-admin', SEOCIFY_CSS . '/xs_admin.css', null, SEOCIFY_VERSION);
wp_enqueue_style( 'themify-icons', SEOCIFY_CSS . '/iconfont.css', null, SEOCIFY_VERSION );


wp_enqueue_script('xs-admin', SEOCIFY_SCRIPTS . '/xs_admin.js', null, SEOCIFY_VERSION);