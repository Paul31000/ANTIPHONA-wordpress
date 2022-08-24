
jQuery(document).ready(function($){
    $('.slick-slide-show').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        //infinite: true,
        //slidesToShow: 3,
        //slidesToScroll: 3,
        //variableWidth:true,
        prevArrow: $('.slick-prev'),
        nextArrow: $('.slick-next')
    });
  });

jQuery(document).ready(function($){
    $('.slick-citations-show').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        prevArrow: $('.slick-prev'),
        nextArrow: $('.slick-next'),
    });
});