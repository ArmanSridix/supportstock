
$(document).ready(function() {
    "use strict";

    $("#otp").hide();
$(".forget-btn").click(function(){
  $("#login").hide();
  $("#forgotpassword").show();
  $("#otp").hide();
});

$(".signup-btn").click(function(){
  $("#login").hide();
  $("#forgotpassword").hide();
  $("#register").show();
  $("#otp").hide();
});

$(".signin-btn").click(function(){
  $("#login").show();
  $("#forgotpassword").hide();
  $("#register").hide();
  $("#otp").hide();
});


    $(document).ready(function() {
        setTimeout(function () {
        $('.loader_bg').fadeToggle();
        }, 400);
    });

   $(function () {
        $('.input-number').customNumber();
    });

     //$('select').select2();

    $('#js-example-basic-hide-search').select2({ minimumResultsForSearch: -1 });

     // ===========Right Sidebar============
    $('[data-toggle="offcanvas"]').on('click', function() {
        $('html').toggleClass('toggled');
    });

    $(".nasted-dropdown a").click(function () {
    $(this).next().toggle();
    if ($('.nasted-dropdown li ul:visible').length > 1) {
      $('.nasted-dropdown li ul:visible').hide();
      $(this).next().show();
    }
  });

    $('.owl-carousel-slider').owlCarousel({
            items:1,
            dots: true,
            lazyLoad: true,
            pagination: true,
            autoplay: 100,
            loop: true,
            singleItem: true,
            navigation: true,
            stopOnHover: true,
            nav: true,
            navText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
    });

     $('.owl-carousel-category').owlCarousel({
            lazyLoad: true,
            pagination: false,
            responsiveClass: true,
            loop: true,
            dots: false,
            autoplay: false,
            navigation: true,
            stopOnHover: true,
            nav: true,
            navigationText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 5,
                    
                },
                1000: {
                    items:8,
                },
                1200: {
                    items: 8,
                },
            }
    });

$(document).ready(function(){


// === checkbox Toggle === //
// === Toggle === //
$('.enable.button')
.on('click', function() {
$(this)
.nextAll('.checkbox')
.checkbox('enable')
;
});
$('input[name="paymentmethod"]').on('click', function () {
var $value = $(this).attr('value');
$('.return-departure-dts').slideUp();
$('[data-method="' + $value + '"]').slideDown();
});
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});

});


       $('.owl-carousel-deals').owlCarousel({
            lazyLoad: true,
            pagination: false,
            responsiveClass: true,
            loop: true,
            dots: false,
            autoplay: false,
            navigation: true,
            stopOnHover: true,
            nav: true,
            navigationText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
             responsive: {
                0: {
                    items: 1,

                },
                600: {
                    items: 3,
                    
                },
                1000: {
                    items:6,
                },
                1200: {
                    items: 6,
                },
            }
        });

        $('.owl-carousel-categorypro').owlCarousel({
            lazyLoad: true,
            pagination: false,
            responsiveClass: true,
            loop: true,
            dots: false,
            autoplay: false,
            navigation: true,
            stopOnHover: true,
            nav: true,
            navigationText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
             responsive: {
                0: {
                    items: 1,

                },
                600: {
                    items: 3,
                    
                },
                1000: {
                    items:6,
                },
                1200: {
                    items: 6,
                },
            }
        });


          $('.owl-carousel-bestseller').owlCarousel({
            lazyLoad: true,
            pagination: false,
            responsiveClass: true,
            loop: true,
            dots: false,
            autoplay: false,
            navigation: true,
            stopOnHover: true,
            nav: true,
            navigationText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
             responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                    
                },
                1000: {
                    items:6,
                },
                1200: {
                    items: 6,
                },
            }
        });


            $('.owl-carousel-promo').owlCarousel({
            lazyLoad: true,
            pagination: false,
            responsiveClass: true,
            loop: true,
            dots: false,
            autoplay: 2000,
            navigation: true,
            stopOnHover: true,
            margin:10,
            nav: true,
            navigationText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
             responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items:3,
                },
                1200: {
                    items: 3,
                },
            }
        });


       


         $("#mobile-menu").mobileMenu({
            MenuWidth: 0,
            SlideSpeed: 300,
            WindowsMaxWidth: 767,
            PagePush: true,
            FromLeft: true,
            Overlay: true,
            CollapseMenu: true,
            ClassName: "mobile-menu"
        }); 

        $(".navbar-toggler-icon").click(function(){
          $(".off_canvars_overlay").addClass("active");
        });

        $(".mm-toggle-wrapclose").click(function(){
          $(".off_canvars_overlay").removeClass("active");
        });
      





        $(window).on('scroll', function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 50) {
            $(".header_nav").addClass("header-fixed");
            } else {
            $(".header_nav").removeClass("header-fixed");
            }
        });

      



/*-------------------------------------------
  elevateZoom
  -------------------------------------------- */ 
  $('#zoom_01,#zoom_02,#zoom_03,#zoom_04').elevateZoom({
    cursor: 'pointer', 
    galleryActiveClass: "active", 
    imageCrossfade: true
  });

   





         $.fn.UItoTop = function(options) {
      var defaults = {
          text: '',
          min: 200,
          inDelay: 600,
          outDelay: 400,
          containerID: 'toTop',
          containerHoverID: 'toTopHover',
          scrollSpeed: 1200,
          easingType: 'linear'
      };
      var settings = $.extend(defaults, options);
      var containerIDhash = '#' + settings.containerID;
      var containerHoverIDHash = '#' + settings.containerHoverID;
      $('body').append('<a href="#" id="' + settings.containerID + '">' + settings.text + '</a>');
      $(containerIDhash).hide().on("click", function() {
        $('html, body').animate({
              scrollTop: 0
          }, settings.scrollSpeed, settings.easingType);
          $('#' + settings.containerHoverID, this).stop().animate({
              'opacity': 0
          }, settings.inDelay, settings.easingType);
          return false;
      }).prepend('<span id="' + settings.containerHoverID + '"></span>').hover(function() {
        $(containerHoverIDHash, this).stop().animate({
              'opacity': 1
          }, 600, 'linear');
      }, function() {
        $(containerHoverIDHash, this).stop().animate({
              'opacity': 0
          }, 700, 'linear');
      });
      $(window).on("scroll", function() {
          var sd = $(window).scrollTop();
          if (typeof document.body.style.maxHeight === "undefined") {
            $(containerIDhash).css({
                  'position': 'absolute',
                  'top': $(window).scrollTop() + $(window).height() - 50
              });
          }
          if (sd > settings.min) $(containerIDhash).fadeIn(settings.inDelay);
          else $(containerIDhash).fadeOut(settings.Outdelay);
      });
  };
  var isTouchDevice = ('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0);
  $(window).on("load", function() {
      if (isTouchDevice) {}
      $().UItoTop();
  });


});