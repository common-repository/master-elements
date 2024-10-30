<?php

namespace MasterElements\Modules\Manager;

use Elementor\Plugin;
use Elementor\Widget_Base;

defined('ABSPATH') || exit;

class Api extends Widget_Base
{

    public function get_name()
    {
        return 'widget';
    }

    public function render_widget($url, $post_type)
    {
        $source = Plugin::$instance->templates_manager->get_source('local');
        $result = $source->import_template(basename($url), $url);

        $post = array(
            'ID' => $result[0]['template_id'],
            'post_type' => $post_type
        );
        wp_update_post($post, true);

        $data = [
            'status' => 200,
            'message' => 'Imported'
        ];

        echo json_encode($data, true);
        die;
    }

}