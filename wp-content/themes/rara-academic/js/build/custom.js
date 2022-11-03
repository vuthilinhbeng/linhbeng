jQuery(document).ready( function($) {
	var rtl, mrtl;
    if( rara_academic_data.rtl == '1' ){
        rtl = true;
        mrtl = false;
    }else{
        rtl = false;
        mrtl = true;
    }

    $("#lightSlider").owlCarousel({
        items       : 1,
        margin: 0,
        dots      : true,
        nav: true,
        currentPagerPosition : 'middle',
        mouseDrag : false,
        loop   : true,
        rtl        : rtl
    });
    
    /* Masonry for faq */
    if( $('.page-template-template-home').length > 0 ){
        $('.services .row').imagesLoaded(function(){ 
            $('.services .row').masonry({
                itemSelector: '.col-3',
                isOriginLeft: mrtl
            }); 
        });
    }

    //mobile-menu
     var winWidth = $(window).width();
    // if(winWidth < 1025){
        $('.menu-opener').on( 'click', function() {
            $('body').addClass('menu-open');
            $('.mobile-menu-wrapper .primary-menu-list').addClass('toggled');
            $('.mobile-menu-wrapper .close-main-nav-toggle').on( 'click', function() {
                $('body').removeClass('menu-open');
                $('.mobile-menu-wrapper .primary-menu-list').removeClass('toggled');
            });

            $('.overlay').on( 'click', function() {
                $('body').removeClass('menu-open');
                $('.mobile-menu-wrapper .primary-menu-list').removeClass('toggled');
            });
        });
    // }

    //ul accessibility
    $('<button class="angle-down"></button>').insertAfter($('.main-navigation ul .menu-item-has-children > a'));
    $('.main-navigation ul li .angle-down').on( 'click', function() {
    $(this).next().slideToggle();
    $(this).toggleClass('active');
});  

$('.menu-opener').on( 'click', function() {
    $('body').addClass('menu-open');
    $('.mobile-menu-wrapper .primary-menu-list').addClass('toggled');
    $('.mobile-menu-wrapper .close-main-nav-toggle').on( 'click', function() {
        $('body').removeClass('menu-open');
        $('.mobile-menu-wrapper .primary-menu-list').removeClass('toggled');
    });

    $('.overlay').on( 'click', function() {
        $('body').removeClass('menu-open');
        $('.mobile-menu-wrapper .primary-menu-list').removeClass('toggled');
    });
});


$(window).on("load, resize", function() {
    var viewportWidth = $(window).width();
    if (viewportWidth < 1025) {
        $('.overlay').on( 'click', function() {
            $('body').removeClass('menu-open');
       $('.mobile-menu-wrapper .primary-menu-list').removeClass('toggled'); 
        });
    }
    else if (viewportWidth> 1025) {
        $('body').removeClass('menu-open');
    }
});

    if(winWidth > 1024){
        $("#site-navigation ul li a").on( 'focus', function() {
            $(this).parents("li").addClass("focus");
        }).on( 'blur', function() {
            $(this).parents("li").removeClass("focus");
       });
    }
});