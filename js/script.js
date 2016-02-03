$(document).ready(function(){
        $('.your-class').slick({
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: false,
        focusOnSelect: true,
        asNavFor: '.gallery-overlay-slider',
        variableWidth: true,
        lazyLoad: 'ondemand',
        asNavFor: '.gallery-overlay-slider'
    });


// Save old script 


    function slickCustomNav(slickSlideShow, CustomNavClass) {
        slickSlideShow = $(slickSlideShow);
        CustomNavClass = $(CustomNavClass);

        CustomNavClass.click(function (e) {
            e.preventDefault();
            slideIndex = $(this).index();
            slickSlideShow.slick('slickGoTo', slideIndex);
        });

        slickSlideShow.on('setPosition', function () {
            var currentSlide = slickSlideShow.slick('slickCurrentSlide');
            CustomNavClass.removeClass("active");
            CustomNavClass.filter(function (index) {
                return index === currentSlide;
            }).addClass("active");
        });
    }

    slickCustomNav(".clients_information", ".menumap a");
    slickCustomNav(".clients_information", ".clients_map_points div");






















    $(".gallery-overlay").click(function(){
        $(".gallery-overlay").hide();
    });

    $(".click-slide").click(function(){
        $(".gallery-overlay").show();
    });
});



