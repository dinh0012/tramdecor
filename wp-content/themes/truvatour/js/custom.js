/************************************
    File Name: custom.js
    Template Name: TruvaTour
    Created By: Similar Icons
    Envato Profile: http://themeforest.net/user/similaricons
    Website: https://similaricons.com
    Version: 1.0
************************************/

(function($) {
    "use strict";

    //Navigation Menu Slider
    $(document).ready(function() {
        $('#nav-expander').on('click', function(e) {
            e.preventDefault();
            $('body').toggleClass('nav-expanded');
        });
        $('#nav-close').on('click', function(e) {
            e.preventDefault();
            $('body').removeClass('nav-expanded');
        });

        // Initialize navgoco with default options
        $(".main-menu").navgoco({
            caret: '<span class="caret"></span>',
            accordion: false,
            openClass: 'open',
            save: true,
            cookie: {
                name: 'navgoco',
                expires: false,
                path: '/'
            },
            slide: {
                duration: 300,
                easing: 'swing'
            }
        });
    });

    $(window).load(function() {
        $("#preloader").on(500).fadeOut();
        $(".preloader").on(600).fadeOut("slow");
		
		
    });

    //$('select').selectpicker();
    $('[data-toggle="tooltip"]').tooltip();

      /* ==============================================
    AFFIX -->
    =============================================== */
        $('.header').affix({offset: {top: 150} }); 
        $('.fixmymap').affix({offset: {top: 150} });
	
	$('.owl-hotels').owlCarousel({
            loop:true,
            margin:30,
            nav:true,
            dots:false,
            navText: [
               "<i class='fa fa-angle-left'></i>",
               "<i class='fa fa-angle-right'></i>"
            ],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1080:{
                    items:2
                },
                1180:{
                    items:3
                }
            }
        })

})(jQuery);