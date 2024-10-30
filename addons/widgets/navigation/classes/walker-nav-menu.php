<?php

use \Elementor\Controls_Manager;

class Master_Menu_Walker extends Walker_Nav_Menu
{
    public $menu_Settings;

    // custom methods
    public function get_item_meta($menu_item_id)
    {
        $meta_key = 'me_megamenu_item';
        $data = get_post_meta($menu_item_id, $meta_key, true);
        $data = (array)json_decode($data);
        $format = [
            "menu_id" => null,
            "menu_has_child" => '',
            "menu_enable" => 0,
            "menu_icon" => '',
            "menu_icon_color" => '',
            "menu_badge_text" => '',
            "menu_badge_color" => '',
            "menu_badge_background" => '',
            "mobile_submenu_content_type" => 'builder_content'
        ];
        return array_merge($format, $data);
    }

    public function is_megamenu($menu)
    {
        if (is_object($menu)) {
            $menu = $menu->slug;
        }
        $cache_key = 'master_megamenu_data_' . $menu;
        $cached = wp_cache_get($cache_key);
        if (false !== $cached) {
            return $cached;
        }
//        $return = 0;

//        $modules_active = get_option('module_list', \MasterElements::default_modules());
//        $settings = Attr::instance()->utils->get_option(Init::$megamenu_settings_key, []);
//        $term = get_term_by('slug', $menu, 'nav_menu');

//        if (in_array('megamenu', $modules_active)) {
        $return = 1;
//        }
        wp_cache_set($cache_key, $return);
        return $return;
    }

    public function is_megamenu_item($item_meta, $menu)
    {
        if ($this->is_megamenu($menu) == 1 && class_exists('Elementor\Plugin')) {
            return true;
        }
        return false;
    }

    /**
     * Starts the list before the elements are added.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of menu item. Used for padding.
     * @param array $args An array of arguments. @see wp_nav_menu()
     * @since 3.0.0
     *
     * @see Walker::start_lvl()
     *
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"master-dropdown master-submenu-panel\">\n";
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of menu item. Used for padding.
     * @param array $args An array of arguments. @see wp_nav_menu()
     * @since 3.0.0
     *
     * @see Walker::end_lvl()
     *
     */
    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * Start the element output.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param array $args An array of arguments. @see wp_nav_menu()
     * @param int $id Current item ID.
     * @since 3.0.0
     *
     * @see Walker::start_el()
     *
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        /**
         * Filter the CSS class(es) applied to a menu item's list item element.
         *
         * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param object $item The current menu item.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));

        // New
        $class_names .= ' nav-item';
        $item_meta = $this->get_item_meta($item->ID);
        $is_megamenu_item = $this->is_megamenu_item($item_meta, $args->menu);

        if (in_array('menu-item-has-children', $classes) || $is_megamenu_item == true) {
            $class_names .= ' master-dropdown-has';
        }
        if ($is_megamenu_item == true) {
            $class_names .= ' master-megamenu-has';
        }
        if ($item_meta['mobile_submenu_content_type'] == 'builder_content') {
            $class_names .= ' master-mobile-builder-content';
        }
        if (in_array('current-menu-item', $classes)) {
            $class_names .= ' active';
        }
        //

        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        /**
         * Filter the ID applied to a menu item's list item element.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param object $item The current menu item.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        // New
        //
        $output .= $indent . '<li' . $id . $class_names . '>';
        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $submenu_indicator = '';

        // New
        if ($depth === 0) {
            $atts['class'] = 'me-menu-nav-link';
        }
        if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
            $atts['class'] .= ' me-menu-dropdown-toggle';
        }
        if (in_array('menu-item-has-children', $classes) || $is_megamenu_item == true) {
            $submenu_indicator .= '<i class="master-submenu-indicator"></i>';
        }
        if ($depth > 0) {
            $manual_class = array_values($classes)[0] . ' ' . 'dropdown-item';
            $atts ['class'] = $manual_class;
        }
        if (in_array('current-menu-item', $item->classes)) {
            $atts['class'] .= ' active';
        }

        // print_r($item);
        //
        /**
         * Filter the HTML attributes applied to a menu item's anchor element.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         * @type string $title Title attribute.
         * @type string $target Target attribute.
         * @type string $rel The rel attribute.
         * @type string $href The href attribute.
         * }
         * @param object $item The current menu item.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        $attributes = '';

        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $item_output = $args->before;

        // New
        /*
        if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
            $item_output .= '<a class="nav-link dropdown-toggle"' . $attributes .'data-toggle="dropdown">';
        } elseif ($depth === 0) {
            $item_output .= '<a class="nav-link"' . $attributes .'>';
        } else {
            $item_output .= '<a class="dropdown-item"' . $attributes .'>';
        }
        */
        //

        $item_output .= '<a' . $attributes . '>';
        if ($this->is_megamenu($args->menu) == 1) {
            // add badge text
            if ($item_meta['menu_badge_text'] != '') {
                $badge_style = 'background:' . $item_meta['menu_badge_background'] . '; color:' . $item_meta['menu_badge_color'];
                $badge_carret_style = 'border-top-color:' . $item_meta['menu_badge_background'];
                $item_output .= '<span style="' . $badge_style . '" class="me-menu-badge">' . $item_meta['menu_badge_text'] . '<i style="' . $badge_carret_style . '" class="me-menu-badge-arrow"></i></span>';
            }
            // add menu icon & style
            if ($item_meta['menu_icon'] != '') {
                $icon_style = 'color:' . $item_meta['menu_icon_color'];
                $item_output .= '<i class="me-menu-icon ' . $item_meta['menu_icon'] . '" style="' . $icon_style . '" ></i>';
            }
        }
        /** This filter is documented in wp-includes/post-template.php */
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= $submenu_indicator . '</a>';
        $item_output .= $args->after;
        /**
         * Filter a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param object $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         * @since 3.0.0
         *
         */
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Ends the element output, if needed.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     * @param array $args An array of arguments. @see wp_nav_menu()
     * @see Walker::end_el()
     *
     * @since 3.0.0
     *
     */
    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        if ($depth === 0) {

            global $wpdb;
            $table_name = $wpdb->prefix . "me_settings";
            $result = $wpdb->get_row("SELECT * FROM " . $table_name . " where name='me_megamenu'");
            if ($result) {
                if ($result->value == 'yes') {

                    if ($this->is_megamenu($args->menu) == 1) {
                        $item_meta = $this->get_item_meta($item->ID);
                        if (class_exists('Elementor\Plugin')) {

                            $output .= '<ul class="master-megamenu-panel">';
                            if (isset($item_meta[0])) {
                                $post = get_post($item_meta[0]);
                                $content = apply_filters('the_content', $post->post_content);

                                if ($content != null) {
                                    $elementor = Elementor\Plugin::instance();
                                    $output .= $elementor->frontend->get_builder_content_for_display($item_meta[0]);
                                } else {
                                    $output .= esc_html__('No content found', 'master');
                                }
                            }
                            $output .= '</ul>';
                        }
                    }

                    $output .= "</li>\n";
                }
            }
        }
    }
}
