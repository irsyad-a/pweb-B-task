/*
    MAN IC Bangka Tengah - Website Script
    Diadaptasi dari referensi In-Time template
*/

(function($) {

    "use strict";


    /* ==========================================================
       Preloader — Layar loading menghilang setelah halaman siap
    ========================================================== */
    function handlePreloader() {
        if ($('.preloader').length) {
            $('.preloader').delay(200).fadeOut(500);
        }
    }


    /* ==========================================================
       Sticky Header — Navbar menempel di atas saat di-scroll
       Scroll To Top — Tombol panah muncul setelah scroll jauh
    ========================================================== */
    function headerStyle() {
        if ($('.main-header').length) {
            var windowpos  = $(window).scrollTop();
            var siteHeader = $('.main-header');
            var scrollLink = $('.scroll-to-top');
            var headerHeight = $('.main-header').height();

            if (windowpos >= headerHeight) {
                siteHeader.addClass('fixed-header');
                scrollLink.fadeIn(300);
            } else {
                siteHeader.removeClass('fixed-header');
                scrollLink.fadeOut(300);
            }
        }
    }

    headerStyle();


    /* ==========================================================
       Mobile Menu — Dropdown toggle untuk layar kecil
    ========================================================== */
    if ($('.main-header li.dropdown ul').length) {
        $('.main-header li.dropdown').append('<div class="dropdown-btn"><span class="fa-solid fa-chevron-down fa-fw"></span></div>');

        $('.main-header li.dropdown .dropdown-btn').on('click', function() {
            $(this).prev('ul').slideToggle(500);
        });

        $('.navigation li.dropdown > a').on('click', function(e) {
            e.preventDefault();
        });
    }


    /* ==========================================================
       Auto Active Menu — Tandai menu aktif sesuai halaman saat ini
    ========================================================== */
    function dynamicCurrentMenuClass(selector) {
        var FileName = window.location.href.split("/").reverse()[0];

        selector.find("li").each(function() {
            var anchor = $(this).find("a");
            if ($(anchor).attr("href") == FileName) {
                $(this).addClass("current");
            }
        });

        selector.children("li").each(function() {
            if ($(this).find(".current").length) {
                $(this).addClass("current");
            }
        });

        if ("" == FileName) {
            selector.find("li").eq(0).addClass("current");
        }
    }

    if ($('.navigation').length) {
        dynamicCurrentMenuClass($('.navigation'));
    }


    /* ==========================================================
       WOW.js — Animasi elemen masuk layar saat di-scroll
       Digunakan pada: kartu keunggulan, section about, dsb.
    ========================================================== */
    if ($('.wow').length) {
        var wow = new WOW({
            boxClass:     'wow',
            animateClass: 'animated',
            offset:       0,
            mobile:       true,
            live:         true
        });
        wow.init();
    }


    /* ==========================================================
       Owl Carousel — Hero Slider Banner Bergerak
    ========================================================== */
    if ($('.hero-slider').length) {
        $('.hero-slider').owlCarousel({
            loop:      true,
            margin:    0,
            nav:       true,
            dots:      true,
            smartSpeed: 700,
            autoplay:  true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            navText: [
                '<span class="fa-solid fa-angle-left fa-fw"></span>',
                '<span class="fa-solid fa-angle-right fa-fw"></span>'
            ],
            responsive: {
                0:    { items: 1 },
                600:  { items: 1 },
                1024: { items: 1 }
            }
        });
    }

    /* Testimonial / Single item carousel */
    if ($('.single-item-carousel').length) {
        $('.single-item-carousel').owlCarousel({
            loop:      true,
            margin:    0,
            nav:       true,
            smartSpeed: 500,
            autoplay:  6000,
            navText: [
                '<span class="fa-solid fa-angle-left fa-fw"></span>',
                '<span class="fa-solid fa-angle-right fa-fw"></span>'
            ],
            responsive: {
                0:    { items: 1 },
                600:  { items: 1 },
                1024: { items: 1 }
            }
        });
    }

    /* Three item carousel */
    if ($('.three-item-carousel').length) {
        $('.three-item-carousel').owlCarousel({
            loop:      true,
            margin:    30,
            nav:       false,
            dots:      true,
            smartSpeed: 500,
            autoplay:  6000,
            responsive: {
                0:    { items: 1 },
                600:  { items: 2 },
                1024: { items: 3 }
            }
        });
    }

    /* Sponsors / Logo carousel */
    if ($('.sponsors-carousel').length) {
        $('.sponsors-carousel').owlCarousel({
            loop:      true,
            margin:    30,
            nav:       false,
            dots:      false,
            smartSpeed: 500,
            autoplay:  3000,
            responsive: {
                0:    { items: 2 },
                480:  { items: 3 },
                800:  { items: 4 },
                1024: { items: 5 }
            }
        });
    }


    /* ==========================================================
       Smooth Scroll to Top (tombol panah bawah/kanan)
    ========================================================== */
    if ($('.scroll-to-target').length) {
        $(".scroll-to-target").on('click', function() {
            var target = $(this).attr('data-target');
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1000);
        });
    }


    /* ==========================================================
       Smooth Scroll — Link anchor internal (#section-id)
    ========================================================== */
    $('a[href^="#"]').not('.acc-btn').on('click', function(e) {
        var href = $(this).attr('href');
        if (href !== '#' && $(href).length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $(href).offset().top - 80
            }, 800);
        }
    });


    /* ==========================================================
       Odometer Counter — Angka berjalan ketika terlihat di layar
       Contoh: Jumlah siswa, prestasi, tahun berdiri, dll.
    ========================================================== */
    if ($(".odometer").length) {
        $('.odometer').appear();
        $('.odometer').appear(function() {
            var odo = $(".odometer");
            odo.each(function() {
                var countNumber = $(this).attr("data-count");
                $(this).html(countNumber);
            });
            window.odometerOptions = { format: 'd' };
        });
    }


    /* ==========================================================
       Fact Counter — Angka naik animasi (alternatif odometer)
       Gunakan: <div class="count-box"><span class="count-text"
         data-speed="2000" data-stop="500">0</span>+</div>
    ========================================================== */
    if ($('.count-box').length) {
        $('.count-box').appear(function() {
            var $t   = $(this),
                n    = $t.find(".count-text").attr("data-stop"),
                r    = parseInt($t.find(".count-text").attr("data-speed"), 10);

            if (!$t.hasClass("counted")) {
                $t.addClass("counted");
                $({ countNum: $t.find(".count-text").text() }).animate({ countNum: n }, {
                    duration: r,
                    easing:   "linear",
                    step:     function() { $t.find(".count-text").text(Math.floor(this.countNum)); },
                    complete: function() { $t.find(".count-text").text(this.countNum); }
                });
            }
        }, { accY: 0 });
    }


    /* ==========================================================
       Lightbox Gambar — Klik gambar → tampil full-screen
       Gunakan class="lightbox-image" pada tag <a>
    ========================================================== */
    if ($('.lightbox-image').length) {
        $('.lightbox-image').magnificPopup({
            type: 'image',
            gallery: { enabled: true }
        });
    }


    /* ==========================================================
       Lightbox Video — Klik tombol play → buka YouTube popup
       Gunakan class="lightbox-video" pada tag <a>
    ========================================================== */
    if ($('.lightbox-video').length) {
        $('.lightbox-video').magnificPopup({
            type:          'iframe',
            mainClass:     'mfp-fade',
            removalDelay:  160,
            preloader:     false,
            fixedContentPos: false,
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com',
                        id:    'v=',
                        src:   'https://www.youtube.com/embed/%id%'
                    }
                },
                srcAction: 'iframe_src'
            }
        });
    }


    /* ==========================================================
       Header Search Popup
    ========================================================== */
    if ($('.search-box-outer').length) {
        $('.search-box-outer').on('click', function() {
            $('body').addClass('search-active');
        });
        $('.close-search').on('click', function() {
            $('body').removeClass('search-active');
        });
    }


    /* ==========================================================
       Tilt Effect — Kartu sedikit miring mengikuti mouse
       Gunakan data-tilt pada elemen yang diinginkan
    ========================================================== */
    if ($('[data-tilt]').length) {
        $('[data-tilt]').tilt({
            maxTilt:        10,
            perspective:    1000,
            easing:         "cubic-bezier(.03,.98,.52,.99)",
            scale:          1.02,
            speed:          500,
            transition:     true,
            reset:          true,
            glare:          false
        });
    }


    /* ==========================================================
       Equal Height for News Cards
    ========================================================== */
    function equalizeNewsCards() {
        var maxHeight = 0;
        $('.news-card-inner').each(function() {
            $(this).css('height', 'auto');
            var thisHeight = $(this).outerHeight();
            if (thisHeight > maxHeight) {
                maxHeight = thisHeight;
            }
        });
        $('.news-card-inner').css('height', maxHeight + 'px');
    }

    /* ==========================================================
       Window Scroll Events
    ========================================================== */
    $(window).on('scroll', function() {
        headerStyle();
    });


    /* ==========================================================
       Window Load Events
    ========================================================== */
    $(window).on('load', function() {
        handlePreloader();
        equalizeNewsCards();
    });

    /* Equalize on resize */
    $(window).on('resize', function() {
        equalizeNewsCards();
    });

    /* Equalize after owl carousel initialized */
    $('.school-news .three-item-carousel').on('initialized.owl.carousel', function() {
        setTimeout(equalizeNewsCards, 100);
    });

    /* Also equalize for statistics blocks */
    function equalizeStatisticsBlocks() {
        var maxHeight = 0;
        $('.school-statistics-block-inner').each(function() {
            $(this).css('height', 'auto');
            var thisHeight = $(this).outerHeight();
            if (thisHeight > maxHeight) {
                maxHeight = thisHeight;
            }
        });
        $('.school-statistics-block-inner').css('height', maxHeight + 'px');
    }

    $(window).on('load', function() {
        equalizeStatisticsBlocks();
    });

    $(window).on('resize', function() {
        equalizeStatisticsBlocks();
    });


    // Four Item Carousel
    if ($('.four-item-carousel').length) {
        $('.four-item-carousel').owlCarousel({
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            loop:true,
            margin:20,
            nav:true,
            smartSpeed: 500,
            autoplay: true,
            responsive:{
                0:{ items:1 },
                480:{ items:1 },
                600:{ items:2 },
                800:{ items:2 },
                1024:{ items:3 },
                1200:{ items:4 }
            }
        });
    }


})(window.jQuery);
