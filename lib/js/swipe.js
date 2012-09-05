/*
** swipes.js
** calls click event on occurance of swipe event.

*/

jQuery(function($) {

	jQuery('#slider')
		.on('swipeleft', function(e) {
			$(".right").click();
	})
	.on('swiperight', function(e) {
		$(".left").click();
	});

});