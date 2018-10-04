$(document).ready(function($){
    $('.slider-for').slick({
      asNavFor: '.slider-nav',
      centerMode: true,
      centerPadding: '225px',
      slidesToShow: 1,
      prevArrow:'<button type="button" class="slick-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>',
      nextArrow:'<button type="button" class="slick-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>',
      responsive: [
        {
          breakpoint: 1150,
          settings: {
            centerPadding: '190px',
          }
        },
        {
          breakpoint: 990,
          settings: {
            centerPadding: '210px',
          }
        },
        {
          breakpoint: 600,
          settings: {
            centerPadding: '50px',
          }
        },
        {
          breakpoint: 350,
          settings: {
            centerPadding: '20px',
          }
        }
      ]

    });
    $('.slider-nav').slick({
      arrows: false,
        asNavFor: '.slider-for',
        slidesToShow: 1
    });
    // -----------search
    $(".menu_th_r .a_search").click(function(){
        if(! $(this).parent().hasClass("search_active")){
            $(this).parent().addClass("search_active");
        }else{
            $(this).parent().removeClass("search_active");
        }
    });
    $(window).bind("click",function(e){
        var $clicked  = $(e.target);
        if(! $clicked.parents().hasClass("fb_menu_s")){
            $(".fb_menu_s").removeClass("search_active");
        }    
    });
    // -----------Contact
    // $(".group_li .other_lb").click(function(){
    //     if(! $(this).parent().hasClass("gr_active")){
    //         $(this).parent().addClass("gr_active");
    //     }
    //     else{
    //         $(this).parent().removeClass("gr_active");
    //     }
    // });
    // $(window).bind("click",function(e){
    //     var $clicked  = $(e.target);
    //     if(! $clicked.parents().hasClass("group_li")){
    //         $(".group_li").removeClass("gr_active");
    //     }    
    // });
    // -----------------------
    $('.sli_l').lightSlider({
      item:2,
      loop:true,
      slideMove:1,
      easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
      speed:600,
      auto:true,
      pager: false,
      responsive : [
        
        {
            breakpoint:767,
            settings: {
                item:1,
                slideMove:1
              }
        }
      ]
  }); 
});