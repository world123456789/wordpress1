<?php

use ElementPack\Base\Element_Pack_Base;
use ElementPack\Notices;
use Elementor\Settings;
use ElementPack\Classes\Utils;


/**
 * Element Pack Admin Settings Class 
 */
class ElementPack_Admin_Settings {

    const PAGE_ID = 'element_pack_options';

    private $settings_api;

    public $slug="element_pack_options";

    function __construct() {
        $this->settings_api = new ElementPack_Settings_API;

        
        add_action( 'admin_init', [ $this, 'admin_init' ] );
        add_action( 'admin_menu', [ $this, 'admin_menu' ], 201 );
        
        update_option("element_pack_license_key","") || add_option("element_pack_license_key","");
        add_action( 'admin_post_element_pack_activate_license', [ $this, 'action_activate_license' ] );
	    
        
    }

    public static function get_url() {
        return admin_url( 'admin.php?page=' . self::PAGE_ID );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->element_pack_admin_settings() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_menu_page(
            BDTEP_TITLE .' ' . esc_html__( 'Dashboard', 'bdthemes-element-pack' ),
            BDTEP_TITLE,
            'manage_options',
            self::PAGE_ID,
            [ $this, 'plugin_page'],
            $this->element_pack_icon(),
            58.5
        );

        add_submenu_page(
            self::PAGE_ID,
            BDTEP_TITLE,
            esc_html__( 'Core Widgets', 'bdthemes-element-pack' ),
            'manage_options',
            self::PAGE_ID .'#element_pack_active_modules',
            [ $this, 'display_page' ]
        );

        add_submenu_page(
            self::PAGE_ID,
            BDTEP_TITLE,
            esc_html__( '3rd Party Widgets', 'bdthemes-element-pack' ),
            'manage_options',
            self::PAGE_ID .'#element_pack_third_party_widget',
            [ $this, 'display_page' ]
        );

        add_submenu_page(
            self::PAGE_ID,
            BDTEP_TITLE,
            esc_html__( 'Elementor Extend', 'bdthemes-element-pack' ),
            'manage_options',
            self::PAGE_ID .'#element_pack_elementor_extend',
            [ $this, 'display_page' ]
        );

        add_submenu_page(
            self::PAGE_ID,
            BDTEP_TITLE,
            esc_html__( 'API Settings', 'bdthemes-element-pack' ),
            'manage_options',
            self::PAGE_ID .'#element_pack_api_settings',
            [ $this, 'display_page' ]
        );

        add_submenu_page(
            self::PAGE_ID,
            BDTEP_TITLE,
            esc_html__( 'Get Pro', 'bdthemes-element-pack' ),
            'manage_options',
            self::PAGE_ID . '#go_pro',
            [ $this, 'display_page' ]
        );
    }

    function element_pack_icon() {
        return 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMy4wLjIsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHdpZHRoPSIyMzAuN3B4IiBoZWlnaHQ9IjI1NC44MXB4IiB2aWV3Qm94PSIwIDAgMjMwLjcgMjU0LjgxIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAyMzAuNyAyNTQuODE7Ig0KCSB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQoJLnN0MHtmaWxsOiNGRkZGRkY7fQ0KPC9zdHlsZT4NCjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik02MS4wOSwyMjkuMThIMjguOTVjLTMuMTcsMC01Ljc1LTIuNTctNS43NS01Ljc1bDAtMTkyLjA3YzAtMy4xNywyLjU3LTUuNzUsNS43NS01Ljc1aDMyLjE0DQoJYzMuMTcsMCw1Ljc1LDIuNTcsNS43NSw1Ljc1djE5Mi4wN0M2Ni44MywyMjYuNjEsNjQuMjYsMjI5LjE4LDYxLjA5LDIyOS4xOHoiLz4NCjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0yMDcuNSwzMS4zN3YzMi4xNGMwLDMuMTctMi41Nyw1Ljc1LTUuNzUsNS43NUg5MC4wNGMtMy4xNywwLTUuNzUtMi41Ny01Ljc1LTUuNzVWMzEuMzcNCgljMC0zLjE3LDIuNTctNS43NSw1Ljc1LTUuNzVoMTExLjcyQzIwNC45MywyNS42MiwyMDcuNSwyOC4yLDIwNy41LDMxLjM3eiIvPg0KPHBhdGggY2xhc3M9InN0MCIgZD0iTTIwNy41LDExMS4zM3YzMi4xNGMwLDMuMTctMi41Nyw1Ljc1LTUuNzUsNS43NUg5MC4wNGMtMy4xNywwLTUuNzUtMi41Ny01Ljc1LTUuNzV2LTMyLjE0DQoJYzAtMy4xNywyLjU3LTUuNzUsNS43NS01Ljc1aDExMS43MkMyMDQuOTMsMTA1LjU5LDIwNy41LDEwOC4xNiwyMDcuNSwxMTEuMzN6Ii8+DQo8cGF0aCBjbGFzcz0ic3QwIiBkPSJNMjA3LjUsMTkxLjN2MzIuMTRjMCwzLjE3LTIuNTcsNS43NS01Ljc1LDUuNzVIOTAuMDRjLTMuMTcsMC01Ljc1LTIuNTctNS43NS01Ljc1VjE5MS4zDQoJYzAtMy4xNywyLjU3LTUuNzUsNS43NS01Ljc1aDExMS43MkMyMDQuOTMsMTg1LjU1LDIwNy41LDE4OC4xMywyMDcuNSwxOTEuM3oiLz4NCjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0xNjkuNjIsMjUuNjJoMzIuMTRjMy4xNywwLDUuNzUsMi41Nyw1Ljc1LDUuNzV2MTEyLjFjMCwzLjE3LTIuNTcsNS43NS01Ljc1LDUuNzVoLTMyLjE0DQoJYy0zLjE3LDAtNS43NS0yLjU3LTUuNzUtNS43NVYzMS4zN0MxNjMuODcsMjguMiwxNjYuNDQsMjUuNjIsMTY5LjYyLDI1LjYyeiIvPg0KPC9zdmc+DQo=';
    }

    function get_settings_sections() {
        $sections = [
            [
                'id'    => 'element_pack_active_modules',
                'title' => esc_html__( 'Core Widgets', 'bdthemes-element-pack' )
            ],
            [
                'id'    => 'element_pack_third_party_widget',
                'title' => esc_html__( '3rd Party Widgets', 'bdthemes-element-pack' )
            ],
            [
                'id'    => 'element_pack_elementor_extend',
                'title' => esc_html__( 'Elementor Extend', 'bdthemes-element-pack' )
            ],
            [
                'id'    => 'element_pack_api_settings',
                'title' => esc_html__( 'API Settings', 'bdthemes-element-pack' ),
            ],
        ];
        return $sections;
    }

