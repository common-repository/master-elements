<?php
namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Embed;
use Elementor\Plugin;
use WooCommerce\Functions;
if ( ! defined( 'ABSPATH' ) ) exit;



class Master_Woo_Product_Comments extends Widget_Base
{

    private static $product_id = null;


    public function __construct($data = [], $args = null)
    {


        parent::__construct($data, $args);



    }

    public function get_name()
    {

        return 'woo-product-comments';

    }

    public function get_title()
    {

        return __('MW: Product Comments', 'masterelements');

    }

    public function get_categories()
    {

        return array('master-addons');

    }

    public function get_icon()
    {

        return 'eicon-table';

    }
    protected function render()
    {
        $master_product_comments = new Master_Woocommerce_Functions();
        global $product;
        $product = $master_product_comments::mw_wc_get_product();

        $args = array (
            'post_type' => 'product',
            'post_ID' =>$product->id,  // Product Id
            'status' => "approve", // Status you can also use 'hold', 'spam', 'trash',
            'number' => 1  // Number of comment you want to fetch I want latest approved post soi have use 1
        );
        $comments = get_comments($args);
    }

}
