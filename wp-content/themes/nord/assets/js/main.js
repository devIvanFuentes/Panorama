(function($) {

	"use strict";

	var win = $(window),
		ww = window.innerWidth,
		wh = window.innerHeight;


	// main nav
	// --------------------

	$('.menu li:has(ul)').find('a:first').addClass('parent');

	function main_nav() {
		if (ww > 800) {
			$('.main-nav').show();
			$('.trigger').hide().removeClass('active');
			$('.mobile-nav').hide().removeClass('visible');

			$('.menu li:has(ul)').off('mouseenter mouseleave');
			$('.menu li:has(ul)').find('a').off('click');

			$('.menu li:has(ul)').on('mouseenter', function() {
				$(this).find('ul').show();
				$(this).find('ul:first').addClass('visible');
			}).on('mouseleave', function() {
				$(this).find('ul').hide();
				$(this).find('ul:first').removeClass('visible');
			});

			$('.menu li:has(ul)').find('a').on('click', function() {
				var parent = $(this).parent(),
					submenu = $(this).next('ul');

				if (parent.children('ul').length == 0) return true;
				else return false;
			});
		} else {
			$('.main-nav').hide();
			$('.trigger').show();
			$('.mobile-nav').show();

			$('.menu li:has(ul)').children('ul').hide();
			$('.menu li:has(ul)').off('mouseenter mouseleave');
			$('.menu li:has(ul)').find('a').off('click');

			$('.menu li:has(ul)').find('a').on('click', function() {
				var parent = $(this).parent(),
					submenu = $(this).next('ul');

				if (submenu.is(':visible'))
					parent.find('ul').slideUp(300);

				if (submenu.is(':hidden')) {
					parent.siblings().find('ul').slideUp(300);
					submenu.slideDown(300);
				}

				if (parent.children('ul').length == 0) return true;
				else return false;
			});
		}
	}

	$('.trigger').on('click', function() {
		$(this).toggleClass('active');
		$('.mobile-nav').html($('.main-nav').html()).toggleClass('visible');
		main_nav();
	});


	// background images
	// --------------------

	function image_bg() {
		$('[data-bg]').each(function() {
			var bg = $(this).data('bg');

			$(this).css({
				'background-image': 'url(' + bg + ')',
				'background-size': 'cover',
				'background-position': 'center center',
				'background-repeat': 'no-repeat'
			});
		});
	}


	// popup
	// --------------------

	function mPopup() {
		var popup = $('.magnific-popup');

		popup.each(function() {
			var gallery = $(this).data('gallery') == true ? 1 : 0;

			popup.magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery: {
					enabled: gallery
				}
			});
		});
	}


	// window
	// --------------------

	win.on('load', function() {
		image_bg();
		mPopup();

		$('body').waitForImages({
			finished: function() {
				setTimeout(function() {
					$('.loader-mask').addClass('hide');
					main_nav();
				}, 1000);
			},
			waitForAll: true
		});
	});

	win.on('resize', function() {
		ww = window.innerWidth;
		wh = window.innerHeight;

		main_nav();
	});

})(jQuery);
