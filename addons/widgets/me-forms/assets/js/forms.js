(function ($){
    $(document).ready(function (m) {

        m('form.me-contact-form').on('click', '.me-submit-btn', function (event) {

            // set ajax data
            console.log(m(this).parents('form.me-contact-form').serialize());
            var data = {
                'action': 'custom_submit_form',
                'fileds': m(this).parents('form.me-contact-form').serialize(),
            };

            // m.post(settings.ajaxurl, data, function (response) {
            m.post(MS_Ajax.ajaxurl, data, function (response) {

                console.log('ok');

            });

        });

    });
});
