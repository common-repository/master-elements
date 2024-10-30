<?php

namespace MasterElements;



defined( 'ABSPATH' ) || exit; //exit if call directly.



class Notice {

    private static $_instance = null;

    public static function instance() { //create one instance of class (singleton)



        if ( is_null( self::$_instance ) ) {

            self::$_instance = new self();

        }

        return self::$_instance;

    }

    public static function sendParams($notice) {



        $args = [

            'type'             => 'info',

            'message'          => '',

            'class'            => 'notice',

            'dismissible'      => false,

            'btn'			   => [],

        ];

        $notice = wp_parse_args( $notice, $args ); //Merge user defined arguments into defaults array.

        $classes = [ 'notice' ]; //classes used for display message

        $classes[] = $notice['class'];

        if ( isset( $notice['type'] ) ) {

            $classes[] = 'notice-' . $notice['type'];

        }

        $notice['classes'] = implode( ' ', $classes ); //seperate class by space

        if (!file_exists(WP_PLUGIN_DIR . '/elementor/elementor.php') || is_plugin_inactive('elementor/elementor.php')) {
            self::displayNotice($notice); //display notice message
        }
        elseif (!file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php') || is_plugin_inactive('woocommerce/woocommerce.php')) {
            self::displayWooNotice($notice); //display notice message
        }
    }

    public static function displayNotice( $notice = [] ) {

        ?>


        <div class="<?php echo esc_attr( $notice['classes'] ); ?>">

            <div class="logo">

                <img src="<?php echo esc_url( \MasterElements::plugin_url() . 'assets/images/logo.png' ); ?>" alt="masterelements Logo" />

            </div>



            <div class="notice-content">

                <h3><?php esc_html_e( 'Thanks for installing Master Elements!', 'masterelements' ); ?></h3>

                <p>

                <p>Elementor required to Use Master Elements.</p>

                <a href="https://elementor.com/" target="_blank"><?php esc_html_e( 'What is Elementor?', 'masterelements' ); ?></a>

                </p>

            </div>



            <div class="btn">

                <a class="button button-primary" href="<?php echo esc_url($notice['btn']['url']); ?>"><i class="dashicons dashicons-download"></i><?php echo esc_html($notice['btn']['label']); ?></a>

            </div>

        </div>

        

        <?php

    }

    public static function displayWooNotice( $notice = [] ) {

        ?>



        <div class="<?php echo esc_attr( $notice['classes'] ); ?>">

            <div class="logo">

                <img src="<?php echo esc_url( \MasterElements::plugin_url() . 'assets/images/logo.png' ); ?>" alt="masterelements Logo" />

            </div>



            <div class="notice-content">

                <h3><?php esc_html_e( 'WooCommerce required to Use Master Elements.', 'masterelements' ); ?></h3>


                <a href="https://docs.woocommerce.com/" target="_blank"><?php esc_html_e( 'What is WooCommerce?', 'masterelements' ); ?></a>

                </p>

            </div>



            <div class="btn">

                <a class="button button-primary" href="<?php echo esc_url($notice['btn']['url']); ?>"><i class="dashicons dashicons-download"></i><?php echo esc_html($notice['btn']['label']); ?></a>

            </div>

        </div>

        

        <?php

    }

}

Notice::instance();