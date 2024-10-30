jQuery(document).ready(function () {
    jQuery('#drawer').click(function () {
        jQuery('.master-nav-menu').toggle("slide");
    });
});
var offset = jQuery('.stickys').attr('data-scroll-offset');
var animation = jQuery('.stickys').attr('data-animate');
var duration = jQuery('.stickys').attr('data-duration');
var isSticky = jQuery('.elementor-widget-master-navigation').data("settings");

if (duration == 'normal') {
    duration = "";
}
if (offset == '') {
    offset = 50;
}

// Set Screen Width
w = jQuery(window).width();
y = jQuery('.master-nav-header').width();

s = (w - y) / 2;
jQuery('#main-menu').find('.elementor-top-section').css("width", w);
jQuery('#main-menu').find('.elementor-top-section').css("right", s);

jQuery(window).on('scroll', function (event) {
    var scrollValue = jQuery(window).scrollTop();

    if (isSticky?.master_navigation_sticky_switcher == 'yes') {
        if (scrollValue >= offset) {
            jQuery('.stickys').addClass('master-sticky-header');
            jQuery('.stickys').addClass(animation);
            jQuery('.stickys').addClass(duration);
        } else {
            jQuery('.stickys').removeClass('master-sticky-header');
            jQuery('.stickys').removeClass(animation);
            jQuery('.stickys').removeClass(duration);
        }
    }
});
