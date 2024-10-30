<?php

$Master_Custom_Post = new \MasterElements\Modules\Theme_Builder\Master_Custom_Post();

$template_types = $Master_Custom_Post->register_sections();

$settings = $Master_Custom_Post->get_main_settings_data();



function missing_woocommmerce_notice()

{



    if (file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {



        $btn['label'] = esc_html__('Activate Woocommerce', 'masterelements');



        $btn['url'] = wp_nonce_url('plugins.php?action=activate&plugin=woocommerce/woocommerce.php&plugin_status=all&paged=1', 'activate-plugin_woocommerce/woocommerce.php');



    } else {



        $btn['label'] = esc_html__('Install Woocommerce', 'masterelements');



        $btn['url'] = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=woocommerce'), 'install-plugin_woocommerce');



    }



    \MasterElements\Notice::sendParams(



        [





            'type' => 'error',



            'dismissible' => true,



            'btn' => $btn,



            'message' => '',



        ]



    );



}





?>

<div class="em-outer-section">

    <form class="em-option-boxes">



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



        echo '<div class="result-box alert_success" id="result-box">Setting Updated</div>';

        echo '<div class="em-switch-box-outer">';



        foreach ($template_types as $type) {





            $activation = (isset($settings[$type['id']]['name']) && $settings[$type['id']]['name'] = $type['id']) ? $settings[$type['id']]['value'] : 'no';





            ?>



            <div class="em-switch-box">

                <div class="master-switch-group">

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



                        <?php

                        if (count($type['d_addons']) != 0) {

                            $sub_addon = implode(',',$type['d_addons']);

                            echo '<input type="hidden" name="type" class="sub_addons" value="' . $sub_addon . '">';

                        }





                        ?>



                        <input type="hidden" class="activation_filed" id="activation_filed" name="activation"

                               value="<?= (!empty($activation) ? $activation : 'yes?no'); ?>">

                    </div>

                </div>

            </div>



            <?php

        }

        ?>

</div>

</div>

<?php

if ($type['id'] == 'me_wooproduct' && $activation == 'yes') {

    if (file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php') && is_plugin_active('woocommerce/woocommerce.php')) {

        //echo "Active";

    } else {

        missing_woocommmerce_notice();

    }



}

?>

