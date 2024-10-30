<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <?php if (!current_theme_supports('title-tag')) : ?>

        <title>

            <?php echo wp_get_document_title(); ?>

        </title>

    <?php endif; ?>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action('masterelements/template/before_header'); ?>

<div class="master-template-content-markup master-template-content-header master-template-content-theme-support">

    <?php
    $screen = get_current_screen();
    $template = \MasterElements\Modules\Theme_Builder\Init::template_ids();
    $elementor_instance = \Elementor\Plugin::instance();

    if (is_user_logged_in() && isset($_GET['elementor-preview'])) {
        echo apply_filters('the_content', $elementor_instance->frontend->get_builder_content_for_display($template[0]));
    } else {
        echo $elementor_instance->frontend->get_builder_content_for_display($template[0]);
    }
    ?>

</div>

<?php do_action('masterelements/template/after_header'); ?>

