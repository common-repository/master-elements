<?php

namespace MasterElements;


use Elementor\Plugin;

defined('ABSPATH') || exit; //exit if call directly.


class Master_Woocommerce_Functions
{
    //Woocommerce Pages Functions
    static function mw_single_product_page()
    {
        return is_product();
    }

    static function mw_shop()
    {
        return is_shop();
    }

    static function mw_cart()
    {
        return is_cart();
    }

    static function mw_checkout()
    {
        return is_checkout();
    }

    static function mw_account()
    {
        return is_account_page();
    }

    //Wocommerce Settings Fucntion

    static function mw_session()
    {
        return WC()->session;
    }

    static function mw_wc_notices()
    {
        return wc_print_notices();
    }

    static function mw_wc_query()
    {
        return wc()->query;
    }

    static function mw_wc_get_product_visibility_term_ids()
    {
        return wc_get_product_visibility_term_ids();
    }

    static function mw_wc_get_product()
    {
        return wc_get_product();
    }

    static function mw_wc_placeholder_img_src()
    {
        return wc_placeholder_img_src();
    }

    static function mw_product_sale_flash()
    {
        return woocommerce_show_product_sale_flash();
    }

    static function mw_product_images()
    {
        return woocommerce_show_product_images();
    }

    static function mw_template_single_meta()
    {
        return woocommerce_template_single_meta();
    }

    static function mw_template_single_price()
    {
        return woocommerce_template_single_price();
    }

    static function mw_get_rating($average, $count)
    {
        return wc_get_rating_html($average, $count);
    }

    static function mw_get_stock($get_id)
    {
        return wc_get_stock_html($get_id);
    }

    static function mw_product_summary()
    {
        return woocommerce_template_single_excerpt();
    }

    static function mw_product_title()
    {
        return woocommerce_template_single_title();
    }

    static function mw_product_data_tabs()
    {
        return wc_get_template('single-product/tabs/tabs.php');
    }

    static function mw_checkout_order_review()
    {
        return woocommerce_order_review();
    }

    static function mw_wc_get_order($order_id)
    {
        return wc_get_order($order_id);
    }

    static function mw_wc_get_order_statuses()
    {
        return wc_get_order_statuses();
    }

    static function mw_wc_frontend()
    {
        return WC()->frontend_includes();
    }


    // Woocommerce Shop Functions

    static function mw_calculate_total()
    {
        $mw_cart = \WC()->cart->calculate_totals();
        return $mw_cart;
    }

    static function mw_calculate_shipping()
    {
        $mw_shipping = \WC()->cart->calculate_shipping();
        return $mw_shipping;
    }

    static function mw_cart_empty()
    {
        $mw_empty = \WC()->cart->is_empty();
        return $mw_empty;
    }

    static function mw_cart_totals()
    {
        return woocommerce_cart_totals();
    }

    static function mw_wc_checkout()
    {
        return WC()->checkout();
    }

    static function mw_checkout_payments()
    {
        return woocommerce_checkout_payment();
    }

    static function mw_wc_cart()
    {
        return WC()->cart;
    }

    static function mw_wc_get_cart()
    {
        return WC()->cart->get_cart();
    }

    static function mw_get_cart_url()
    {
        return wc_get_cart_url();
    }

    static function mw_add_action($hook)
    {
        return do_action($hook);
    }

    static function mw_get_cart_remove_url($hook)
    {
        return wc_get_cart_remove_url($hook);
    }

    static function mw_get_sku($object)
    {
        return $object->get_sku();
    }

    static function mw_get_image($object)
    {
        return $object->get_image();
    }

    static function mw_get_name($object)
    {
        return $object->get_name();
    }

    static function mw_backorders_require_notification($object)
    {
        return $object->backorders_require_notification();
    }

    static function mw_is_sold_individually($object)
    {
        return $object->is_sold_individually();
    }

    static function mw_get_max_purchase_quantity($object)
    {
        return $object->get_max_purchase_quantity();
    }

    static function mw_kses_post($object)
    {
        return wp_kses_post($object);
    }

    static function mw_get_formatted_cart_item_data($object)
    {
        return wc_get_formatted_cart_item_data($object);
    }

    static function mw_is_ajax()
    {
        return is_ajax();
    }

    static function mw_is_is_edit_mode()
    {
        return Plugin::instance()->editor->is_edit_mode();
    }

    static function mw_is_user_logged_in()
    {
        return is_user_logged_in();
    }

    static function mw_unslash($key)
    {
        return wp_unslash($key);
    }

    static function mw_lost_password_url()
    {
        return wp_lostpassword_url();
    }

    static function mw_get_option($key)
    {
        return get_option($key);
    }

    static function mw_get_templates($key, $args)
    {
        return wc_get_template($key, $args);
    }

    static function mw_get_current_user_id()
    {
        return get_current_user_id();
    }


}
