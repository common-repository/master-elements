<?php
global $wp;
$mw = new \MasterElements\Master_Woocommerce_Functions();
do_action('masterelements/template/header');
?>


    <div class="master-template-content-markup master-template-content-single master-template-content-theme-support">


        <?php

        if ($mw::mw_checkout() && empty($wp->query_vars['order-received'])) {
            echo '<form name="checkout" method="post" class="checkout woocommerce-checkout" enctype="multipart/form-data" novalidate="novalidate">';
            $template = \MasterElements\Modules\Theme_Builder\Init::template_ids();

            $elementor_instance = \Elementor\Plugin::instance();

            echo $elementor_instance->frontend->get_builder_content_for_display($template[10]);
        } else {
            $template = \MasterElements\Modules\Theme_Builder\Init::template_ids();

            $elementor_instance = \Elementor\Plugin::instance();

            echo $elementor_instance->frontend->get_builder_content_for_display($template[10]);
        }
        ?>


    </div>


<?php do_action('masterelements/template/footer'); ?>