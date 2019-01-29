$(function () {

    var ordersCarousel = new Swiper('.orders-carousel', {
        spaceBetween: 12,
        slidesPerView: 6,
        breakpoints: {
            // when window width is <= 576px
            425: {
                slidesPerView: 2,
            },
            // when window width is <= 576px
            576: {
                slidesPerView: 3,
            },
            // when window width is <= 768px
            768: {
                slidesPerView: 4,
            },
            // when window width is <= 992px
            992: {
                slidesPerView: 5,
            },
        },
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

});