    protected function element_pack_admin_settings() {
        $settings_fields = [
            'element_pack_active_modules' => [
                [
                    'name'         => 'accordion',
                    'label'        => esc_html__( 'Accordion', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/accordion/',
                    'video_url'    => 'https://youtu.be/DP3XNV1FEk0',
                    
                ],
                [
                    'name'         => 'advanced-button',
                    'label'        => esc_html__( 'Advanced Button', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/advanced-button/',
                    'video_url'    => 'https://youtu.be/Lq_st2IWZiE',
                ],
                [
                    'name'         => 'advanced-counter',
                    'label'        => esc_html__( 'Advanced Counter', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/advanced-counter/',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'advanced-gmap',
                    'label'        => esc_html__( 'Advanced Google Map', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/advanced-google-map/',
                    'video_url'    => 'https://youtu.be/Lq_st2IWZiE',
                ],
                [
                    'name'         => 'advanced-heading',
                    'label'        => esc_html__( 'Advanced Heading', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/advanced-heading/',
                    'video_url'    => 'https://youtu.be/E1jYInKYTR0',
                ],
                [
                    'name'         => 'advanced-icon-box',
                    'label'        => esc_html__( 'Advanced Icon Box', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/advanced-icon-box/',
                    'video_url'    => 'https://youtu.be/IU4s5Cc6CUA',
                ],
                [
                    'name'         => 'advanced-image-gallery',
                    'label'        => esc_html__( 'Advanced Image Gallery', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom gallery',
                    'demo_url'     => 'https://elementpack.pro/demo/element/advanced-image-gallery/',
                    'video_url'    => 'https://youtu.be/se7BovYbDok',
                ],
                [
                    'name'         => 'advanced-progress-bar',
                    'label'        => esc_html__( 'Advanced Progress Bar', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/advanced-progress-bar/',
                    'video_url'    => 'https://youtu.be/7hnmMdd2-Yo',
                ],
                [
                    'name'         => 'animated-heading',
                    'label'        => esc_html__( 'Animated Heading', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/animated-heading/',
                    'video_url'    => 'https://youtu.be/xypAmQodUYA',
                ],
                [
                    'name'         => 'audio-player',
                    'label'        => esc_html__( 'Audio Player', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/advanced-google-map/',
                    'video_url'    => 'https://youtu.be/VHAEO1xLVxU',
                ],
                [
                    'name'         => 'business-hours',
                    'label'        => esc_html__( 'Business Hours', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/business-hours',
                    'video_url'    => 'https://youtu.be/1QfZ-os75rQ',
                ],
                [
                    'name'         => 'dual-button',
                    'label'        => esc_html__( 'Dual Button', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/dual-button/',
                    'video_url'    => 'https://youtu.be/7hWWqHEr6s8',
                ],
                [
                    'name'         => 'chart',
                    'label'        => esc_html__( 'Chart', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/charts',
                    'video_url'    => 'https://youtu.be/-1WVTzTyti0',
                ],
                [
                    'name'         => 'call-out',
                    'label'        => esc_html__( 'Call Out', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/call-out/',
                    'video_url'    => 'https://youtu.be/1tNppRHvSvQ',
                ],
                [
                    'name'         => 'carousel',
                    'label'        => esc_html__( 'Carousel', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post carousel',
                    'demo_url'     => 'https://elementpack.pro/demo/element/carousel',
                    'video_url'    => 'https://youtu.be/TMwdfYDmTQo',
                ],
                [
                    'name'         => 'changelog',
                    'label'        => esc_html__( 'Changelog', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/changelog',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'circle-menu',
                    'label'        => esc_html__( 'Circle Menu', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/circle-menu/',
                    'video_url'    => 'https://www.youtube.com/watch?v=rfW22T-U7Ag',
                ],
                [
                    'name'         => 'circle-info',
                    'label'        => esc_html__( 'Circle Info', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/circle-info/',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'cookie-consent',
                    'label'        => esc_html__( 'Cookie Consent', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/cookie-consent/',
                    'video_url'    => 'https://youtu.be/BR4t5ngDzqM',
                ],
                [
                    'name'         => 'countdown',
                    'label'        => esc_html__( 'Countdown', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/event-calendar-countdown',
                    'video_url'    => 'https://youtu.be/oxqHEDyzvIM',
                ],
                [
                    'name'         => 'contact-form',
                    'label'        => esc_html__( 'Simple Contact Form', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/simple-contact-form/',
                    'video_url'    => 'https://youtu.be/faIeyW7LOJ8',
                ],
                [
                    'name'         => 'comment',
                    'label'        => esc_html__( 'Comment', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/comment/',
                    'video_url'    => 'https://youtu.be/csvMTyUx7Hs',
                ],
                [
                    'name'         => 'crypto-currency-card',
                    'label'        => esc_html__( 'Crypto Currency Card', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/crypto-currency-card/',
                    'video_url'    => 'https://youtu.be/F13YPkFkLso',
                ],
                [
                    'name'         => 'crypto-currency-table',
                    'label'        => esc_html__( 'Crypto Currency Table', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/crypto-currency-table/',
                    'video_url'    => 'https://youtu.be/F13YPkFkLso',
                ],
                [
                    'name'         => 'custom-gallery',
                    'label'        => esc_html__( 'Custom Gallery', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'custom gallery',
                    'demo_url'     => 'https://elementpack.pro/demo/element/custom-gallery/',
                    'video_url'    => 'https://youtu.be/2fAF8Rt7FbQ',
                ],
                [
                    'name'         => 'custom-carousel',
                    'label'        => esc_html__( 'Custom Carousel', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom carousel',
                    'demo_url'     => 'https://elementpack.pro/demo/element/custom-carousel/',
                    'video_url'    => 'https://youtu.be/TMwdfYDmTQo',
                ],
                [
                    'name'         => 'document-viewer',
                    'label'        => esc_html__( 'Document Viewer', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/document-viewer',
                    'video_url'    => 'https://www.youtube.com/watch?v=8Ar9NQe93vg',
                ],
                [
                    'name'         => 'device-slider',
                    'label'        => esc_html__( 'Device Slider', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom slider',
                    'demo_url'     => 'https://elementpack.pro/demo/element/device-slider/',
                    'video_url'    => 'https://youtu.be/GACXtqun5Og',
                ],
                [
                    'name'         => 'dropbar',
                    'label'        => esc_html__( 'Dropbar', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/dropbar/',
                    'video_url'    => 'https://youtu.be/cXMq8nOCdqk',
                ],
                [
                    'name'         => 'flip-box',
                    'label'        => esc_html__( 'Flip Box', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/flip-box/',
                    'video_url'    => 'https://youtu.be/FLmKzk9KbQg',
                ],
                [
                    'name'         => 'fancy-card',
                    'label'        => esc_html__( 'Fancy Card', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/fancy-card/',
                    'video_url'    => 'https://youtu.be/BXdVB1pLfXE',
                ],
                [
                    'name'         => 'fancy-list',
                    'label'        => esc_html__( 'Fancy List', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/fancy-list/',
                    'video_url'    => 'https://youtu.be/t1_5uys8bto',
                ],
                [
                    'name'         => 'fancy-slider',
                    'label'        => esc_html__( 'Fancy Slider', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/fancy-slider/',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'fancy-tabs',
                    'label'        => esc_html__( 'Fancy Tabs', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/fancy-tabs/',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'google-reviews',
                    'label'        => esc_html__( 'Google Reviews', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'pro',
                    'content_type' => 'slider new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/google-reviews/',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'iconnav',
                    'label'        => esc_html__( 'Icon Nav', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/icon-nav/',
                    'video_url'    => 'https://youtu.be/Q4YY8pf--ig',
                ],
                [
                    'name'         => 'iframe',
                    'label'        => esc_html__( 'Iframe', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/iframe/',
                    'video_url'    => 'https://youtu.be/3ABRMLE_6-I',
                ],
                [
                    'name'         => 'instagram',
                    'label'        => esc_html__( 'Instagram', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others carousel',
                    'demo_url'     => 'https://elementpack.pro/demo/element/instagram-feed/',
                    'video_url'    => 'https://www.youtube.com/watch?v=6bxWo_kSh1A&t=24s',
                ],
                [
                    'name'         => 'image-compare',
                    'label'        => esc_html__( 'Image Compare', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/image-compare/',
                    'video_url'    => 'https://youtu.be/-Kwjlg0Fwk0',
                ],
                [
                    'name'         => 'image-magnifier',
                    'label'        => esc_html__( 'Image Magnifier', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'others new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/image-magnifier/',
                    'video_url'    => 'https://youtu.be/GSy3pLihNPY',
                ],
                [
                    'name'         => 'helpdesk',
                    'label'        => esc_html__( 'Help Desk', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/help-desk/',
                    'video_url'    => 'https://youtu.be/bO__skhy4yk',
                ],
                [
                    'name'         => 'hover-box',
                    'label'        => esc_html__( 'Hover Box', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/hover-box/',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'lightbox',
                    'label'        => esc_html__( 'Lightbox', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/lightbox/',
                    'video_url'    => 'https://youtu.be/1iKQD4HfZG4',
                ],
                [
                    'name'         => 'lottie-image',
                    'label'        => esc_html__( 'Lottie Image', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/lottie-image/',
                    'video_url'    => 'https://youtu.be/CbODBtLTxWc',
                ],
                [
                    'name'         => 'lottie-icon-box',
                    'label'        => esc_html__( 'Lottie Icon Box', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/lottie-icon-box/',
                    'video_url'    => 'https://youtu.be/1jKFSglW6qE',
                ],
                [
                    'name'         => 'logo-grid',
                    'label'        => esc_html__( 'Logo Grid', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/logo-grid/',
                    'video_url'    => 'https://youtu.be/Go1YE3O23J4',
                ],
                [
                    'name'         => 'logo-carousel',
                    'label'        => esc_html__( 'Logo Carousel', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/logo-carousel/',
                    'video_url'    => 'https://youtu.be/xe_SA0ZgAvA',
                ],
                [
                    'name'         => 'modal',
                    'label'        => esc_html__( 'Modal', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/modal/',
                    'video_url'    => 'https://youtu.be/4qRa-eYDGZU',
                ],
                [
                    'name'         => 'mailchimp',
                    'label'        => esc_html__( 'Mailchimp', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/mailchimp/',
                    'video_url'    => 'https://youtu.be/hClaXvxvkXM',
                ],
                [
                    'name'         => 'marker',
                    'label'        => esc_html__( 'Marker', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/marker/',
                    'video_url'    => 'https://youtu.be/1iKQD4HfZG4',
                ],
                [
                    'name'         => 'member',
                    'label'        => esc_html__( 'Member', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/buddypress-member/',
                    'video_url'    => 'https://youtu.be/m8_KOHzssPA',
                ],
                [
                    'name'         => 'navbar',
                    'label'        => esc_html__( 'Navbar', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/navbar/',
                    'video_url'    => 'https://youtu.be/ZXdDAi9tCxE',
                ],
                [
                    'name'         => 'news-ticker',
                    'label'        => esc_html__( 'News Ticker', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://elementpack.pro/demo/element/news-ticker',
                    'video_url'    => 'https://youtu.be/FmpFhNTR7uY',
                ],
                [
                    'name'         => 'offcanvas',
                    'label'        => esc_html__( 'Offcanvas', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/offcanvas/',
                    'video_url'    => 'https://youtu.be/CrrlirVfmQE',
                ],
                [
                    'name'         => 'open-street-map',
                    'label'        => esc_html__( 'Open Street Map', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/open-street-map',
                    'video_url'    => 'https://youtu.be/DCQ5g7yleyk',
                ],
                [
                    'name'         => 'price-list',
                    'label'        => esc_html__( 'Price List', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/price-list/',
                    'video_url'    => 'https://youtu.be/QsXkIYwfXt4',
                ],
                [
                    'name'         => 'price-table',
                    'label'        => esc_html__( 'Price Table', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/pricing-table',
                    'video_url'    => 'https://youtu.be/OWGRjG1mxOM',
                ],
                [
                    'name'         => 'panel-slider',
                    'label'        => esc_html__( 'Panel Slider', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'custom slider',
                    'demo_url'     => 'https://elementpack.pro/demo/element/panel-slider/',
                    'video_url'    => 'https://youtu.be/_piVTeJd0g4',
                ],
                [
                    'name'         => 'post-slider',
                    'label'        => esc_html__( 'Post Slider', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post slider',
                    'demo_url'     => 'https://elementpack.pro/demo/element/post-slider',
                    'video_url'    => 'https://youtu.be/oPYzWVLPF7A',
                ],
                [
                    'name'         => 'post-card',
                    'label'        => esc_html__( 'Post Card', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://elementpack.pro/demo/element/post-card/',
                    'video_url'    => 'https://youtu.be/VKtQCjnEJvE',
                ],
                [
                    'name'         => 'post-block',
                    'label'        => esc_html__( 'Post Block', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://elementpack.pro/demo/element/post-block/',
                    'video_url'    => 'https://youtu.be/bFEyizMaPmw',
                ],
                [
                    'name'         => 'post-block-modern',
                    'label'        => esc_html__( 'Post Block Modern', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://elementpack.pro/demo/element/post-block/',
                    'video_url'    => 'https://youtu.be/bFEyizMaPmw',
                ],
                [
                    'name'         => 'progress-pie',
                    'label'        => esc_html__( 'Progress Pie', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/progress-pie/',
                    'video_url'    => 'https://youtu.be/c5ap86jbCeg',
                ],
                [
                    'name'         => 'post-gallery',
                    'label'        => esc_html__( 'Post Gallery', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post gallery',
                    'demo_url'     => 'https://elementpack.pro/demo/element/post-gallery',
                    'video_url'    => 'https://youtu.be/iScykjTKlNA',
                ],
                [
                    'name'         => 'post-grid',
                    'label'        => esc_html__( 'Post Grid', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://elementpack.pro/demo/element/post%20grid/',
                    'video_url'    => 'https://youtu.be/z3gWwPIsCkg',
                ],
                [
                    'name'         => 'post-grid-tab',
                    'label'        => esc_html__( 'Post Grid Tab', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://elementpack.pro/demo/element/post-grid-tab',
                    'video_url'    => 'https://youtu.be/kFEL4AGnIv4',
                ],
                [
                    'name'         => 'post-list',
                    'label'        => esc_html__( 'Post List', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://elementpack.pro/demo/element/post-list/',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'protected-content',
                    'label'        => esc_html__( 'Protected Content', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/protected-content/',
                    'video_url'    => 'https://youtu.be/jcLWace-JpE',
                ],
                [
                    'name'         => 'qrcode',
                    'label'        => esc_html__( 'QR Code', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/qr-code/',
                    'video_url'    => 'https://youtu.be/3ofLAjpnmO8',
                ],
                [
                    'name'         => 'reading-progress',
                    'label'        => esc_html__( 'Reading Progress', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'pro',
                    'content_type' => 'others new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/reading-progress/',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'slider',
                    'label'        => esc_html__( 'Slider', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'custom slider',
                    'demo_url'     => 'https://elementpack.pro/demo/element/layer-slider/',
                    'video_url'    => 'https://youtu.be/SI4K4zuNOoE',
                ],
                [
                    'name'         => 'slideshow',
                    'label'        => esc_html__( 'Slideshow', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/slideshow/',
                    'video_url'    => 'https://youtu.be/BrrKmDfJ5ZI',
                ],
                [
                    'name'         => 'scrollnav',
                    'label'        => esc_html__( 'Scrollnav', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://elementpack.pro/demo/element/scrollnav/',
                    'video_url'    => 'https://youtu.be/P3DfE53_w5I',
                ],
                [
                    'name'         => 'search',
                    'label'        => esc_html__( 'Search', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/search/',
                    'video_url'    => 'https://youtu.be/H3F1LHc97Gk',
                ],
                [
                    'name'         => 'scroll-button',
                    'label'        => esc_html__( 'Scroll Button', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/search/',
                    'video_url'    => 'https://youtu.be/y8LJCO3tQqk',
                ],
                [
                    'name'         => 'scroll-image',
                    'label'        => esc_html__( 'Scroll Image', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/scroll-image',
                    'video_url'    => 'https://youtu.be/UpmtN1GsJkQ',
                ],
                [
                    'name'         => 'source-code',
                    'label'        => esc_html__( 'Source Code', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/source-code',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'single-post',
                    'label'        => esc_html__( 'Single Post', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://elementpack.pro/demo/element/single-post',
                    'video_url'    => 'https://youtu.be/32g-F4_Avp4',
                ],
                [
                    'name'         => 'social-share',
                    'label'        => esc_html__( 'Social Share', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/social-share/',
                    'video_url'    => 'https://youtu.be/3OPYfeVfcb8',
                ],
                [
                    'name'         => 'social-proof',
                    'label'        => esc_html__( 'Social Proof', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/social-proof/',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'switcher',
                    'label'        => esc_html__( 'Switcher', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/switcher/',
                    'video_url'    => 'https://youtu.be/BIEFRxDF1UE',
                ],
                [
                    'name'         => 'svg-image',
                    'label'        => esc_html__( 'SVG Image', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/svg-image/',
                    'video_url'    => 'https://youtu.be/XRbjpcp5dJ0',
                ],
                [
                    'name'         => 'tabs',
                    'label'        => esc_html__( 'Tabs', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/tabs/',
                    'video_url'    => 'https://youtu.be/1BmS_8VpBF4',
                ],
                [
                    'name'         => 'table',
                    'label'        => esc_html__( 'Table', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/crypto-currency-table/',
                    'video_url'    => 'https://youtu.be/dviKkEPsg04',
                ],
                [
                    'name'         => 'table-of-content',
                    'label'        => esc_html__( 'Table Of Content', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://elementpack.pro/demo/element/table-of-content-test-post/',
                    'video_url'    => 'https://youtu.be/DbPrqUD8cOY',
                ],
                [
                    'name'         => 'timeline',
                    'label'        => esc_html__( 'Timeline', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://elementpack.pro/demo/element/timeline/',
                    'video_url'    => 'https://youtu.be/lp4Zqn6niXU',
                ],
                [
                    'name'         => 'trailer-box',
                    'label'        => esc_html__( 'Trailer Box', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/trailer-box/',
                    'video_url'    => 'https://youtu.be/3AR5RlBAAYg',
                ],
                [
                    'name'         => 'thumb-gallery',
                    'label'        => esc_html__( 'Thumb Gallery', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post gallery',
                    'demo_url'     => 'https://elementpack.pro/demo/element/thumb-gallery/',
                    'video_url'    => 'https://youtu.be/NJ5ZR-9ODus',
                ],
                [
                    'name'         => 'toggle',
                    'label'        => esc_html__( 'Toggle', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'custom',
                    'demo_url'     => 'https://elementpack.pro/demo/element/toggle/',
                    'video_url'    => 'https://youtu.be/7_jk_NvbKls',
                ],
                [
                    'name'         => 'twitter-carousel',
                    'label'        => esc_html__( 'Twitter Carousel', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others carousel',
                    'demo_url'     => 'https://elementpack.pro/demo/element/twitter-carousel/',
                    'video_url'    => 'https://youtu.be/eeyR1YtUFZw',
                ],
                [
                    'name'         => 'twitter-grid',
                    'label'        => esc_html__( 'Twitter Grid', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'others new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/twitter-grid/',
                    'video_url'    => '',
                ],
                [
                    'name'         => 'twitter-slider',
                    'label'        => esc_html__( 'Twitter Slider', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others slider',
                    'demo_url'     => 'https://elementpack.pro/demo/element/twitter-slider',
                    'video_url'    => 'https://youtu.be/Bd3I7ipqMms',
                ],
                [
                    'name'         => 'threesixty-product-viewer',
                    'label'        => esc_html__( '360 Product Viewer', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/360-product-viewer/',
                    'video_url'    => 'https://youtu.be/60Q4sK-FzLI',
                ],
                [
                    'name'         => 'user-login',
                    'label'        => esc_html__( 'User Login', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/user-login/',
                    'video_url'    => 'https://youtu.be/JLdKfv_-R6c',
                ],
                [
                    'name'         => 'user-register',
                    'label'        => esc_html__( 'User Register', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/user-register/',
                    'video_url'    => 'https://youtu.be/hTjZ1meIXSY',
                ],
                [
                    'name'         => 'video-gallery',
                    'label'        => esc_html__( 'Video Gallery', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom gallery',
                    'demo_url'     => 'https://elementpack.pro/demo/element/video-gallery/',
                    'video_url'    => 'https://youtu.be/wbkou6p7l3s',
                ],
                [
                    'name'         => 'video-player',
                    'label'        => esc_html__( 'Video Player', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/video-player/',
                    'video_url'    => 'https://youtu.be/ksy2uZ5Hg3M',
                ],
                [
                    'name'         => 'weather',
                    'label'        => esc_html__( 'Weather', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://elementpack.pro/demo/element/weather/',
                    'video_url'    => 'https://youtu.be/Vjyl4AAAufg',
                ],
            ],
            'element_pack_elementor_extend' => [
                [
                    'name'      => 'widget_parallax_show',
                    'label'     => esc_html__( 'Widget Parallax Effects', 'bdthemes-element-pack' ),
                    'type'      => 'checkbox',
                    'default'   => "off",
                    'widget_type'  => 'pro',
                    'demo_url'  => 'https://elementpack.pro/demo/element/element-parallax',
                    'video_url' => 'https://youtu.be/Aw9TnT_L1g8',
                ],
                [
                    'name'      => 'section_parallax_show',
                    'label'     => esc_html__( 'Background Parallax', 'bdthemes-element-pack' ),
                    'type'      => 'checkbox',
                    'default'   => "off",
                    'widget_type'  => 'pro',
                    'demo_url'  => 'https://elementpack.pro/demo/element/parallax-background/',
                    'video_url' => 'https://youtu.be/UI3xKt2IlCQ',
                ],
                [
                    'name'      => 'section_parallax_content_show',
                    'label'     => esc_html__( 'Section Parallax Images', 'bdthemes-element-pack' ),
                    'type'      => 'checkbox',
                    'default'   => "off",
                    'widget_type'  => 'pro',
                    'demo_url'  => 'https://elementpack.pro/demo/element/parallax-section/',
                    'video_url' => 'https://youtu.be/nMzk55831MY',
                ],
                [
                    'name'      => 'section_particles_show',
                    'label'     => esc_html__( 'Section Particles', 'bdthemes-element-pack' ),
                    'type'      => 'checkbox',
                    'default'   => "off",
                    'widget_type'  => 'pro',
                    'demo_url'  => 'https://elementpack.pro/demo/element/section-particles/',
                    'video_url' => 'https://youtu.be/8mylXgB2bYg',
                ],
                [
                    'name'      => 'section_schedule_show',
                    'label'     => esc_html__( 'Section Schedule', 'bdthemes-element-pack' ),
                    'type'      => 'checkbox',
                    'default'   => "off",
                    'widget_type'  => 'pro',
                    'demo_url'  => '',
                    'video_url' => 'https://youtu.be/qWaJBg3PS-Q',
                ],
                [
                    'name'      => 'section_sticky_show',
                    'label'     => esc_html__( 'Section Sticky', 'bdthemes-element-pack' ),
                    'type'      => 'checkbox',
                    'default'   => "off",
                    'widget_type'  => 'pro',
                    'demo_url'  => 'https://elementpack.pro/demo/sticky-section/',
                    'video_url' => 'https://youtu.be/Vk0EoQSX0K8',
                ],
                [
                    'name'      => 'widget_tooltip_show',
                    'label'     => esc_html__( 'Widget Tooltip', 'bdthemes-element-pack' ),
                    'type'      => 'checkbox',
                    'default'   => "off",
                    'widget_type'  => 'pro',
                    'demo_url'  => 'https://elementpack.pro/demo/element/widget-tooltip/',
                    'video_url' => 'https://youtu.be/LJgF8wt7urw',
                ],
                [
                    'name'      => 'widget_motion_motions',
                    'label'     => esc_html__( 'Widget Transform', 'bdthemes-element-pack' ),
                    'type'      => 'checkbox',
                    'default'   => "off",
                    'widget_type'  => 'pro',
                    'demo_url'  => 'https://elementpack.pro/demo/element/transform-example/',
                    'video_url' => 'https://youtu.be/Djc6bP7CF18',
                ],
                [
                    'name'         => 'widget_equal_height',
                    'label'        => esc_html__( 'Widget Equal Height', 'bdthemes-element-pack' ),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'content_type' => 'new',
                    'demo_url'     => 'https://elementpack.pro/demo/element/widget-equal-height/',
                    'video_url'    => 'https://youtu.be/h19c3FOxYlc',
                ],

            ],
            'element_pack_api_settings' => [
                
                [
                    'name'              => 'twitter_group_start',
                    'label'             => esc_html__( 'Twitter Access', 'bdthemes-element-pack' ),
                    'desc'              => __( 'Go to <a href="https://apps.twitter.com/app/new" target="_blank">https://apps.twitter.com/app/new</a> for create your Consumer key and Access Token.', 'bdthemes-element-pack' ),
                    'type'              => 'start_group',
                    'video_url'         => 'https://youtu.be/IrQVteaaAow',
                ],

                [
                    'name'              => 'twitter_name',
                    'label'             => esc_html__( 'User Name', 'bdthemes-element-pack' ),
                    'placeholder'       => 'for example: bdthemescom',
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field'
                ],
                [
                    'name'              => 'twitter_consumer_key',
                    'label'             => esc_html__( 'Consumer Key', 'bdthemes-element-pack' ),
                    'placeholder'       => '',
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field'
                ],
                [
                    'name'              => 'twitter_consumer_secret',
                    'label'             => esc_html__( 'Consumer Secret', 'bdthemes-element-pack' ),
                    'placeholder'       => '',
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field'
                ],
                [
                    'name'              => 'twitter_access_token',
                    'label'             => esc_html__( 'Access Token', 'bdthemes-element-pack' ),
                    'placeholder'       => '',
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field'
                ],
                [
                    'name'              => 'twitter_access_token_secret',
                    'label'             => esc_html__( 'Access Token Secret', 'bdthemes-element-pack' ),
                    'placeholder'       => '',
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field'
                ],
                [
                    'name'              => 'twitter_group_end',
                    'type'              => 'end_group',
                ],

                [
                    'name'              => 'recaptcha_group_start',
                    'label'             => esc_html__( 'reCAPTCHA Access', 'bdthemes-element-pack' ),
                    'desc'              => __( 'Go to your Google <a href="https://www.google.com/recaptcha/" target="_blank">reCAPTCHA</a> > Account > Generate Keys (reCAPTCHA V2 > Invisible) and Copy and Paste here.', 'bdthemes-element-pack' ),
                    'type'              => 'start_group',
                ],

                [
                    'name'              => 'recaptcha_site_key',
                    'label'             => esc_html__( 'Site key', 'bdthemes-element-pack' ),
                    'placeholder'       => '',
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field'
                ],
                [
                    'name'              => 'recaptcha_secret_key',
                    'label'             => esc_html__( 'Secret key', 'bdthemes-element-pack' ),
                    'placeholder'       => '',
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field'
                ],

                [
                    'name'              => 'recaptcha_group_end',
                    'type'              => 'end_group',
                ],

                [
                    'name'              => 'contact_form_email',
                    'label'             => esc_html__( 'Contact Form Email', 'bdthemes-element-pack' ),
                    'desc'              => __( 'You can set alternative email for simple contact form', 'bdthemes-element-pack' ),
                    'placeholder'       => 'example@email.com',
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field'
                ],      
            ]
        ];

        $third_party_widget = [];
        
        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'bbpress',
            'label'        => esc_html__( 'bbPress', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/bbpress',
            'video_url'    => 'https://youtu.be/7vkAHZ778c4',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'bp_member',
            'label'        => esc_html__( 'BuddyPress Member', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/buddypress-member/',
            'video_url'    => '',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'bp_group',
            'label'        => esc_html__( 'BuddyPress Group', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/buddypress-member/',
            'video_url'    => '',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'bp_friends',
            'label'        => esc_html__( 'BuddyPress Friends', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/buddypress-member/',
            'video_url'    => '',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'contact-form-seven',
            'label'        => esc_html__( 'Contact Form 7', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'contact-form-7',
            'plugin_path'  => 'contact-form-7/wp-contact-form-7.php',
            'widget_type'  => 'free',
            'content_type' => 'forms',
            'demo_url'     => 'https://elementpack.pro/demo/element/contact-form-7/',
            'video_url'    => 'https://youtu.be/oWepfrLrAN4',
        ];


        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'download-monitor',
            'label'        => esc_html__( 'Download Monitor', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/download-monitor',
            'video_url'    => 'https://youtu.be/7LaBSh3_G5A',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'easy-digital-downloads',
            'label'        => esc_html__( 'Easy Digital Download', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/easy-digital-downloads/',
            'video_url'    => 'https://youtu.be/dXfcvTQQV8Q',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'fluent-forms',
            'label'        => esc_html__( 'Fluent Forms', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'fluentform',
            'plugin_path'  => 'fluentform/fluentform.php',
            'widget_type'  => 'free',
            'content_type' => 'forms new',
            'demo_url'     => 'https://elementpack.pro/demo/element/fluent-forms/',
            'video_url'    => '',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'faq',
            'label'        => esc_html__( 'FAQ', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'paid'         => 'https://bdthemes.com/secure/plugins/bdthemes-faq.zip?key=40fb823b8016d31411a7fe281f41044g',
            'widget_type'  => 'pro',
            'content_type' => 'post',
            'demo_url'     => 'https://elementpack.pro/demo/element/carousel/faq/',
            'video_url'    => 'https://youtu.be/jGGdCuSjesY',
        ];


        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'instagram-feed',
            'label'        => esc_html__( 'Instagram Feed', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/instagram-feed/',
            'video_url'    => 'https://youtu.be/Wf7naA7EL7s',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'event-grid',
            'label'        => esc_html__( 'Event Grid', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'the-events-calendar',
            'plugin_path'  => 'the-events-calendar/the-events-calendar.php',
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/event-grid/',
            'video_url'    => 'https://youtu.be/QeqrcDx1Vus',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'event-carousel',
            'label'        => esc_html__( 'Event Carousel', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'the-events-calendar',
            'plugin_path'  => 'the-events-calendar/the-events-calendar.php',
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/event-carousel/',
            'video_url'    => 'https://youtu.be/_ZPPBmKmGGg',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'event-list',
            'label'        => esc_html__( 'Event List', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'the-events-calendar',
            'plugin_path'  => 'the-events-calendar/the-events-calendar.php',
            'widget_type'  => 'pro',
            'content_type' => 'new',
            'demo_url'     => 'https://elementpack.pro/demo/element/event-list/',
            'video_url'    => '',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'layer-slider',
            'label'        => esc_html__( 'Layer Slider', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'paid'         => 'https://codecanyon.net/item/layerslider-responsive-wordpress-slider-plugin/1362246',
            'widget_type'  => 'pro',
            'content_type' => 'slider',
            'demo_url'     => 'https://elementpack.pro/demo/element/layer-slider/',
            'video_url'    => 'https://youtu.be/I2xpXLyCkkE',
        ];


        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'mailchimp-for-wp',
            'label'        => esc_html__( 'Mailchimp For WP', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'content_type' => 'forms',
            'demo_url'     => 'https://elementpack.pro/demo/element/mailchimp-for-wordpress',
            'video_url'    => 'https://youtu.be/AVqliwiyMLg',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'portfolio-gallery',
            'label'        => esc_html__( 'Portfolio Gallery', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'paid'         => 'https://bdthemes.com/secure/plugins/bdthemes-portfolio.zip?key=40fb823b8016d31411a7fe281f41044g',
            'widget_type'  => 'pro',
            'content_type' => 'post gallery',
            'demo_url'     => 'https://elementpack.pro/demo/element/portfolio-gallery/',
            'video_url'    => 'https://youtu.be/dkKPuZwWFks',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'portfolio-carousel',
            'label'        => esc_html__( 'Portfolio Carousel', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'bdthemes-portfolio',
            'plugin_path'  => 'bdthemes-portfolio/bdthemes-portfolio.php',
            'paid'         => 'https://bdthemes.com/secure/plugins/bdthemes-portfolio.zip?key=40fb823b8016d31411a7fe281f41044g',
            'widget_type'  => 'pro',
            'content_type' => 'post new',
            'demo_url'     => 'https://elementpack.pro/demo/element/portfolio-carousel/',
            'video_url'    => 'https://youtu.be/6fMQzv47HTU',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'portfolio-list',
            'label'        => esc_html__( 'Portfolio List', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'bdthemes-portfolio',
            'plugin_path'  => 'bdthemes-portfolio/bdthemes-portfolio.php',
            'paid'         => 'https://bdthemes.com/secure/plugins/bdthemes-portfolio.zip?key=40fb823b8016d31411a7fe281f41044g',
            'widget_type'  => 'pro',
            'content_type' => 'post new',
            'demo_url'     => 'https://elementpack.pro/demo/element/portfolio-list/',
            'video_url'    => 'https://youtu.be/WdXZMoEEn4I',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'wc_products',
            'label'        => esc_html__( 'Woocommerce Products', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'content_type' => 'ecommerce grid gallery',
            'demo_url'     => 'https://elementpack.pro/demo/element/woocommerce-products/',
            'video_url'    => 'https://youtu.be/3VkvEpVaNAM',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'wc_add_to_cart',
            'label'        => esc_html__( 'WooCommerce Add To Cart', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'content_type' => 'ecommerce',
            'demo_url'     => 'https://elementpack.pro/demo/element/woocommerce-add-to-cart/',
            'video_url'    => 'https://youtu.be/1gZJm2-xMqY',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'wc_elements',
            'label'        => esc_html__( 'WooCommerce Elements', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'content_type' => 'ecommerce grid',
            'demo_url'     => '',
            'video_url'    => '',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'wc_categories',
            'label'        => esc_html__( 'WooCommerce Categories', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'content_type' => 'ecommerce grid gallery',
            'demo_url'     => 'https://elementpack.pro/demo/element/woocommerce-categories/',
            'video_url'    => 'https://youtu.be/SJuArqtnC1U',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'wc_carousel',
            'label'        => esc_html__( 'WooCommerce Carousel', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'content_type' => 'ecommerce carousel',
            'demo_url'     => 'https://elementpack.pro/demo/element/woocommerce-carousel/',
            'video_url'    => 'https://youtu.be/5lxli5E9pc4',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'wc_slider',
            'label'        => esc_html__( 'WooCommerce Slider', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'content_type' => 'ecommerce slider',
            'demo_url'     => 'https://elementpack.pro/demo/element/woocommerce-slider',
            'video_url'    => 'https://youtu.be/ic8p-3jO35U',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'wc_mini_cart',
            'label'        => esc_html__( 'WooCommerce Mini Cart', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'content_type' => 'ecommerce slider',
            'demo_url'     => 'https://elementpack.pro/demo/element/woocommerce-slider',
            'video_url'    => 'https://youtu.be/ic8p-3jO35U',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'booked-calendar',
            'label'        => esc_html__( 'Booked', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'paid'         => 'https://codecanyon.net/item/booked-appointments-appointment-booking-for-wordpress/9466968',
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/booked-calendar/',
            'video_url'    => 'https://youtu.be/bodvi_5NkDU',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'caldera-forms',
            'label'        => esc_html__( 'Caldera Forms', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'content_type' => 'forms',
            'demo_url'     => 'https://elementpack.pro/demo/element/caldera-form/',
            'video_url'    => 'https://youtu.be/2EiVSLows20',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'gravity-forms',
            'label'        => esc_html__( 'Gravity Forms', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'paid'         => 'https://www.gravityforms.com/',
            'widget_type'  => 'pro',
            'content_type' => 'forms',
            'demo_url'     => 'https://elementpack.pro/demo/element/gravity-forms/',
            'video_url'    => 'https://youtu.be/452ZExESiBI',
        ]; 

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'ninja-forms',
            'label'        => esc_html__( 'Ninja Forms', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'ninja-forms',
            'plugin_path'  => 'ninja-forms/ninja-forms.php',
            'widget_type'  => 'free',
            'content_type' => 'forms new',
            'demo_url'     => 'https://elementpack.pro/demo/element/ninja-forms/',
            'video_url'    => 'https://youtu.be/rMKAUIy1fKc',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'quform',
            'label'        => esc_html__( 'QuForm', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'quform',
            'plugin_path'  => 'quform/quform.php',
            'paid'         => 'https://codecanyon.net/item/quform-wordpress-form-builder/706149',
            'widget_type'  => 'pro',
            'content_type' => 'forms',
            'demo_url'     => 'https://elementpack.pro/demo/element/quform/',
            'video_url'    => 'https://youtu.be/LM0JtQ58UJM',
        ];  

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'revolution-slider',
            'label'        => esc_html__( 'Revolution Slider', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'paid'         => 'https://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380',
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/revolution-slider/',
            'video_url'    => 'https://youtu.be/S3bs8FfTBsI',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'tablepress',
            'label'        => esc_html__( 'TablePress', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'demo_url'     => 'https://elementpack.pro/demo/element/tablepress/',
            'video_url'    => 'https://youtu.be/TGnc0ap-cWs',
        ];
        
        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'testimonial-carousel',
            'label'        => esc_html__( 'Testimonial Carousel', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'paid'         => 'https://bdthemes.com/secure/plugins/bdthemes-testimonials.zip?key=40fb823b8016d31411a7fe281f41044g',
            'widget_type'  => 'pro',
            'content_type' => 'post carousel',
            'demo_url'     => 'https://elementpack.pro/demo/element/testimonial-carousel/',
            'video_url'    => 'https://youtu.be/VbojVJzayvE',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'testimonial-grid',
            'label'        => esc_html__( 'Testimonial Grid', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'paid'         => 'https://bdthemes.com/secure/plugins/bdthemes-testimonials.zip?key=40fb823b8016d31411a7fe281f41044g',
            'widget_type'  => 'pro',
            'content_type' => 'post',
            'demo_url'     => 'https://elementpack.pro/demo/element/testimonial-grid/',
            'video_url'    => 'https://youtu.be/pYMTXyDn8g4',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'testimonial-slider',
            'label'        => esc_html__( 'Testimonial Slider', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'paid'         => 'https://bdthemes.com/secure/plugins/bdthemes-testimonials.zip?key=40fb823b8016d31411a7fe281f41044g',
            'widget_type'  => 'pro',
            'content_type' => 'post',
            'demo_url'     => 'https://elementpack.pro/demo/element/testimonial-slider/',
            'video_url'    => 'https://youtu.be/pI-DLKNlTGg',
            
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'tutor-lms-course-grid',
            'label'        => esc_html__( 'Tutor LMS Grid', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'tutor',
            'plugin_path'  => 'tutor/tutor.php',
            'widget_type'  => 'free',
            'content_type' => 'new',
            'demo_url'     => 'https://elementpack.pro/demo/element/tutor-lms-course-grid/',
            'video_url'    => 'https://youtu.be/WWCE-_Po1uo',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'tutor-lms-course-carousel',
            'label'        => esc_html__( 'Tutor LMS Carousel', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'tutor',
            'plugin_path'  => 'tutor/tutor.php',
            'widget_type'  => 'free',
            'content_type' => 'new',
            'demo_url'     => 'https://elementpack.pro/demo/element/tutor-lms-course-carousel/',
            'video_url'    => 'https://youtu.be/VYrIYQESjXs',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'we-forms',
            'label'        => esc_html__( 'weForms', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "on",
            'plugin_name'  => 'weforms',
            'plugin_path'  => 'weforms/weforms.php',
            'widget_type'  => 'free',
            'content_type' => 'new',
            'demo_url'     => 'https://elementpack.pro/demo/element/we-forms/',
            'video_url'    => '',
        ];
        
        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'wp-forms',
            'label'        => esc_html__( 'Wp Forms Lite', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'pro',
            'content_type' => 'forms',
            'demo_url'     => '',
            'video_url'    => '',
        ];

        $third_party_widget['element_pack_third_party_widget'][] = [
            'name'         => 'wp-forms',
            'label'        => esc_html__( 'Wp Forms', 'bdthemes-element-pack' ),
            'type'         => 'checkbox',
            'default'      => "off",
            'paid'         => 'https://wpforms.com/pricing/',
            'widget_type'  => 'pro',
            'content_type' => 'forms',
            'demo_url'     => 'https://elementpack.pro/demo/element/wp-forms/',
            'video_url'    => 'https://youtu.be/p_FRLsEVNjQ',
        ];

        return array_merge($settings_fields, $third_party_widget);
    }


    function element_pack_welcome() {

        $current_user = wp_get_current_user();

        ?>
           
            <div class="ep-dashboard-panel" bdt-scrollspy="target: > div > div > .bdt-card; cls: bdt-animation-slide-bottom-small; delay: 300">

                <div class="bdt-grid" bdt-grid bdt-height-match="target: > div > .bdt-card">
                    <div class="bdt-width-1-2@m ep-welcome-banner">
                        <div class="ep-welcome-content bdt-card bdt-card-body">
                            <h1 class="ep-feature-title">Welcome <?php echo esc_html($current_user->user_firstname); ?> <?php echo esc_html($current_user->user_lastname); ?>!</h1>
                            <p>Thanks for joining the Element Pack family. 
                            You are in the right place to build your amazing site and lift it to the next level. Element Pack makes everything easy for you. Its drag and drop options can create magic. If you feel any challenges visit our youtube channel, nock on our support system.
                            Stay tuned and see you at the top of success.</p>
                        </div>
                    </div>
                    
                    <div class="bdt-width-1-2@m">
                        <div class="bdt-card bdt-card-body bdt-card-red ep-genarate-idea">
                            
                            <h1 class="ep-feature-title">Learn Element Pack</h1>
                            <p style="max-width: 690px;">Designing an element might be so tough, I might not able to do it! You often may think like that but it’s not true. We have made the best tutotials and walk throughs for each and every elements, widgets, blocks that anyone will be able to do it. Lets visit the documentation web portal and learn more about  your desired elements to make the next coolest website on the internet.
</p>
                            <a class="bdt-button bdt-btn-red bdt-margin-small-top" target="_blank" rel="" href="https://bdthemes.com/support/category/details/8.html">Go knowledge page</a>
                            
                        </div>
                    </div>
                </div>

                <div class="bdt-grid" bdt-grid bdt-height-match="target: > div > .bdt-card">
                    
                    <div class="bdt-width-2-3@m">
                        <div class="bdt-card bdt-card-red bdt-card-body">
                            <h1 class="ep-feature-title">Frequently Asked Questions</h1>

                            <ul bdt-accordion="collapsible: false">
                                <li>
                                    <a class="bdt-accordion-title" href="#">Is Element Pack compatible my theme?</a>
                                    <div class="bdt-accordion-content">
                                        <p>
                                            Normally our plugin is compatible with most of theme and cross browser that we have tested. If happen very few change to your site looking, no problem our strong support team is dedicated for fixing your minor problem. 
                                        </p>
                                        <p>
                                            Here some theme compatibility video example: <a href="https://youtu.be/5U6j7X5kA9A" target="_blank">Avada</a> ,<a href="https://youtu.be/HdZACDwrrdM" target="_blank">Astra</a>, <a href="https://youtu.be/kjqpQRsVyY0" target="_blank">OcecanWP</a>
                                        </p>
                                        
                                    </div>
                                </li>
                                <li>
                                    <a class="bdt-accordion-title" href="#">How should I get updates?</a>
                                    <div class="bdt-accordion-content">
                                        <p>
                                            When we release an update version, then automatically you will get a notification on WordPress plugin manager, so you can update from there. Thereafter you want to update manually just knock us, we will send you update version via mail.
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <a class="bdt-accordion-title" href="#">What is 3rd Party Widgets?</a>
                                    <div class="bdt-accordion-content">
                                        <p>
                                            3rd Party widgets mean you should install that 3rd party plugin to use that widget. For example, There have WC Carousel or WC Products. If you want to use those widgets so you must install WooCommerce Plugin first. So you can access those widgets.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="bdt-width-1-3@m">
                        <div class="ep-video-tutorial bdt-card bdt-card-body bdt-card-green">
                            <h1 class="ep-feature-title">Video Tutorial</h1>
                            
                            <ul class="bdt-list bdt-list-divider" bdt-lightbox>
                                <li>
                                    <a href="https://youtu.be/x2Pt9X8c4w4">
                                        <h4 class="ep-link-title">What's New in Version V4.6.0</h4>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://youtu.be/2fAF8Rt7FbQ">
                                        <h4 class="ep-link-title">How to Use Custom Gallery Widget</h4>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://youtu.be/oWepfrLrAN4">
                                        <h4 class="ep-link-title">How to Use Contact Form 7 Widget</h4>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://youtu.be/3AR5RlBAAYg">
                                        <h4 class="ep-link-title">How to Use Trailer Box Widget</h4>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://youtu.be/faIeyW7LOJ8">
                                        <h4 class="ep-link-title">How to use Simple Contact Form Widget</h4>
                                    </a>
                                </li>
                            </ul>

                            <a class="bdt-video-btn" target="_blank" href="https://www.youtube.com/playlist?list=PLP0S85GEw7DOJf_cbgUIL20qqwqb5x8KA">View more videos <span class="dashicons dashicons-arrow-right"></span></a>
                        </div>
                        

                    </div>
                    
                </div>


                <div class="bdt-grid" bdt-grid bdt-height-match="target: > div > .bdt-card">
                    <div class="bdt-width-1-3@m ep-support-section">
                        <div class="ep-support-content bdt-card bdt-card-green bdt-card-body">
                            <h1 class="ep-feature-title">Support And Feedback</h1>
                            <p>Feeling like to consult with an expert? Take live Chat support immediately from <a href="https://elementpack.pro" target="_blank" rel="">ElementPack</a>. We are always ready to help you 24/7.</p>
                            <p><strong>Or if you’re facing technical issues with our plugin, then please create a support ticket</strong></p>
                            <a class="bdt-button bdt-btn-green bdt-margin-small-top" target="_blank" href="https://elementpack.pro/go/support/">Get Support</a>
                        </div>
                    </div>
                    
                    <div class="bdt-width-2-3@m">
                        <div class="bdt-card bdt-card-body bdt-card-green ep-system-requirement">
                            <h1 class="ep-feature-title bdt-margin-small-bottom">System Requirement</h1>
                            <?php $this->element_pack_system_requirement(); ?>
                        </div>
                    </div>
                </div>

                <div class="bdt-grid" bdt-grid bdt-height-match="target: > div > .bdt-card">
                    <div class="bdt-width-2-3@m ep-support-section">
                        <div class="bdt-card bdt-card-body bdt-card-red ep-support-feedback">
                            <h1 class="ep-feature-title">Missing Any Feature?</h1>
                            <p style="max-width: 800px;">Are you in need of a feature that’s not available in our plugin? Feel free to do a
                                feature request from here,</p>
                            <a class="bdt-button bdt-btn-red bdt-margin-small-top" target="_blank" rel="" href="https://elementpack.pro/make-a-suggestion/">Request Feature</a>
                        </div>
                    </div>
                    
                    <div class="bdt-width-1-3@m">
                        <div class="ep-newsletter-content bdt-card bdt-card-green bdt-card-body">
                            <h1 class="ep-feature-title">Newsletter Subscription</h1>
                            <p>To get updated news, current offers, deals, and tips please subscribe to our Newsletters.</p>
                            <a class="bdt-button bdt-btn-green bdt-margin-small-top" target="_blank" rel="" href="https://elementpack.pro/newsletter/">Subscribe Now</a>
                        </div>
                    </div>
                </div>

            </div>


        <?php
    }


    function element_pack_get_pro() {
        ?>
            
            <div class="ep-dashboard-panel" bdt-scrollspy="target: > div > div > .bdt-card; cls: bdt-animation-slide-bottom-small; delay: 300">

                <div class="bdt-grid" bdt-grid bdt-height-match="target: > div > .bdt-card" style="max-width: 800px; margin-left: auto; margin-right: auto;">
                    <div class="bdt-width-1-1@m ep-comparision bdt-text-center">
                        <h1 class="bdt-text-bold">WHY GO WITH PRO?</h1>                        
                        <h2>Just Compare With Element Pack Lite Vs Pro</h2>


                        <div>
                            
                            <ul class="bdt-list bdt-list-divider bdt-text-left bdt-text-normal" style="font-size: 16px;">
                                

                                <li class="bdt-text-bold">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Features</div>
                                        <div class="bdt-width-auto@m">Free</div>
                                        <div class="bdt-width-auto@m">Pro</div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m"><span bdt-tooltip="pos: top-left; title: Lite have 15+ Widgets but Pro have 80+ core widgets">Core Widgets</span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Theme Compatibility</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Dynamic Content & Custom Fields Capabilities</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Proper Documentation</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Updates & Support</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Header & Footer Builder</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-no"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Rooten Theme Pro Features</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-no"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Priority Support</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-no"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">WooCommerce Widgets</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-no"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Ready Made Pages</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-no"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Ready Made Blocks</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-no"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Ready Made Header & Footer</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-no"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="bdt-grid">
                                        <div class="bdt-width-expand@m">Elementor Extended Widgets</div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-no"></span></div>
                                        <div class="bdt-width-auto@m"><span class="dashicons dashicons-yes"></span></div>
                                    </div>
                                </li>

                            </ul>


                            <div class="ep-dashboard-divider"></div>


                            <div class="ep-more-features">
                                <ul class="bdt-list bdt-list-divider bdt-text-left" style="font-size: 16px;">
                                    <li>
                                        <div class="bdt-grid">
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> Incredibly Advanced
                                            </div>
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> Refund or Cancel Anytime
                                            </div>
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> Dynamic Content
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="bdt-grid">
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> Super-Flexible Widgets
                                            </div>
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> 24/7 Premium Support
                                            </div>
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> Third Party Plugins
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="bdt-grid">
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> Special Discount!
                                            </div>
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> Custom Field Integration
                                            </div>
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> With Live Chat Support
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="bdt-grid">
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> Trusted Payment Methods
                                            </div>
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> Interactive Effects
                                            </div>
                                            <div class="bdt-width-1-3@m">
                                                <span class="dashicons dashicons-heart"></span> Video Tutorial
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                                <div class="ep-dashboard-divider"></div>

                                <div class="ep-purchase-button">
                                    <a href="https://elementpack.pro/pricing/" target="_blank">Purchase Now</a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        <?php
    }


    function element_pack_system_requirement() {
        $php_version        = phpversion();
        $max_execution_time = ini_get('max_execution_time');
        $memory_limit       = ini_get('memory_limit');
        $post_limit         = ini_get('post_max_size');
        $uploads            = wp_upload_dir();
        $upload_path        = $uploads['basedir'];
        $yes_icon           = '<span class="valid"><i class="dashicons-before dashicons-yes"></i></span>';
        $no_icon            = '<span class="invalid"><i class="dashicons-before dashicons-no-alt"></i></span>';

        $environment      = Utils::get_environment_info();

        // TODO - active and deactive modules count 
        // $core_moduels = get_option( 'element_pack_active_modules' );
        // $thirdparty_modules = get_option( 'element_pack_third_party_widget' );
        // $extended = get_option( 'element_pack_elementor_extend' );

        // $all_modules = count($core_moduels) + count($thirdparty_modules) + count($extended) ;

        ?>
        <ul class="check-system-status bdt-grid bdt-child-width-1-2@m bdt-grid-small ">
            <li>
                <div>
                <span class="label1">PHP Version: </span>

                <?php
                if (version_compare($php_version,'5.6.0','<')) {
                    echo $no_icon;
                    echo '<span class="label2">Currently: ' . $php_version . ' (Min: 5.6 Recommended)</span>';
                } else {
                    echo $yes_icon;
                    echo '<span class="label2">Currently: ' . $php_version . '</span>';
                }
                ?>
                </div>
            </li>
            <li>
                <div>
                <span class="label1">MultiSite: </span>

                <?php
                if ( $environment['wp_multisite'] ) {
                    echo '<span class="label2">MultiSite</span>';
                } else {
                    echo '<span class="label2">No MultiSite </span>';
                }
                ?>
                </div>
            </li>

            <li>
                <div>
                <span class="label1">Debug Mode: </span>

                <?php
                if ( $environment['wp_debug_mode'] ) {
                    echo '<span class="label2">Currently Turned On</span>';
                } else {
                    echo '<span class="label2">Currently Turned Off</span>';
                }
                ?>
                </div>
            </li>
            <li>
                <div>
                <span class="label1">Maximum execution time: </span>

                <?php
                if ($max_execution_time < '90') {
                    echo $no_icon;
                    echo '<span class="label2">Currently: ' . $max_execution_time . '(Min: 90 Recommended)</span>';
                } else {
                    echo $yes_icon;
                    echo '<span class="label2">Currently: ' . $max_execution_time . '</span>';
                }
                ?>
                </div>
            </li>
            <li>
                <div>
                <span class="label1">Memory Limit: </span>

                <?php
                if (intval($memory_limit) < '256') {
                    echo $no_icon;
                    echo '<span class="label2">Currently: ' . $memory_limit . ' (Min: 256M Recommended)</span>';
                } else {
                    echo $yes_icon;
                    echo '<span class="label2">Currently: ' . $memory_limit . '</span>';
                }
                ?>
                </div>
            </li>
            
            <li>
                <div>
                <span class="label1">Max Post Limit: </span>

                <?php
                if (intval($post_limit) < '32') {
                    echo $no_icon;
                    echo '<span class="label2">Currently: ' . $post_limit . ' (Min: 32M Recommended)</span>';
                } else {
                    echo $yes_icon;
                    echo '<span class="label2">Currently: ' . $post_limit . '</span>';
                }
                ?>
                </div>
            </li>

            <li>
                <div>
                <span class="label1">Uploads folder writable: </span>

                <?php
                if (!is_writable($upload_path)) {
                    echo $no_icon;
                } else {
                    echo $yes_icon;
                }
                ?>
                </div>
            </li>

            <li>
                <div>
                <span class="label1">GZip Enabled: </span>

                <?php
                if ( $environment['gzip_enabled'] ) {
                    echo $yes_icon;
                } else {
                    echo $no_icon;
                }
                ?>
                </div>
            </li>

        </ul>

        <div class="bdt-admin-alert"> 
            <strong>Note:</strong> If you have multiple addons like element pack so you need some more requirement some cases so make sure you added more memory for others addon too.
        </div>
        <?php
    }


    


    function plugin_page() {

        echo '<div class="wrap element-pack-dashboard">';
        echo '<h1>'.BDTEP_TITLE.' Settings</h1>';

        $this->settings_api->show_navigation();

        ?>
        
        

            <div class="bdt-switcher">
                <div id="element_pack_welcome_page" class="ep-option-page group">
                     <?php $this->element_pack_welcome(); ?>             
                </div>


                <?php
                $this->settings_api->show_forms();
                ?>

                <div id="element_pack_get_pro" class="ep-option-page group">
                     <?php $this->element_pack_get_pro(); ?>             
                </div>

            </div>

        </div>
        
        <?php $this->footer_info(); ?>

        <?php

        $this->script();

        ?>
        
        <?php
    }


    /**
     * Tabbable JavaScript codes & Initiate Color Picker
     *
     * This code uses localstorage for displaying active tabs
     */
    function script() {
        ?>
        <script>
            jQuery(document).ready(function($) {
                'use strict';               

                function hashHandler() {
                    var $tab = $('.element-pack-dashboard .bdt-tab');
                    if (window.location.hash) {
                        var hash = window.location.hash.substring(1);
                        bdtUIkit.tab( $tab ).show( $('#bdt-' + hash ).data('tab-index') );
                    }
                }

                $(window).on('load', function() {
                    hashHandler();
                });

                window.addEventListener("hashchange", hashHandler, true);

                $('.toplevel_page_element_pack_options > ul > li > a ').on('click', function(event) {
                    $(this).parent().siblings().removeClass('current');
                    $(this).parent().addClass('current');
                });

                jQuery("#adminmenu .toplevel_page_element_pack_options .wp-submenu > li:nth-child(7) > a").click(function(){
                    window.location = "https://elementpack.pro/pricing/";
                });


                jQuery("#element_pack_active_modules_page a.ep-active-all-widget").click(function(){
                    jQuery('#element_pack_active_modules_page .ep-widget-free .checkbox').attr('checked','checked');
                    jQuery(this).addClass('bdt-active');
                    jQuery("a.ep-deactive-all-widget").removeClass('bdt-active');
                });

                jQuery("#element_pack_active_modules_page a.ep-deactive-all-widget").click(function(){ 
                    jQuery('#element_pack_active_modules_page .ep-widget-free .checkbox').removeAttr('checked');
                    jQuery(this).addClass('bdt-active');
                    jQuery("a.ep-active-all-widget").removeClass('bdt-active');
                });

                jQuery("#element_pack_third_party_widget_page a.ep-active-all-widget").click(function(){
                    jQuery('#element_pack_third_party_widget_page .ep-widget-free .checkbox').attr('checked','checked');
                    jQuery(this).addClass('bdt-active');
                    jQuery("a.ep-deactive-all-widget").removeClass('bdt-active');
                });

                jQuery("#element_pack_third_party_widget_page a.ep-deactive-all-widget").click(function(){
                    jQuery('#element_pack_third_party_widget_page .ep-widget-free .checkbox').attr('checked','checked');
                    jQuery(this).addClass('bdt-active');
                    jQuery("a.ep-active-all-widget").removeClass('bdt-active');
                        
                });


               jQuery('form.settings-save').submit(function(event) { 
                    event.preventDefault();
                    
                    bdtUIkit.notification({message: '<div bdt-spinner></div> <?php esc_html_e('Please wait, Saving settings...', 'bdthemes-element-pack') ?>', timeout: false});

                    jQuery(this).ajaxSubmit({
                        success: function(){
                            bdtUIkit.notification.closeAll();
                            bdtUIkit.notification({message: '<span class="dashicons dashicons-yes"></span> <?php esc_html_e('Settings Saved Successfully.', 'bdthemes-element-pack') ?>', status: 'primary'});
                        },
                        error: function(data) {
                            bdtUIkit.notification.closeAll();
                            bdtUIkit.notification({message: '<span bdt-icon=\'icon: warning\'></span> <?php esc_html_e('Unknown error, make sure access is correct!', 'bdthemes-element-pack') ?>', status: 'warning'});
                        }
                    }); 
                  
                  return false; 
               });
                
        });
        </script>
        <?php
    }


    function footer_info() {
        ?>
        <div class="element-pack-footer-info">
            <p>Element Pack Addon made with love by <a target="_blank" href="https://bdthemes.com">BdThemes</a> Team. <br>All rights reserved by BdThemes.</p> 
        </div>
        <?php
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = [];
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}

new ElementPack_Admin_Settings();