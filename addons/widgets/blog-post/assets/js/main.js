(function ($) {

    "use strict";

    function me_blog_posts_owl() {
        if ($().owlCarousel) {
            $('.me-posts-wrap.has-carousel').each(function () {
                var
                    $root = $(this),
                    item = $root.data("column"),
                    item2 = $root.data("column2"),
                    item3 = $root.data("column3"),
                    spacer = Number($root.data("spacer")),
                    prev_icon = $root.data("prev_icon"),
                    next_icon = $root.data("next_icon");

                var loop = false;
                if ($root.data("loop") == 'yes') {
                    loop = true;
                }

                var arrow = false;
                if ($root.data("arrow") == 'yes') {
                    arrow = true;
                }

                var auto = false;
                if ($root.data("auto") == 'yes') {
                    auto = true;
                }

                $root.find('.owl-carousel').owlCarousel({
                    loop: loop,
                    margin: spacer,
                    nav: true,
                    pagination: false,
                    autoplay: auto,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    animateIn: 'fadeIn',
                    animateOut: 'fadeOut',
                    navText: ["<i class=\"" + prev_icon + "\"></i>", "<i class=\"" + next_icon + "\"></i>"],
                    responsive: {
                        0: {
                            items: item3
                        },
                        768: {
                            items: item2
                        },
                        1000: {
                            items: item
                        }
                    }
                });

            });
        }
    };

    function me_blog_load_more() {

        var $con_wrap = $('.me-posts-wrap');
        var $con = $('.me-posts-wrap').find('.me-posts');

        $('.navigation.loadmore a').on('click', function (e) {
            e.preventDefault();

            $con.after('<div class="tfpost-loading"><span></span></div>');

            $.ajax({
                type: "GET",
                url: $(this).attr('href'),
                dataType: "html",
                success: function (out) {
                    var result = $(out).find('.column');
                    var nextlink = $(out).find('.navigation.loadmore a').attr('href');

                    result.css({opacity: 0, visibility: 'hidden'});
                    if ($con.hasClass('masonry')) {
                        $con.append(result).imagesLoaded(function () {
                            result.css({opacity: 1, visibility: 'visible'});
                            $con.isotope('appended', result);
                        });
                    }
                    else {
                        $con.append(result).imagesLoaded(function () {
                            result.css({opacity: 1, visibility: 'visible'});
                            $con.isotope('appended', result);
                        });
                    }

                    if (nextlink != undefined) {
                        $('.navigation.loadmore a').attr('href', nextlink);
                        $con_wrap.find('.tfpost-loading').remove();
                    } else {
                        $con_wrap.find('.tfpost-loading').addClass('no-ajax').text('All posts loaded').delay(2000).queue(function () {
                            $(this).remove();
                        });
                        $('.navigation.loadmore a').remove();
                    }
                }
            });
        });

    };

    function me_blog_masonry() {
        $('.me-posts-wrap .me-posts').each(function () {
            var $root = $(this);
            if ($root.hasClass('masonry')) {
                var $grid = $root.isotope({
                    itemSelector: '.column',
                    percentPosition: true,
                    masonry: {
                        columnWidth: '.grid-sizer'
                    }
                });

                $grid.imagesLoaded().progress(function () {
                    $grid.isotope('layout');
                });
            }
        });
    };


    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tfposts.default', me_blog_posts_owl());
        elementorFrontend.hooks.addAction('frontend/element_ready/tfposts.default', me_blog_load_more());
        elementorFrontend.hooks.addAction('frontend/element_ready/tfposts.default', me_blog_masonry());
    });

})(jQuery);
