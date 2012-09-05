(function( $ ) {
    $.fn.google_fonts = function(options) {
        var defaults = {
            fontname: "arial"
        };
        var options = jQuery.extend(defaults, options);
        var fontname = options.fontname;
        fontname = fontname.replace(/ /gi, "+");
        $("head").append('<link href="http://fonts.googleapis.com/css?family='+fontname+'" rel="stylesheet" type="text/css">');
        jQuery(this).css("font-family",options.fontname);
        return this;
    };
})( jQuery );