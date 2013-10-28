(function ($) {
	$.fn.google_fonts = function (options) {
		var defaults = {
			fontname: "arial"
		};
		var options = jQuery.extend(defaults, options);
		var fontname = options.fontname;
		fontname = fontname.replace(/ /gi, "+");

		// Check if SSL is present, if so then use https othereise use http
		var protocol = window.location.protocol;

		$("head").append('<link href="' + protocol + '//fonts.googleapis.com/css?family=' + fontname + '" rel="stylesheet" type="text/css">');
		jQuery(this).css("font-family", options.fontname);
		return this;
	};
})(jQuery);