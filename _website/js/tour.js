$(function () {

    // tour main slider
    var tourMainSlider = new Swiper(".tour-slider", {
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: ".swiper-pagination--tour-slider",
            clickable: true,
        },
    });

    // other tours carousel
    var otherToursCarousel = new Swiper('.other-tours-carousel', {
        spaceBetween: 12,
        slidesPerView: 3,
        breakpoints: {
            // when window width is <= 1199px
            1199: {
                slidesPerView: 2,
            },
            // when window width is <= 424px
            424: {
                slidesPerView: 1,
            },
        },
        loop: true,
        loopFillGroupWithBlank: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: ".swiper-pagination--other-tours-carousel",
            clickable: true,
        },
    });

});