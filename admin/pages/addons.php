<?php

require_once \MasterElements:: plugin_dir() . 'addons/widgets.php';

$Master_Custom_Post = new \MasterElements\Modules\Theme_Builder\Master_Custom_Post();

$template_types = $Master_Custom_Post->register_sections();

$settings = $Master_Custom_Post->get_main_settings_data();


function get_me_settings_for_woo()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "me_settings";

    $value = $wpdb->get_var("SELECT value FROM " . $table_name . " where name='" . 'me_wooproduct' . "'");
    return $value;
}

?>

<div class="em-outer-section">

    <div class="em-option-boxes">

        <div class="active-widget-tpbox">

            <figure><img src="<?php echo \MasterElements::assets_url() . 'images/need-some-help.png' ?>" alt=""/>
            </figure>

            <div class="option-btn">

                <a href="#">Send Ticket</a>

            </div>

        </div>

        <div class="active-widget-cnt">

            <h3>Active Widget List</h3>

            <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,
                ultricies nec, pellentesque eu

                pretium quis, sem. Nulla consequat massa quis enim.

            </p>

        </div>

        <?php

        $widgetlist = register_addons_list();

        echo '<div class="em-switch-box-outer">';

        foreach ($widgetlist as $type) {


            $activation = (isset($settings[$type['id']]['name']) && $settings[$type['id']]['name'] = $type['id']) ? $settings[$type['id']]['value'] : 'no';


            ?>
            <?php
            $woo_value = get_me_settings_for_woo();

            if ($type['id'] == 'me_woo_products') {

                if ($woo_value == 'yes') {
                    ?>
                    <div class="em-switch-box">

                    <div class="master-switch-group ">


                        <label class="attr-input-label"><?php esc_html_e($type['name'], 'masterelements'); ?></label>

                        <div class="master-admin-input-switch me_settings">

                            <input type="checkbox" value="<?= $activation; ?>"
                                   class="master-admin-control-input master-template-activition master-active-<?= $activation; ?>"
                                   name="activation_val">

                            <label class="master-admin-control-label" for="master_activation_modal_input">
        
                                           <span class="master-admin-control-label-switch" data-active="ON"

                                                 data-inactive="OFF"></span>

                            </label>

                            <label type="hidden" name="type" class="type_filed" value="yes">

                                <label type="hidden" class="activation_filed" name="activation"
                                       value="yes">

                        </div>

                        <div class="info">
                            <a href="#">How to</a>
                        </div>

                    </div>

                    </div><?php
                } else {

                }
            } else {
                ?>
                <div class="em-switch-box">

                    <div class="master-switch-group ">


                        <label class="attr-input-label"><?php esc_html_e($type['name'], 'masterelements'); ?></label>

                        <div class="master-admin-input-switch me_settings">

                            <input type="checkbox" value="<?= $activation; ?>"
                                   class="master-admin-control-input master-template-activition master-active-<?= $activation; ?>"
                                   name="activation_val">

                            <label class="master-admin-control-label" for="master_activation_modal_input">
    
                                       <span class="master-admin-control-label-switch" data-active="ON"

                                             data-inactive="OFF"></span>

                            </label>

                            <input type="hidden" name="type" class="type_filed" value="<?= $type['id']; ?>">

                            <input type="hidden" class="activation_filed" name="activation"
                                   value="<?= (!empty($activation) ? $activation : 'yes?no'); ?>">

                        </div>

                        <div class="info">
                            <a href="#">How to</a>
                        </div>

                    </div>

                </div>


                <?php
            }

        } ?>

    </div>

</div>

</div>
