jQuery(document).ready(function ($) {
	//slider lite
	$("#slider_lite").swiperight(function () {
		$("#slider_lite").carousel('prev');
	});
	$("#slider_lite").swipeleft(function () {
		$("#slider_lite").carousel('next');
	});

	//slider pro
	$("#slider").swiperight(function () {
		$("#slider").carousel('prev');
	});
	$("#slider").swipeleft(function () {
		$("#slider").carousel('next');
	});
});