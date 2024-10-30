<?php

namespace MasterElements\Modules\Theme_Builder;
include_once \MasterElements::plugin_dir() . '/classes/master-woocommerce-functions.php'; //Woocommerce Functions

use MasterElements\Master_Woocommerce_Functions;

defined('ABSPATH') || exit;


class Init
{


    public $dir;


    public $url;

    public static $instance = null;

    protected $templates;

    public $header_template;

    public $footer_template;

    public $single_template;

    public $archive_template;

    public $template_404;

    public $blog_template;

    public $maintenance_template;

    public $section_template;

    public $search_template;

    public $comingsoon_template;

    public $product_template;

    public $thankyou_template;

//    protected $post_type = 'metemplate';


    public function __construct()
    {

        // get current directory path

        $this->dir = dirname(__FILE__) . '/';

        // include all necessary files

        $this->include_files();

        add_action('wp', array($this, 'hooks'));

    }

    public static function instance()
    {

        if (is_null(self::$instance)) {

            self::$instance = new self();

        }


        return self::$instance;

    }

    public function include_files()
    {

        include_once $this->dir . 'me-cpt.php';

        include_once $this->dir . 'me-cpt-hooks.php';

    }

    public function hooks()
    {

        $this->current_template = basename(get_page_template_slug());
        if ($this->current_template == 'elementor_canvas') {

            return;

        }

        $this->current_theme = get_template();
//        echo 'filters: <pre>' .print_r(self::template_ids(),true). '</pre>';
        new Views\Theme_Support(self::template_ids());


    }

    public static function template_ids()
    {
        $instance = self::instance();
        $d = new \MasterElements\Modules\Theme_Builder\Master_Custom_Post();

        $posttypes = $d->register_sections();
        foreach ($posttypes as $posttype) {
            $instance->the_filter($posttype);
        }
        $ids = [

            $instance->header_template,

            $instance->footer_template,

            $instance->single_template,

            $instance->archive_template,

            $instance->template_404,

            $instance->blog_template,

            $instance->maintenance_template,

            $instance->section_template,

            $instance->search_template,

            $instance->comingsoon_template,

            $instance->product_template,

            $instance->thankyou_template,

        ];
        return $ids;

    }


    public function get_possible_post_meta($postID)

    {

        global $wpdb;

        $data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE post_id = $postID AND (meta_key like '%condition_a%' OR meta_key like '%condition_singular%' OR meta_key like '%condition_singular_id%')"));

        // echo "<pre>".print_r($data[0],true)."</pre>";


        if ($data != '') {

            return $data;

        } else {

            return false;

        }

    }

    public function get_post_meta_condition_a($postID)

    {

        global $wpdb;

        $data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE post_id = $postID AND (meta_key like '%condition_a%')"));

        // echo "<pre>".print_r($data[0],true)."</pre>";


        if ($data != '') {

            return $data;

        } else {

            return false;

        }

    }

    public function get_post_meta_condition_singular($postID)

    {

        global $wpdb;

        $data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE post_id = $postID AND (meta_key like '%condition_singular%')"));

        // echo "<pre>".print_r($data[0],true)."</pre>";


        if ($data != '') {

            return $data;

        } else {

            return false;

        }

    }


    public function get_post_meta_condition_singular_id($postID)

    {

        global $wpdb;

        $data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE post_id = $postID AND  meta_key like '%condition_singular_id%')"));

        // echo "<pre>".print_r($data[0],true)."</pre>";


