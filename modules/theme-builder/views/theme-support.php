<?php

namespace MasterElements\Modules\Theme_Builder\Views;
use MasterElements\Master_Woocommerce_Functions;

//include_once \MasterElements::plugin_dir() . '/classes/master-woocommerce-functions.php'; //Woocommerce Functions

defined('ABSPATH') || exit;


class Theme_Support
{

    function __construct($template_ids)
    {
        global $wp;
        $master_woo_temp = new Master_Woocommerce_Functions();
        add_action('masterelements/template/header', [$this, 'get_header'], 2);

        add_action('masterelements/template/footer', [$this, 'get_footer'], 1000);

        if ($template_ids[0] != null) {

            add_action('get_header', [$this, 'get_header']);

        }

        if ($template_ids[1] != null) {

            add_action('get_footer', [$this, 'get_footer']);

        }

        if ($template_ids[2] != null && is_single()) {

            add_filter('template_include', array($this, 'get_single'), 4);

        }

        if ($template_ids[3] != null && is_archive()) {

            add_filter('template_include', array($this, 'get_archive'), 4);

        }

        if ($template_ids[4] != null && is_404()) {

            add_filter('template_include', array($this, 'get_404'), 4);

        }

        if ($template_ids[5] != null && $this->checkBlog()) {

            add_filter('template_include', array($this, 'get_blog'), 4);

        }

        if ($template_ids[6] != null && wp_maintenance()) {

            add_filter('template_include', array($this, 'get_maintenance'), 4);

        }

//        if ($template_ids[6] != null && is_section()) {
//
//            add_filter('template_include', array($this, 'get_section'), 4);
//
//        }

        if ($template_ids[6] != null && is_search()) {

            add_filter('template_include', array($this, 'get_search'), 4);

        }

        if ($template_ids[10] != null && $master_woo_temp::mw_single_product_page()) {

            add_filter('template_include', array($this, 'get_product'), 4);

        }
        if ($template_ids[10] != null && $master_woo_temp::mw_cart()) {

            add_filter('template_include', array($this, 'get_cart_page'), 4);

        }
        if ($template_ids[10] != null && $master_woo_temp::mw_shop()) {

            add_filter('template_include', array($this, 'get_shop_page'), 4);

        }
        if ($template_ids[10] != null && $master_woo_temp::mw_checkout()) {

            add_filter('template_include', array($this, 'get_checkout_page'), 4);

        }
        if ($template_ids[10] != null && $master_woo_temp::mw_account()) {

            add_filter('template_include', array($this, 'get_account_page'), 4);

        }
        if ($template_ids[11] != null && $master_woo_temp::mw_checkout() && !empty($wp->query_vars['order-received'])) {

            add_filter('template_include', array($this, 'get_thankyou_page'), 4);

        }

    }

    public function checkBlog()
    {
        if (!is_front_page() && is_home()) {
            // blog page
            return true;
        }
        return false;
    }

    public function get_header($name)
    {

        require __DIR__ . '/../views/theme-support-header.php';

        $templates = [];


        $name = (string)$name;


        remove_all_actions('wp_head');

        if ('' !== $name) {


            $templates[] = "header-{$name}.php";


        }

        $templates[] = 'header.php';

        ob_start();

        locate_template($templates, true);

        ob_get_clean();
    }


    public function get_footer($name)
    {

        require __DIR__ . '/../views/theme-support-footer.php';


        $templates = [];


        $name = (string)$name;


        if ('' !== $name) {


            $templates[] = "footer-{$name}.php";


        }

        $templates[] = 'footer.php';

        ob_start();

        locate_template($templates, true);


        ob_get_clean();

    }

    public function get_archive($name)
    {


        require __DIR__ . '/../views/theme-support-archive.php';


    }

    public function get_single($name)
    {


        require __DIR__ . '/../views/theme-support-single.php';


    }

    public function get_404($name)
    {


        require __DIR__ . '/../views/theme-support-404.php';


    }

    public function get_blog($name)
    {


        require __DIR__ . '/../views/theme-support-single.php';


    }

    public function get_maintenance($name)
    {


        require __DIR__ . '/../views/theme-support-single.php';


    }

    public function get_section($name)
    {


        require __DIR__ . '/../views/theme-support-section.php';

    }

    public function get_search($name)
    {


        require __DIR__ . '/../views/theme-support-search.php';


    }

    public function get_product($name)
    {


        require __DIR__ . '/../views/theme-support-product.php';


    }

    public function get_cart_page($name)
    {


        require __DIR__ . '/../views/theme-support-product.php';


    }

    public function get_shop_page($name)
    {


        require __DIR__ . '/../views/theme-support-product.php';


    }

    public function get_checkout_page($name)
    {
        //echo '<pre> Support '. $name . '</pre>';

        require __DIR__ . '/../views/theme-support-product.php';


    }

    public function get_account_page($name)
    {
        //echo '<pre> Support '. $name . '</pre>';
        require __DIR__ . '/../views/theme-support-product.php';

    }

    public function get_thankyou_page($name)
    {
        //echo '<pre> Support '. $name . '</pre>';
        require __DIR__ . '/../views/theme-support-woo-thankyou.php';

    }

}