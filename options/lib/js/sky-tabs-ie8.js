jQuery(function()
{
	jQuery('.sky-tabs > input:checked').each(function()
	{
		jQuery(this).next().addClass('active');
		jQuery(this).siblings('ul').find('.' + jQuery(this).attr('class')).show().siblings().hide();
		
	});	
	
	jQuery('.sky-tabs > label').on('click', function()
	{ 
		jQuery(this).addClass('active').siblings().removeClass('active');
		jQuery(this).siblings('ul').find('.' + jQuery(this).prev().attr('class')).show().siblings().hide();	

		if(! jQuery("#sky-tab-cyberchimps_blog_heading").hasClass("active") )
		{
			if( jQuery("#sky-tab-cyberchimps_design_heading").hasClass("active") || jQuery("#sky-tab-cyberchimps_header_heading").hasClass("active") || jQuery("#sky-tab-cyberchimps_templates_heading").hasClass("active") || jQuery("#sky-tab-cyberchimps_footer_heading").hasClass("active") || jQuery("#sky-tab-cyberchimps_import_export_heading").hasClass("active") || jQuery("#sky-tab-cyberchimps_blog_heading").hasClass("active"))
			{
				jQuery(".blog_sub_headings_new").hide();
			}						
		}

	});
	
});

jQuery(document).ready(function ($) {
	jQuery('#cyberchimps_options_page').submit( function (e) {
		tinyMCE.triggerSave();		
		var a = $(document.activeElement.id).selector;		
	    if (a == "cyberchimps_options_submit") {
	        var b =  $(this).serialize();	       
	        jQuery.post( 'options.php', b ).error( 
	            function() {
	                
	            }).success( function() {
	            	
	            	var html = '<div class="formsuccess"><p><strong>Options Saved</strong></p></div>';
	            	$(html).hide().appendTo(".sky-tabs").fadeIn(400).delay(1200).fadeOut(600);	       	
           	            	
	            });
	            return false;   
	    } 
        });
});

// blog section tracker
jQuery(document).ready(function ($) {

var page_subsection_map = {
		slider_lite: "cyberchimps_blog_slider_lite_section",
		page_slider: "cyberchimps_slider_section",
		callout_section: "cyberchimps_callout_section",
		twitterbar_section: "cyberchimps_twitter_api_section",
		carousel_section: "cyberchimps_carousel_section",
		magazine: "cyberchimps_magazine_section",
		portfolio_lite: "cyberchimps_blog_portfolio_lite_section",
		portfolio_pro: "cyberchimps_portfolio_pro_section",
		product_element: "cyberchimps_product_section",
		recent_posts: "cyberchimps_recent_posts_section",
		html_box: "cyberchimps_html_box_section",
		boxes: "cyberchimps_boxes_section",
		separator: "cyberchimps_separator_section",
		blank_space: "cyberchimps_blank_space_section",
		google_maps: "cyberchimps_google_maps_section",
		video: "cyberchimps_video_section",
		showcase: "cyberchimps_showcase_section",
		testimonial: "cyberchimps_testimonial_section",
		blog_post_page: "cyberchimps_blog_options_section",
		//profile				: "cyberchimps_profile_section"
	};

	jQuery('.sky-tabs > label').on('click', function()
	{ 
		if( jQuery("#sky-tab-cyberchimps_blog_heading").hasClass("active") )
		{
			jQuery(".blog-section-order-tracker").change(function () {
				var array = $(this).val().split(",");
				$.each(page_subsection_map, function (key, value) {
					if ($.inArray(key, array) != -1) {
						$("#sky-tab-label-" + value).show();
					} else {
						$("#sky-tab-label-" + value).hide();
					}
				});
			}).change();			
		}

		if( jQuery('.blog_sub_headings_new').hasClass("active") )
		{
			var q = jQuery(this).find("a").attr('href');
			$('html, body').animate({ scrollTop: $(q).offset().top - 30 }, 'slow');			
		}
		
	
	});

	if( jQuery("#sky-tab-cyberchimps_blog_heading").hasClass("active") )
	{
		jQuery(".blog-section-order-tracker").change(function () {
			var array = $(this).val().split(",");
			$.each(page_subsection_map, function (key, value) {
				if ($.inArray(key, array) != -1) {
					$("#sky-tab-label-" + value).show();
				} else {
					$("#sky-tab-label-" + value).hide();
				}
			});
		}).change();
	}
	
	

});
