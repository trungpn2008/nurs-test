var swiper = new Swiper(".mySwiper", {
    slidesPerView: 2.5,
    spaceBetween: 30,
    // pagination: {
    //     el: ".swiper-pagination",
    //     clickable: true
    // }
    navigation: {
        nextEl: ".slide-home-next",
        prevEl: ".slide-home-prev",
    },
});
var sliderbarUl = $('.service-bar ul').width();
var sliderbar = $('.service-bar').width();
$(".service-slide-bar").width(sliderbar-sliderbarUl-15)
var swiperSlideBar = new Swiper(".slide-bar", {
    slidesPerView: "auto",
    spaceBetween: 5,
    slidesPerGroup: 5,
    loop: false,
    loopFillGroupWithBlank: true,
    // pagination: {
    //     el: ".swiper-pagination",
    //     clickable: true,
    // },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
