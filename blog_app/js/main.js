/*=============================================
                  NAV BAR
==============================================*/

$(document).ready(function() {
    $('.menu-toggle').on('click', function() {
        $('.nav').toggleClass('showing ');
        $('.nav ul').toggleClass('ul-showing ');
    })
});

/*=============================================
                   TESTIMONIALS
==============================================*/
$(document).ready(function() {
    $('.post-wrapper').slick({
        slidesToShow: 3,
        slidewsToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        nextArrow: $('.next'),
        prevArrow: $('.prev'),
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });
});