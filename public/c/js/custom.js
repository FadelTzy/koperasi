(function ($) {
    "use strict";


    /*
    |----------------------------------------------------------------------------
    | FOR PRELOADER
    |----------------------------------------------------------------------------
    */
    $(window).load(function () {
        $('.preloader').fadeOut('slow');
    });


    /*
    |----------------------------------------------------------------------------
    | FOR COUNTER
    |----------------------------------------------------------------------------
    */
    $('.fact-box').appear(function () {
        $('.counter-number').countTo();
    });


    /*
    |----------------------------------------------------------------------------
    | FOR MENU
    |----------------------------------------------------------------------------
    */

    // when click menu open in small device
    $(".open-menu-icon").on("click", function () {
        $(".main-nav-outer").addClass("open-menu");
    });

    // when clieck menu close in small device
    $(".close-menu-icon").on("click", function () {
        $(".main-nav-outer").removeClass("open-menu");
    });

    // target menu
    $('.navbar-nav li a, .scroll-top a, #scroll-down a, #get-started a, .contact-link').on('click', function (event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 75
        }, 1000);
        event.preventDefault();
    });

    // topbar show and hide
    $(window).scroll(function () {
        if ($(this).scrollTop() > 10) {
            $(".header-menu").addClass("top-bar-change");
        } else {
            $(".header-menu").removeClass("top-bar-change");
        }
    });


    /*
    |----------------------------------------------------------------------------
    | FOR HOME TYPE
    |----------------------------------------------------------------------------
    */
    $(".type").typed({
        strings: ["Business school", "Business College", "Business Univercity"],
        typeSpeed: 200,
        backDelay: 6000,
        loop: true,
        loopCount: false,
    });


    /*
    |----------------------------------------------------------------------------
    | FOR TESTIMONIAL SLIDER
    |----------------------------------------------------------------------------
    */
    $('#testimonial-slider').owlCarousel({
        margin: 30,
        loop: true,
        autoplay: true,
        autoplayTimeout: 12000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            }
        }

    })


    /*
    |----------------------------------------------------------------------------
    | FOR TEACHER SLIDER
    |----------------------------------------------------------------------------
    */
    $('#expart-slider').owlCarousel({
        items: 2,
        margin: 30,
        dots: true,
        nav: false,
        loop: true,
        autoplay: true,
        autoplayTimeout: 12000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            }
        }
    })



    /*
    |----------------------------------------------------------------------------
    |  FOR WOW ANIMATION
    |----------------------------------------------------------------------------
    */
    var wow = new WOW({
        mobile: false,
        offset: 60,
    });
    wow.init();



    /*
    |----------------------------------------------------------------------------
    | FOR NEWSLETTER SUBSCRIBE
    |----------------------------------------------------------------------------
    */
    $('#mc-form').ajaxChimp({
        url: 'https://xyz.us15.list-manage.com/subscribe/post?u=a26d8d38db8b11ffd3352f889&amp;id=d60b8b0444'
        /* Replace Your AjaxChimp Subscription Link */
    });


    /*
    |----------------------------------------------------------------------------
    | FOR SCROLL-TOP
    |----------------------------------------------------------------------------
    */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            $('.scroll-top').fadeIn();
        } else {
            $('.scroll-top').fadeOut();
        }
    });



    /*
    |----------------------------------------------------------------------------
    | FOR VIDEO PLAY
    |----------------------------------------------------------------------------
    */
    $('#play-video').on('click', function (e) {
        e.preventDefault();
        $('#video-overlay').addClass('open');
        $("#video-overlay").append('<iframe width="60%" height="60%" src="https://www.youtube.com/embed/vIEtEnr_5m0?version=3&loop=1&autoplay=1&modestbranding=0&showinfo=0&rel=0&end=78" frameborder="0" allowfullscreen></iframe>');
        /* Replace Your video Link */
    });

    $('.video-overlay, .video-overlay-close').on('click', function (e) {
        e.preventDefault();
        close_video();
    });

    $(document).keyup(function (e) {
        if (e.keyCode === 27) { close_video().click; }
    });

    function close_video() {
        $('.video-overlay.open').removeClass('open').find('iframe').remove();
    };



    /*
    |----------------------------------------------------------------------------
    | FOR SCORLL ANIMATION
    |----------------------------------------------------------------------------
    */
    window.sr = ScrollReveal();

    sr.reveal('.reveal-left-fade', {
        origin: 'left',
        distance: '20px',
        duration: 800,
        delay: 0,
        opacity: 0,
        scale: 0,
        easing: 'linear',
        mobile: false
    });

    sr.reveal('.reveal-right-fade', {
        origin: 'right',
        distance: '20px',
        duration: 800,
        delay: 0,
        opacity: 0,
        scale: 0,
        easing: 'linear',
        mobile: false
    });

    sr.reveal('.reveal-right-delay', {
        origin: 'right',
        distance: '20px',
        duration: 1000,
        delay: 0,
        opacity: 0,
        scale: 0,
        easing: 'linear',
        mobile: false
    }, 500);

    sr.reveal('.reveal-bottom-fade', {
        origin: 'bottom',
        distance: '20px',
        duration: 800,
        delay: 0,
        opacity: 0,
        scale: 0,
        easing: 'linear',
        mobile: false
    });



})(window.jQuery);