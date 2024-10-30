<?phpnamespace MasterElements;defined('ABSPATH') || exit;class Master_Custom_Meta_Box{    /**     * Constructor.     */    public function __construct()    {        if (is_admin()) {            add_action('load-post.php', array($this, 'init_metabox'));            add_action('load-post-new.php', array($this, 'init_metabox'));        }        add_filter('manage_metemplate_posts_columns', [$this, 'add_new_columns']);        add_action('manage_metemplate_posts_custom_column', [$this, 'custom_column_data']);    }    /**     * Meta box initialization.     */    public function init_metabox()    {        add_action('add_meta_boxes', array($this, 'add_metabox'));        add_action('save_post', array($this, 'save_metabox'), 10, 2);    }    /**     * Adds the meta box.     */    public function add_metabox()    {        add_meta_box(            'metemplate-condition',            __('Conditions', 'textdomain'),            array($this, 'render_metabox'),            'metemplate',            'side',            'high'        );    }    /**     * Renders the meta box.     */    public function render_metabox($post)    {        // Add nonce for security and authentication.        wp_nonce_field('custom_nonce_action', 'custom_nonce');        $type = get_post_meta($post->ID, 'type', true);        $activation = get_post_meta($post->ID, 'activation', true);        $condition_a = get_post_meta($post->ID, 'condition_a', true);        $condition_singular = get_post_meta($post->ID, 'condition_singular', true);        $condition_singular_id = get_post_meta($post->ID, 'condition_singular_id', true);        ?>        <div class="master-switch-group">            <label class="attr-input-label"><?php esc_html_e('Activition:', 'masterelements'); ?></label>            <div class="master-admin-input-switch">                <input type="checkbox" value="<?= $activation; ?>"                       class="master-admin-control-input master-template-activition master-active-<?= $activation; ?>"                       name="activation_val" id="master_activation_input">                <label class="master-admin-control-label" for="master_activation_modal_input">									<span class="master-admin-control-label-switch" data-active="ON"                                          data-inactive="OFF"></span>                </label>                <input type="hidden" id="activation_filed" name="activation"                       value="<?= (!empty($activation) ? $activation : 'no'); ?>">            </div>        </div>        <div class="master-input-group">            <label class="attr-input-label"><?php esc_html_e('Type:', 'masterelements'); ?></label>            <select name="type" class="master-template-type attr-form-control">                <option value="header" <?php selected($type, 'header', true); ?>><?php esc_html_e('Header', 'masterelements'); ?></option>                <option value="footer" <?php selected($type, 'footer', true); ?>><?php esc_html_e('Footer', 'masterelements'); ?></option>                <option value="single" <?php selected($type, 'single', true); ?>><?php esc_html_e('Single', 'masterelements'); ?></option>                <option value="archive" <?php selected($type, 'archive', true); ?>><?php esc_html_e('Archive', 'masterelements'); ?></option>            </select>        </div>        <div class="master-template-option-container ">            <div class="master-input-group">                <label class="attr-input-label"><?php esc_html_e('Conditions:', 'masterelements'); ?></label>                <select name="condition_a" class="master-template-condition_a attr-form-control">                    <?php if ($_GET['post_type'] == 'me_archive'): ?>                        <option value="archive"                                class="disabled" <?php selected($condition_a, 'archive', true); ?>><?php esc_html_e('Archive ', 'masterelements'); ?></option>                    <?php else: ?>                        <option value="entire_site" <?php selected($condition_a, 'entire_site', true); ?>><?php esc_html_e('Entire Site', 'masterelements'); ?></option>                        <option value="singular" <?php selected($condition_a, 'singular', true); ?>><?php esc_html_e('Singular ', 'masterelements'); ?></option>                        <option value="archive" <?php selected($condition_a, 'archive', true); ?>><?php esc_html_e('Archive ', 'masterelements'); ?></option>                    <?php endif; ?>                </select>            </div>            <?php            $display = 'block';            if ($condition_a != 'singular') {                $display = 'none';            } ?>            <div class="master-input-group condition_singular" style="display: <?= $display; ?>">                <label class="attr-input-label"></label>                <select name="condition_singular" class="master-template-condition_singular attr-form-control">                    <option value="all" <?php selected($condition_singular, 'all', true); ?>><?php esc_html_e('All Singulars', 'masterelements'); ?></option>                    <option value="front_page" <?php selected($condition_singular, 'front_page', true); ?>><?php esc_html_e('Front Page', 'masterelements'); ?></option>                    <option value="all_posts" <?php selected($condition_singular, 'all_posts', true); ?>><?php esc_html_e('All Posts', 'masterelements'); ?></option>                    <option value="all_pages" <?php selected($condition_singular, 'all_pages', true); ?>><?php esc_html_e('All Pages', 'masterelements'); ?></option>                    <option value="404page" <?php selected($condition_singular, '404page', true); ?>><?php esc_html_e('404 Page', 'masterelements'); ?></option>                    <option value="selective" <?php selected($condition_singular, 'selective', true); ?>><?php esc_html_e('Selective Singular', 'masterelements'); ?></option>                </select>            </div>            <br>            <?php            $display = 'block';            if ($condition_singular != 'selective') {                $display = 'none';            } ?>            <div class="master-template-condition_singular_id-container condition_singular_id"                 style="display: <?= $display; ?>">                <div class="master-input-group">                    <label class="attr-input-label"></label>                    <select multiple name="condition_singular_id[]"                            class="master-template-modalinput-condition_singular_id select2">                        <?php                        $postids = array();                        if (!empty($condition_singular_id)) {                            $postids = explode(',', $condition_singular_id);                        }                        $args = array(                            'public' => true,                        );                        $output = 'names'; // 'names' or 'objects' (default: 'names')                        $operator = 'and'; // 'and' or 'or' (default: 'and')                        $post_types = get_post_types($args, $output, $operator);                        if ($post_types) { // If there are any custom public post types.                            foreach ($post_types as $post_type) {                                $args = array(                                    'numberposts' => -1,                                    'post_type' => $post_type                                );                                $ecpt = array('metemplate', 'elementor_library', 'attachment');                                if (!in_array($post_type, $ecpt)) {                                    $posts = get_posts($args);                                    if ($posts) {                                        foreach ($posts as $post) :                                            setup_postdata($post);                                            $selected = '';                                            if (in_array($post->ID, $postids)) {                                                $selected = "selected";                                            }                                            echo '<option value="' . $post->ID . '" ' . $selected . ' >' . $post->post_title . '</option>';                                        endforeach;                                        wp_reset_postdata();                                    }                                }                            }                        }                        ?>                    </select>                </div>                <br/>            </div>            <br>        </div>        <?php    }    public function save_metabox($post_id, $post)    {        // Add nonce for security and authentication.        $nonce_name = isset($_POST['custom_nonce']) ? $_POST['custom_nonce'] : '';        $nonce_action = 'custom_nonce_action';        // Check if nonce is valid.        if (!wp_verify_nonce($nonce_name, $nonce_action)) {            return;        }        // Check if user has permissions to save data.        if (!current_user_can('edit_post', $post_id)) {            return;        }        // Check if not an autosave.        if (wp_is_post_autosave($post_id)) {            return;        }        // Check if not a revision.        if (wp_is_post_revision($post_id)) {            return;        }        if (isset($_POST['type'])) {            update_post_meta($post_id, 'type', $_POST['type']);        }        if (isset($_POST['condition_a'])) {            update_post_meta($post_id, 'condition_a', $_POST['condition_a']);        }        if ($_POST['condition_a'] == 'singular') {            if (isset($_POST['condition_singular'])) {                update_post_meta($post_id, 'condition_singular', $_POST['condition_singular']);            }            if (isset($_POST['condition_singular_id'])) {                update_post_meta($post_id, 'condition_singular_id', implode(',', $_POST['condition_singular_id']));            }        } else {            update_post_meta($post_id, 'condition_singular', '');            update_post_meta($post_id, 'condition_singular_id', '');        }        update_post_meta($post_id, 'activation', $_POST['activation']);    }    public function add_new_columns($columns)    {        return array_merge($columns,            array('type' => __('Type'),                'condition' => __('Condition')));    }    function custom_column_data($column)    {        global $post;        switch ($column) {            case 'type':                echo get_post_meta($post->ID, 'type', true);                $activation = get_post_meta($post->ID, 'activation', true);                echo '<span class="master-status master-status-' . ($activation == 'yes' ? 'active' : 'inactive') . '">' . ($activation == 'yes' ? 'Active' : 'Inactive') . '</span>';                break;            case 'condition':                //echo get_post_meta( $post->ID , 'c' , true );                echo $condition_a = get_post_meta($post->ID, 'condition_a', true);                $condition_singular = get_post_meta($post->ID, 'condition_singular', true);                if ($condition_a == 'singular') {                    echo ' > ' . $condition_singular;                }                if ($condition_singular == 'selective') {                    echo ' > ' . get_post_meta($post->ID, 'condition_singular_id', true);                }                break;        }    }}new Master_Custom_Meta_Box();