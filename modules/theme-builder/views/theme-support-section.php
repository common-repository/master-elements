<?phpdo_action('masterelements/template/header'); ?>    <div class="master-template-content-markup master-template-content-section master-template-content-theme-support">        <?php        $screen = get_current_screen();        $template = \MasterElements\Modules\Theme_Builder\Init::template_ids();        $elementor_instance = \Elementor\Plugin::instance();        if (is_admin() && isset($_GET['elementor-preview'])) {            echo apply_filters('the_content', $elementor_instance->frontend->get_builder_content_for_display($template[7]));        } else {            echo $elementor_instance->frontend->get_builder_content_for_display($template[7]);        }        ?>    </div><?phpdo_action('masterelements/template/footer');?>