$(document).ready(function () {
    $('.slider').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        arrows: true,
        appendArrows: $('.slider-container')
    });
    $('.event-slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });
});
