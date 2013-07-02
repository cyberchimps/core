/* ****************** validation of portfolio-lite custom-link starts ***************/

jQuery("#publish").click(function(){
	return ( validate_portfolio_link_one() && validate_portfolio_link_two() && validate_portfolio_link_three() && validate_portfolio_link_four() );
});

jQuery("#cyberchimps_portfolio_link_url_one").blur(function(){
	return validate_portfolio_link_one();
});

jQuery("#cyberchimps_portfolio_link_url_two").blur(function(){
	return validate_portfolio_link_two();
});

jQuery("#cyberchimps_portfolio_link_url_three").blur(function(){
	return validate_portfolio_link_three();
});

jQuery("#cyberchimps_portfolio_link_url_four").blur(function(){
	return validate_portfolio_link_four();
});

function validate_portfolio_link_one() {
	// For portfolio one
	if(jQuery('#checkbox-cyberchimps_portfolio_link_toggle_one').is(":checked")) {
		jQuery("tr.cyberchimps_portfolio_link_url_one td").append("<lable class='validation_error' id='url_validation_msg1'></lable>");
		var reg_url = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
		var custom_url = jQuery("#cyberchimps_portfolio_link_url_one").val();
		if((custom_url.search(reg_url)) == -1 || custom_url == "") {
			jQuery("#url_validation_msg1").html("Please enter a valid URL");
			alert("Please enter a valid URL for Portfolio Lite Options")
			return false;
		}
		else {
			jQuery("#url_validation_msg1").html("");
		}
	}
	return true;
}
	
// For portfolio two
function validate_portfolio_link_two() {
	if(jQuery('#checkbox-cyberchimps_portfolio_link_toggle_two').is(":checked")) {
		jQuery("tr.cyberchimps_portfolio_link_url_two td").append("<lable class='validation_error' id='url_validation_msg2'></lable>");
		var reg_url = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
		var custom_url = jQuery("#cyberchimps_portfolio_link_url_two").val();
		if((custom_url.search(reg_url)) == -1 || custom_url == "") {
			jQuery("#url_validation_msg2").html("Please enter a valid URL");
			alert("Please enter a valid URL for Portfolio Lite Options")
			return false;
		}
		else {
			jQuery("#url_validation_msg2").html("");
		}
	}
	return true;
}	

// For portfolio three
function validate_portfolio_link_three() {
	if(jQuery('#checkbox-cyberchimps_portfolio_link_toggle_three').is(":checked")) {
		jQuery("tr.cyberchimps_portfolio_link_url_three td").append("<lable class='validation_error' id='url_validation_msg3'></lable>");
		var reg_url = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
		var custom_url = jQuery("#cyberchimps_portfolio_link_url_three").val();
		if((custom_url.search(reg_url)) == -1 || custom_url == "") {
			jQuery("#url_validation_msg3").html("Please enter a valid URL");
			alert("Please enter a valid URL for Portfolio Lite Options")
			return false;
		}
		else {
			jQuery("#url_validation_msg3").html("");
		}
	}
	return true;
}
	
// For portfolio four
function validate_portfolio_link_four() {
	if(jQuery('#checkbox-cyberchimps_portfolio_link_toggle_four').is(":checked")) {
		jQuery("tr.cyberchimps_portfolio_link_url_four td").append("<lable class='validation_error' id='url_validation_msg4'></lable>");
		var reg_url = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
		var custom_url = jQuery("#cyberchimps_portfolio_link_url_four").val();
		if((custom_url.search(reg_url)) == -1 || custom_url == "") {
			jQuery("#url_validation_msg4").html("Please enter a valid URL");
			alert("Please enter a valid URL for Portfolio Lite Options")
			return false;
		}
		else {
			jQuery("#url_validation_msg4").html("");
		}
	}
	return true;
}

/* ****************** validation of portfolio-lite custom-link ends ***************/

