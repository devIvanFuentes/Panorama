(function($) {
	$('.burger').click(function(){
		$( ".menu__principal" ).fadeIn( "fast" );
		$('.menu__principal').css('display','flex');
	});

	$('.menu__close').click(function(){
		$(".menu__principal").fadeOut("fast");
	});
})( jQuery );