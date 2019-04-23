(function($) {

  $(".owl-carousel").owlCarousel({
  	center:true,
  	items:1,
  	loop:true,
  	autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    animateIn:'fadeIn',
    animateOut:'fadeOut',
    smartSpeed: 2000
  });
})( jQuery );