jQuery(document).ready(function($) {

	// Hide/show category field of featured post option with respect to selcted option
	var val = jQuery('[name="cyberchimps_featured_post_category_toggle"]').val();
	if( val == 0 )
		jQuery('.cyberchimps_featured_post_category').hide();
	 
	jQuery('[name="cyberchimps_featured_post_category_toggle"]').change(function(){
		var val = jQuery('[name="cyberchimps_featured_post_category_toggle"]').val();
		if( val == 0 )
			jQuery('.cyberchimps_featured_post_category').hide();
		else if( val == 1 )
			jQuery('.cyberchimps_featured_post_category').show();
	});

	// tab between them
	jQuery('.metabox-tabs li a').each(function(i) {
		var thisTab = jQuery(this).parent().attr('class').replace(/active /, '');

		if ( 'active' != jQuery(this).attr('class') )
			jQuery('div.' + thisTab).hide();
		
		jQuery('div.' + thisTab).addClass('tab-content');
 
		jQuery(this).click(function(){
			// hide all child content
			jQuery(this).parent().parent().parent().children('div').hide();
 
			// remove all active tabs
			jQuery(this).parent().parent('ul').find('li.active').removeClass('active');
 
			// show selected content
			jQuery(this).parent().parent().parent().find('div.'+thisTab).show();
			jQuery(this).parent().parent().parent().find('li.'+thisTab).addClass('active');
		});
	});

	jQuery('.heading').hide();
	jQuery('.metabox-tabs').show();
	
	jQuery(".subsection-items").hide();
	jQuery("#subsection-Boxes-Element .subsection-items").show();
	$(".subsection > h4").click(function() {
		var $this = $(this);
		$this.find("span.minus").removeClass('minus');
		if($this.siblings('div').is(":visible")) {
			$this.siblings('div').fadeOut();
		} else {
			$this.siblings('div').fadeIn();
			$this.find("span").addClass('minus');
		}
	});

	// show by default
	
	$("#subsection-Boxes-Lite-Element").children('.subsection-items').show();
	$("#subsection-Custom-Slide-Options > h4").click();
	$("#subsection-Featured-Post-Carousel-Options > h4").click();
	$("#subsection-Portfolio-Element > h4").click();

	$("#subsection-Page-Options > h4").click();
	var page_subsection_map = {
		page_slider			: "subsection-iFeature-Slider-Options",
		page_nivoslider		: "subsection-iFeature-Pro-NivoSlider-Options",
		callout_section		: "subsection-Callout-Options",
		carousel_section	: "subsection-Carousel-Options",
		html_box			: "subsection-HTML-Box-Options",
		portfolio_pro		: "subsection-Portfolio-Options",
		custom_html_element	: "subsection-Custom-HTML",
		product_element		: "subsection-Product-Options",
		twitterbar_section	: "subsection-Twitter-Options",
		magazine			: "subsection-Magazine-Layout-Options",
		slider_lite			: "subsection-Slider-Lite-Options",
		portfolio_lite		: "subsection-Portfolio-Lite-Options",
		recent_posts		: "subsection-Recent-Posts-Options",
		//featured_posts		: "subsection-Featured-Posts-Options",
		boxes				: "subsection-Boxes-Options",
		//profile				: "subsection-Profile-Options"
	};
	$(".section-order-tracker").change(function(){
		var array = $(this).val().split(",");
		$.each(page_subsection_map, function(key, value) {
			if($.inArray(key, array) != -1) {
				$("#" + value).show();
			} else {
				$("#" + value).hide();
			}
		});
	}).change();


	// image_select
	$(".image_select").each(function(){
		$(this).find("img").click(function(){
			if($(this).hasClass('selected')) return;
			$(this).siblings("img").removeClass('selected');
			$(this).addClass('selected');
			$(this).siblings("input").val($(this).data("key"));
		});
    if($(this).find("img.selected").length) {
			$(this).find("input").val($(this).find("img.selected").data("key"));
    }
	});

	 /*
      Add toggle switch after each checkbox.  If checked, then toggle the switch.
    */
     $('.checkbox').after(function(){
       if ($(this).is(":checked")) {
         return "<a href='#' class='toggle checked' ref='"+$(this).attr("id")+"'></a>";
       }else{
         return "<a href='#' class='toggle' ref='"+$(this).attr("id")+"'></a>";
       }
       
     });
     
     /*
      When the toggle switch is clicked, check off / de-select the associated checkbox
     */
    $('.toggle').click(function(e) {
       var checkboxID = $(this).attr("ref");
       var checkbox = $('#'+checkboxID);

       if (checkbox.is(":checked")) {
         checkbox.removeAttr("checked").change();
       }else{
         checkbox.attr("checked","checked").change();
       }
       $(this).toggleClass("checked");

       e.preventDefault();

    });

    /*
      For demo purposes only....shows/hides checkboxes.
    */
    $('#showCheckboxes').click(function(e) {
     $('.checkbox').toggle()
     e.preventDefault();
    });

    $('#checkbox-extra_callout_options').change(function(){
	    var items = $("tr.callout_image, tr.custom_callout_color, tr.custom_callout_title_color, tr.custom_callout_text_color, tr.custom_callout_button_color, tr.custom_callout_button_text_color");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
		$("#checkbox-disable_callout_button").trigger("change");
    }).trigger('change');

    $('#checkbox-disable_callout_button').change(function(){
	    var items = $("tr.callout_button_text, tr.callout_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
    $('#checkbox-portfolio_title_toggle').change(function(){
	    var items = $("tr.portfolio_title");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
	}).trigger('change');
	
	$('#checkbox-cyberchimps_portfolio_title_toggle').change(function(){
	    var items = $("tr.cyberchimps_portfolio_title");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	$('#checkbox-cyberchimps_recent_posts_title_toggle').change(function(){
	    var items = $("tr.cyberchimps_recent_posts_title");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
    
	$('#checkbox-product_link_toggle').change(function(){
	var items = $("tr.product_link_url, tr.product_link_text");
	if($(this).is(':checked')) {
		items.show();
	} else {
		items.hide();
	}
    }).trigger('change');
	
	$('#checkbox-cyberchimps_portfolio_link_toggle_one').change(function(){
	var items = $("tr.cyberchimps_portfolio_link_url_one");
	if($(this).is(':checked')) {
		items.show();
	} else {
		items.hide();
	}
    }).trigger('change');
	
	$('#checkbox-cyberchimps_portfolio_link_toggle_two').change(function(){
	var items = $("tr.cyberchimps_portfolio_link_url_two");
	if($(this).is(':checked')) {
		items.show();
	} else {
		items.hide();
	}
    }).trigger('change');
	
	$('#checkbox-cyberchimps_portfolio_link_toggle_three').change(function(){
	var items = $("tr.cyberchimps_portfolio_link_url_three");
	if($(this).is(':checked')) {
		items.show();
	} else {
		items.hide();
	}
    }).trigger('change');
	
	$('#checkbox-cyberchimps_portfolio_link_toggle_four').change(function(){
	var items = $("tr.cyberchimps_portfolio_link_url_four");
	if($(this).is(':checked')) {
		items.show();
	} else {
		items.hide();
	}
    }).trigger('change');
	
	$('#checkbox-cyberchimps_magazine_wide_post_toggle').change(function(){
	var items = $("tr.cyberchimps_magazine_no_of_wide_posts");
	if($(this).is(':checked')) {
		items.show();
	} else {
		items.hide();
	}
    }).trigger('change');
	
	/* To toggle URL tab on change of custom_portfolio_url_toggle */
	$('#checkbox-custom_portfolio_url_toggle').change(function(){
	    var items = $("tr.custom_portfolio_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	/* Social toggles for profile starts */
	$('#checkbox-profile_twitter').change(function(){
	    var items = $("tr.profile_twitter_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	$('#checkbox-profile_facebook').change(function(){
	    var items = $("tr.profile_facebook_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	$('#checkbox-profile_google').change(function(){
	    var items = $("tr.profile_google_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	$('#checkbox-profile_flickr').change(function(){
	    var items = $("tr.profile_flickr_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	$('#checkbox-profile_pinterest').change(function(){
	    var items = $("tr.profile_pinterest_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	$('#checkbox-profile_linkedin').change(function(){
	    var items = $("tr.profile_linkedin_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	$('#checkbox-profile_youtube').change(function(){
	    var items = $("tr.profile_youtube_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	$('#checkbox-profile_rss').change(function(){
	    var items = $("tr.profile_rss_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	$('#checkbox-profile_email_id').change(function(){
	    var items = $("tr.profile_email_id_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	
	$('#checkbox-profile_googlemaps').change(function(){
	    var items = $("tr.profile_googlemaps_url");
		if($(this).is(':checked')) {
			items.show();
		} else {
			items.hide();
		}
    }).trigger('change');
	/* Social toggles for profile ends */
});