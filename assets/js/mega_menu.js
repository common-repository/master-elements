jQuery(window).on('load', function (event) {
    jQuery(document).ready(function (m) {

        m.ajax({
            url: frontend_ajax_object.ajaxurl,
            type: 'get',
            data: {
                'action': 'check_module_active',
                'module': 'me_' + 'megamenu',
            },
            success: function (response) {
                if (response == "yes") {

                    add_megamenu_tag();
                }
            },
        });

        function add_megamenu_tag() {

            m.ajax({
                url: frontend_ajax_object.ajaxurl,
                type: 'get',
                data: {
                    'action': 'get_megamenu_control',
                    'menu': m('#menu-name').val(),
                },
                success: function (response) {

                    console.log(response);
                    if (response == 'null') {
                        m("#menu-management #post-body").prepend('<div class="enable-mega-menu" >\n' +
                            '<input name="is_enabled" onclick="change_mega_menu_control()" type="checkbox"' +
                            ' id="master-menu-metabox-input-is-enabled" class="master-menu-is-enabled" value="0">\n' +
                            '<label for="master-menu-metabox-input-is-enabled">Enable Megamenu</label>\n' +
                            '</div>');

                    } else {
                        response = JSON.parse(response);
                        m("#menu-management #post-body").prepend('<div class="enable-mega-menu" >\n' +
                            '<input name="is_enabled" onclick="change_mega_menu_control()" type="checkbox" ' +
                            (response.value == 'yes' ? 'checked' : '') + ' id="master-menu-metabox-input-is-enabled" class="master-menu-is-enabled" value="0">\n' +
                            '<label for="master-menu-metabox-input-is-enabled">Enable Megamenu</label>\n' +
                            '</div>');

                        if (response.value == 'yes') {
                            m("#menu-to-edit li").each(function () {
                                let t = m(this);
                                if (t.find(".master_menu_trigger").length < 1) {
                                    m(".item-title", t).append("<a data-toggle='modal' id=" + this.id + " " +
                                        "data-target='#attr_menu_control_panel_modal' href='#' class='master_menu_trigger'>Mega Menu</a> ")
                                }
                            });
                        }
                    }

                }
            });

            m("#menu-to-edit").on("click", ".master_menu_trigger", function (n) {
                let item_id = this.id;
                m.ajax({
                    url: frontend_ajax_object.ajaxurl,
                    type: 'GET',
                    data: {
                        'action': 'get_menu_template',
                        'module': 'me_' + 'megamenu',
                        'menu': item_id,
                    },
                    success: function (response) {

                        m("body").append('<div class="modal fade" id="select_mega_menu" role="dialog">\n' +
                            '    <div class="modal-dialog modal-lg">\n' +
                            '      <div class="modal-content">\n' +
                            '        <div class="modal-header">\n' +
                            '          <button type="button" class="close" data-dismiss="modal">&times;</button>\n' +
                            '          <h4 class="modal-title">Select Mega Menu</h4>\n' +
                            '        </div>\n' +
                            '        <div class="modal-body">\n' +
                            '          <p>Select Mega Menu.</p>\n' +
                            '          <div class="custom-select" style="width:200px;">\n' +
                            '  <select class="template-menu">\n' +
                            '  </select>\n' +
                            '</div>\n' +
                            '        </div>\n' +
                            '        <div class="modal-footer">\n' +
                            '<button onclick="save_menu_changes()" type="button" class="btn btn-primary custom_chck_btn">Save Changes</button>\n' +
                            '          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>\n' +
                            '        </div>\n' +
                            '      </div>'
                        );

                        let check = JSON.parse(response);
                        m('.template-menu').empty();
                        if (check.length != 0) {
                            m.each(check, function (index, value) {
                                m('.template-menu').append("<option " + ('menu-item-' + value.menu_item == item_id ? 'selected' : '') + " value=" + value.ID + '_' + item_id + ">" + value.post_title + "</option>");
                            });
                        } else {
                            m('.template-menu').append('<option>No Menu Template</option>');
                        }

                        m("#select_mega_menu").modal();
                    },
                });
            });
        }
    });
});

function change_mega_menu_control() {
    jQuery.ajax({
        url: frontend_ajax_object.ajaxurl,
        type: 'get',
        data: {
            'action': 'save_me_settings',
            'type': jQuery('#menu-name').val(),
            'status': (jQuery('#master-menu-metabox-input-is-enabled').is(':checked')) ? "yes" : "no",
        },
        success: function (response) {
            location.reload();
        },
    });
}

function save_menu_changes() {

    let ids = jQuery('.template-menu').val();
    ids = ids.split('_');

    jQuery.ajax({
        url: frontend_ajax_object.ajaxurl,
        type: 'post',
        data: {
            'action': 'save_menu_postmeta',
            'megamenu_id': ids[0],
            'menu_id': ids[1],
        },
        success: function (response) {
            jQuery("#select_mega_menu").modal('hide');
        },
    });
}