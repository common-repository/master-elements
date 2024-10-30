<?php

use MasterElements\Master_Woocommerce_Functions;
use Woocommerce\WC_Query;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WooCommerce Classes, Functions, Actions and Filters Used in this Function
 */
class Master_Archive_Products extends WC_Shortcode_Products
{

    private $archive_settings = [];
    private $mw_added_product_filter = false;

    public function __construct( $archive_settings = array(), $type = 'products' ) {

        //WooCommerce Hooks
       // $this->define_constants();
       // $this->includes();
       // $this->init_hooks();

       // do_action( 'woocommerce_loaded' );



        $this->settings = $archive_settings;
        $this->type = $type;
        $this->attributes = $this->parse_attributes( [
            'columns' => $archive_settings['me_columns'],
            'me_rows' => $archive_settings['me_rows'],
            'paginate' => $archive_settings['me_paginate'],
            'cache' => false,
        ] );
        $this->query_args = $this->master_parse_args_query();

    }


    protected function master_query_results() {
        $results = parent::master_query_results();
        $master_query = new Master_Woocommerce_Functions();
        if ( $this->mw_added_product_filter ) {
            remove_action( 'pre_get_posts', [ $master_query::mw_wc_query(), 'product_query' ] );
        }


        return $results;
    }

    protected function master_parse_args_query() {
        $master_query = new Master_Woocommerce_Functions();
        $archive_settings = $this->settings;
        $query_args = [
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
            'no_found_rows' => false === wc_string_to_bool( $this->attributes['paginate'] ),
        ];

        if ( 'preview' == $this->settings['me_query_post_type'] ) {
            $query_args = $GLOBALS['wp_query']->query_vars;


            $query_args['p'] = 0;
            $query_args['post_type'] = 'product';
            $query_args['post_status'] = 'publish';
            $query_args['ignore_sticky_posts'] = true;
            $query_args['no_found_rows'] = false === wc_string_to_bool( $this->attributes['paginate'] );
            $query_args['orderby'] = '';
            $query_args['me_order'] = '';

            add_action( 'pre_get_posts', array( $master_query::mw_wc_query(), 'product_query' ) );

            $this->mw_added_product_filter = true;

        }elseif ( 'current_query' === $this->settings['me_query_post_type'] ) {
            if ( ! wc_get_page_id( 'shop' ) && $this->settings['editor_mode'] != true ) {
                $query_args = $GLOBALS['wp_query']->query_vars;
            }

            if ( ! isset( $query_args['orderby'] ) ) {
                $query_args['orderby'] = '';
                $query_args['me_order'] = '';
            }

            add_action( 'pre_get_posts', [ $master_query::mw_wc_query(), 'product_query' ] );
            $this->mw_added_product_filter = true;

        } else {
            $query_args = [
                'post_type' => 'product',
                'post_status' => 'publish',
                'ignore_sticky_posts' => true,
                'no_found_rows' => false === wc_string_to_bool( $this->attributes['paginate'] ),
                'orderby' => $archive_settings['orderby'],
                'me_order' => strtoupper( $archive_settings['me_order'] ),
            ];

            $query_args['meta_query'] = WC()->query->get_meta_query();
            $query_args['tax_query'] = [];
            $this->set_visibility_query_args( $query_args );

            $this->set_featured_query_args( $query_args );

            $this->set_ids_query_args( $query_args );

            if ( method_exists( $this, "set_{$this->type}_query_args" ) ) {
                $this->{"set_{$this->type}_query_args"}( $query_args );
            }

            $this->set_categories_query_args( $query_args );

            $this->set_tags_query_args( $query_args );

            $query_args = apply_filters( 'woocommerce_shortcode_products_query', $query_args, $this->attributes, $this->type );

            if ( 'yes' === $archive_settings['paginate'] ) {
                $ordering_args = WC()->query->get_catalog_ordering_args();
            } else {
                $ordering_args = WC()->query->get_catalog_ordering_args( $query_args['orderby'], $query_args['me_order'] );
            }

            $query_args['orderby'] = $ordering_args['orderby'];
            $query_args['order'] = $ordering_args['order'];
            if ( $ordering_args['meta_key'] ) {
                $query_args['meta_key'] = $ordering_args['meta_key'];
            }

            $query_args['posts_per_page'] = intval( $archive_settings['me_columns'] * $archive_settings['me_rows'] );
        } // End if().

        if ( 'yes' === $archive_settings['me_paginate'] ) {
            $page = absint( empty( $_GET['product-page'] ) ? 1 : $_GET['product-page'] );

            if ( 1 < $page ) {
                $query_args['paged'] = $page;
            }

            if ( 'yes' !== $archive_settings['me_show_result_count'] ) {
                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
            }
        }
        $query_args['posts_per_page'] = intval( $archive_settings['me_columns'] * $archive_settings['me_rows'] );

        $query_args['fields'] = 'ids';
        return $query_args;
    }

    protected function set_ids_query_args( &$query_args ) {
        switch ( $this->settings['me_query_post_type'] ) {
            case 'by_id':
                $post__in = $this->settings['query_posts_ids'];
                break;
            case 'sale':
                $post__in = wc_get_product_ids_on_sale();
                break;
        }

        if ( ! empty( $post__in ) ) {
            $query_args['post__in'] = $post__in;
            remove_action( 'pre_get_posts', [ wc()->query, 'product_query' ] );
        }
    }

    protected function set_categories_query_args( &$query_args ) {
        $query_type = $this->settings['me_query_post_type'];

        if ( 'by_id' === $query_type || 'current_query' === $query_type ) {
            return;
        }

        if ( ! empty( $this->settings['query_product_cat_ids'] ) ) {
            $query_args['tax_query'][] = [
                'taxonomy' => 'product_cat',
                'terms' => $this->settings['query_product_cat_ids'],
                'field' => 'term_id',
            ];
        }
    }

    protected function set_tags_query_args( &$query_args ) {
        $query_type = $this->settings['me_query_post_type'];

        if ( 'by_id' === $query_type || 'current_query' === $query_type ) {
            return;
        }

        if ( ! empty( $this->settings['query_product_tag_ids'] ) ) {
            $query_args['tax_query'][] = [
                'taxonomy' => 'product_tag',
                'terms' => $this->settings['query_product_tag_ids'],
                'field' => 'term_id',
                'operator' => 'IN',
            ];
        }
    }

    protected function set_featured_query_args( &$query_args ) {
        if ( 'featured' === $this->settings['me_query_post_type'] ) {
            $master_visibiltiy = new Master_Woocommerce_Functions();
            $master_visibility_term_ids =  $master_visibiltiy::mw_wc_get_product_visibility_term_ids();

            $query_args['tax_query'][] = [
                'taxonomy' => 'product_visibility',
                'field' => 'term_taxonomy_id',
                'terms' => [ $master_visibility_term_ids['featured'] ],
            ];
        }
    }


}