        if ($data != '') {

            return $data;

        } else {

            return false;

        }

    }

    public function get_d_values($filters, $ptypes)
    {

        if ($ptypes['item'] == 'Header') {

            $this->get_header($filters, $ptypes);

        }
        if ($ptypes['item'] == 'Footer') {
            $this->get_footer($filters, $ptypes);

        }
        if ($ptypes['item'] == 'Archive') {
            $this->get_archive($filters, $ptypes);

        }
        if ($ptypes['item'] == 'Single') {
            $this->get_single($filters, $ptypes);

        }
        if ($ptypes['item'] == '404') {
            $this->get_404($filters, $ptypes);

        }
        if ($ptypes['item'] == 'Blog') {
            $this->get_blog($filters, $ptypes);

        }
        if ($ptypes['item'] == 'Maintenance') {
            $this->get_maintenance($filters, $ptypes);

        }
        if ($ptypes['item'] == 'Section') {
            $this->get_section($filters, $ptypes);

        }
        if ($ptypes['item'] == 'Search') {
            $this->get_search($filters, $ptypes);

        }
        if ($ptypes['item'] == 'Coming Soon') {
            $this->get_coming_soon($filters, $ptypes);

        }
        if ($ptypes['item'] == 'WooCommerce Page') {
            $this->get_product($filters, $ptypes);
            $this->get_cart_page($filters, $ptypes);
            $this->get_shop_page($filters, $ptypes);
            $this->get_checkout_page($filters, $ptypes);
            $this->get_account_page($filters, $ptypes);
            $this->get_thankyou_page($filters, $ptypes);
        }

    }

    protected function the_filter($posttype)
    {
        global $wp;
        $master_woo = new Master_Woocommerce_Functions();
        $i = 1;
        $tempV = 'condition_a' . $i;

        $tempV2 = 'condition_singular' . $i;
        $tempV3 = 'condition_singular_id' . $i;

        if (is_plugin_active('woocommerce/woocommerce.php')) {
            if ($master_woo::mw_single_product_page()) {

                $filters = [[


                    'key' => $tempV,


                    'value' => 'woo_single_product',


                ]];


                $this->get_d_values($filters, $posttype);


            }


            if ($master_woo::mw_shop()) {

                $filters = [[


                    'key' => $tempV,


                    'value' => 'woo_archive_product',


                ]];


                $this->get_d_values($filters, $posttype);


            }


            if ($master_woo::mw_cart()) {

                $filters = [[


                    'key' => $tempV,


                    'value' => 'woo_product_cart',


                ]];


                $this->get_d_values($filters, $posttype);


            }


            if ($master_woo::mw_checkout()) {

                $filters = [[


                    'key' => $tempV,


                    'value' => 'woo_product_checkout',


                ]];


                $this->get_d_values($filters, $posttype);


            }


            if ( $master_woo::mw_account()) {

                $filters = [[


                    'key' => $tempV,


                    'value' => 'woo_my_account',


                ]];


                $this->get_d_values($filters, $posttype);


            }

            if ($master_woo::mw_checkout() && !empty($wp->query_vars['order-received'])) {

                $filters = [[


                    'key' => $tempV,


                    'value' => 'woo_thankyou_page',


                ]];


                $this->get_d_values($filters, $posttype);

            }

        }

        if (!is_admin()) {
            $filters = [[

                'key' => $tempV,

                'value' => 'entire_site',

            ]];


            $this->get_d_values($filters, $posttype);
        }

        if (is_archive()) {
            $filters = [[

                'key' => $tempV,

                'value' => 'archive',

            ]];

            $this->get_d_values($filters, $posttype);

        }

        // all singular

        if (is_page() || is_single()) {
            $filters = [
                [
                    'key' => $tempV,
                    'value' => 'singular',
                ],
                [
                    'key' => $tempV2,
                    'value' => 'all',
                ]
            ];

            $this->get_d_values($filters, $posttype);

        } // all pages, all posts


        elseif (is_page() || is_single()) {
            $filters = [
                [
                    'key' => $tempV,
                    'value' => 'singular',
                ],
                [
                    'key' => $tempV2,
                    'value' => 'all_pages',
                ]
            ];

            $this->get_d_values($filters, $posttype);

        } elseif (is_404()) {

            $filters = [
                [
                    'key' => $tempV,
                    'value' => 'singular',
                ],
                [
                    'key' => $tempV2,
                    'value' => '404page',
                ]
            ];

            $this->get_d_values($filters, $posttype);

        }
        // all pages, all posts


        if (is_page()) {
            $filters = [
                [
                    'key' => $tempV,
                    'value' => 'singular',
                ],
                [
                    'key' => $tempV2,
                    'value' => 'all_pages',
                ]
            ];

            $this->get_d_values($filters, $posttype);

        }

        if (is_single()) {
            $filters = [
                [
                    'key' => $tempV,
                    'value' => 'singular',
                ],
                [
                    'key' => $tempV2,
                    'value' => 'all_posts',
                ]
            ];

            $this->get_d_values($filters, $posttype);

        }
        // singular selective

        if (is_page() || is_single()) {
            $filters = [
                [
                    'key' => $tempV,
                    'value' => 'singular',

                ],
                [
                    'key' => $tempV2,
                    'value' => 'selective',
                ],
                [
                    'key' => $tempV3,
                    'value' => get_the_ID(),
                ]
            ];
            // echo '<pre>Array: '.print_r($filters,true).'</pre><br>';
            $this->get_d_values($filters, $posttype);

        }


        // homepage

        if (is_home() || is_front_page()) {

            $filters = [
                [
                    'key' => $tempV,
                    'value' => 'singular',
                ],
                [
                    'key' => $tempV2,
                    'value' => 'front_page',
                ]
            ];

            $this->get_d_values($filters, $posttype);

        }
    }

    protected function get_header($filters, $posttype)
    {

        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
//                 var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_header') {

                        $this->header_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_footer($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
                // var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_footer') {

                        $this->footer_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_single($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
                // var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_single') {

                        $this->single_template = $template['ID'];

                    }

                }

                // var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_wooproduct') {

                        $this->product_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_product($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
                // var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_wooproduct') {

                        $this->product_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_cart_page($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
                // var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_wooproduct') {

                        $this->product_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_shop_page($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
                // var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_wooproduct') {

                        $this->product_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_checkout_page($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
                // var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_wooproduct') {

                        $this->product_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_account_page($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
                // var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_wooproduct') {

                        $this->product_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_thankyou_page($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
                // var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_wooproduct') {

                        $this->thankyou_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_archive($filters, $posttype)
    {

        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
//                 var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_archive') {

                        $this->archive_template = $template['ID'];

                    }

                }

            }

        }

    }

    protected function get_404($filters, $posttype)
    {

        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
//                 var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_404') {

                        $this->template_404 = $template['ID'];

                    }

                }

            }

        }

    }

    protected function get_blog($filters, $posttype)
    {

        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
//                 var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_blog') {

                        $this->blog_template = $template['ID'];

                    }

                }

            }

        }

    }

    protected function get_maintenance($filters, $posttype)
    {

        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
//                 var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_maintenance') {

                        $this->maintenance_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_section($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
//                 var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_section') {

                        $this->section_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_search($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
//                 var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_search') {

                        $this->search_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_coming_soon($filters, $posttype)
    {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $posttype['id'],
            'meta_query' => [
                [
                    'key' => 'activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->template = $posts = get_posts($arg);
        if ($this->template != null) {
            foreach ($this->template as $template) {
                $template = $this->get_full_data($template);
                $match_found = true;
                foreach ($filters as $filter) {
                    if ($filter['key'] == 'condition_singular_id1') {
                        $ids = !empty($template[$filter['key']]) ? $template[$filter['key']] : array();

                        if (!in_array($filter['value'], $ids)) {
                            $match_found = false;

                        }

                    } elseif ($template[$filter['key']] != $filter['value']) {
                        $match_found = false;

                    }

                    if ($filter['key'] == 'condition_a1' && $template[$filter['key']] == 'singular' && count($filters) < 2) {
                        $match_found = false;

                    }

                }
//                 var_dump($match_found);
                if ($match_found == true) {

                    if ($posttype['id'] == 'me_comingsoon') {

                        $this->comingsoon_template = $template['ID'];

                    }

                }

            }

        }
    }

    protected function get_full_data($post)
    {

        //exit;

        if ($post != null) {

            return array_merge((array)$post, [
                'activation' => get_post_meta($post->ID, 'activation', true),

                'condition_a1' => get_post_meta($post->ID, 'condition_a1', true),

                'condition_singular1' => get_post_meta($post->ID, 'condition_singular1', true),

                'condition_singular_id1' => get_post_meta($post->ID, 'condition_singular_id1', true),

            ]);

        }

    }

    public function filters_builder($count)
    {


    }


}