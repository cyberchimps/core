/*
** swipes.js
** calls click event on occurance of swipe event.

*/

jQuery(function($) {

	jQuery('#slider')
		.on('swipeleft', function(e) {
			$(".slider-right").click();
	})
	.on('swiperight', function(e) {
		$(".slider-left").click();
	});

});

jQuery(function($) {

	jQuery('#slider-lite')
		.on('swipeleft', function(e) {
			$(".slider-lite-right").click();
	})
	.on('swiperight', function(e) {
		$(".slider-lite-left").click();
	});

});