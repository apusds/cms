(function ($) {
    "use strict";

      $(window).on('load', function () {
        if ($('#preloader').length) {
          $('#preloader').delay(100).fadeOut('slow', function () {
            $(this).remove();
          });
        }
      });

      $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
          $('.back-to-top').fadeIn('slow');
        } else {
          $('.back-to-top').fadeOut('slow');
        }
      });
      $('.back-to-top').click(function(){
        $('html, body').animate({scrollTop : 0},1500, 'easeInOutExpo');
        return false;
      });

      new WOW().init(); // Init WOW

      $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
          $('#header').addClass('header-scrolled');
        } else {
          $('#header').removeClass('header-scrolled');
        }
      });

      if ($(window).scrollTop() > 100) {
        $('#header').addClass('header-scrolled');
      }

      $('.main-nav a, .mobile-nav a, .scrollto').on('click', function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target = $(this.hash);
          if (target.length) {
            var top_space = 0;

            if ($('#header').length) {
              top_space = $('#header').outerHeight();

              if (! $('#header').hasClass('header-scrolled')) {
                top_space = top_space - 40;
              }
            }

            $('html, body').animate({
              scrollTop: target.offset().top - top_space
            }, 1500, 'easeInOutExpo');

            if ($(this).parents('.main-nav, .mobile-nav').length) {
              $('.main-nav .active, .mobile-nav .active').removeClass('active');
              $(this).closest('li').addClass('active');
            }

            if ($('body').hasClass('mobile-nav-active')) {
              $('body').removeClass('mobile-nav-active');
              $('.mobile-nav-toggle i').toggleClass('fa-times fa-bars');
              $('.mobile-nav-overly').fadeOut();
            }
            return false;
          }
        }
      });

      var nav_sections = $('section');
      var main_nav = $('.main-nav, .mobile-nav');
      var main_nav_height = $('#header').outerHeight();

      $(window).on('scroll', function () {
        var cur_pos = $(this).scrollTop();

        nav_sections.each(function() {
          var top = $(this).offset().top - main_nav_height,
              bottom = top + $(this).outerHeight();

          if (cur_pos >= top && cur_pos <= bottom) {
            main_nav.find('li').removeClass('active');
            main_nav.find('a[href="#'+$(this).attr('id')+'"]').parent('li').addClass('active');
          }
        });
      });

      $(window).on('load', function () {
        var portfolioIsotope = $('.gallery-container').isotope({
          itemSelector: '.gallery-item'
        });
        $('#gallery-flters li').on( 'click', function() {
          $("#gallery-flters li").removeClass('filter-active');
          $(this).addClass('filter-active');

          portfolioIsotope.isotope({ filter: $(this).data('filter') });
        });
      });

      $(".partners-carousel").owlCarousel({
        autoplay: false,
        dots: true,
        loop: false,
        responsive: { 0: { items: 2 }, 768: { items: 4 }, 900: { items: 6 }
        }
      });

      // Checkbox
      $('input[type="checkbox"]').on('change', function() {
          $('input[type="checkbox"]').not(this).prop('checked', false);
      });

})(jQuery);

