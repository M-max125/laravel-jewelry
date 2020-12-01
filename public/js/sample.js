jQuery(document).ready(function ($) {
    $('.carousel-main').owlCarousel({
        items: 3,
        loop: true,
        autoplay: true,
        autoplayTimeout: 1500,
        margin: 10,
        nav: true,
        dots: false,
        navText: ['<span class="fas fa-chevron-left fa-2x"></span>','<span class="fas fa-chevron-right fa-2x"></span>'],
    })
});