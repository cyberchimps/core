/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */
jQuery(document).ready(function ($) {

	$('#cyberchimps_options_page').submit(function () {

		//options submit check to make sure that the drag and drop element is not empty
		var header = $('#header_section_order').find('.blog-section-order-tracker').val();
		var blog = $('#blog_section_order').find('.blog-section-order-tracker').val();
		if (header == '') {
			$('.right_list').siblings('#values').append('<input type="hidden" name="cyberchimps_options[header_section_order][cyberchimps_header_content]" value="true">');
			$('.right_list').children('.blog-section-order-tracker').val('cyberchimps_header_content');
			return true;
		}
		if (blog == '') {
			$('.right_list').siblings('#values').append('<input type="hidden" name="cyberchimps_options[blog_section_order][blog_post_page]" value="true">');
			$('.right_list').children('.blog-section-order-tracker').val('blog_post_page');
			return true;
		}
	});

	// Hide/show onclick over subsection
	jQuery(".section-group>h3").click(function () {
		var $this = $(this);

		$this.parent().find('div.clear').css("display", "none");
		if ($this.siblings('div').is(":visible")) {
			$this.siblings('div').fadeOut(function () {
				cc_height($('.cc-content').height() - $this.siblings('div').height());
			});

			$this.find("span.glyphicon").removeClass('glyphicon-chevron-down');
			$this.find("span.glyphicon").addClass('glyphicon-chevron-up');
		} else {
			$this.siblings('div').fadeIn(function () {
				cc_height($('.cc-content').height() + $this.siblings('div').height());
			});
			$this.find("span.glyphicon").removeClass('glyphicon-chevron-up');
			$this.find("span.glyphicon").addClass('glyphicon-chevron-down');
		}
	});

	var page_subsection_map = {
		slider_lite: "cyberchimps_blog_slider_lite_section",
		page_slider: "cyberchimps_slider_section",
		callout_section: "cyberchimps_callout_section",
		twitterbar_section: "cyberchimps_twitterbar_section",
		carousel_section: "cyberchimps_carousel_section",
		magazine: "cyberchimps_magazine_section",
		portfolio_lite: "cyberchimps_blog_portfolio_lite_section",
		portfolio_pro: "cyberchimps_portfolio_pro_section",
		product_element: "cyberchimps_product_section",
		recent_posts: "cyberchimps_recent_posts_section",
		html_box: "cyberchimps_html_box_section",
		boxes: "cyberchimps_boxes_section",
		//profile				: "cyberchimps_profile_section"
	};

	jQuery(".blog-section-order-tracker").change(function () {
		var array = $(this).val().split(",");
		$.each(page_subsection_map, function (key, value) {
			if ($.inArray(key, array) != -1) {
				$("#" + value).show();
				$("#" + value + "-tab").parent('li').show();
			} else {
				$("#" + value).hide();
				$("#" + value + "-tab").parent('li').hide();
			}
		});
	}).change();

	// Open/Close all tabs
	$('.cc-collapse').show();
	$('ul.cc-child').hide();
	$('#open-all-tabs').click(function (evt) {
		$('ul.cc-child').show();
		evt.preventDefault();
	});
	$('#close-all-tabs').click(function (evt) {
		$('ul.cc-child').hide();
		evt.preventDefault();
	});

	// Switches option sections
	$('.group').hide();

	var activetab = '';
	if (typeof(localStorage) != 'undefined') {
		activetab = localStorage.getItem("activetab");
	}

	if (activetab != '' && $(activetab).length) {
		$(activetab).fadeIn(function () {
			cc_height($('.cc-content').height());
		});
	} else {
		$('.group:first').fadeIn(function () {
			cc_height($('.cc-content').height());
		});
	}

	$('.group .collapsed').each(function () {
		$(this).find('input:checked').parent().parent().parent().nextAll().each(function () {
			if ($(this).hasClass('last')) {
				$(this).removeClass('hidden');
				return false;
			}
			$(this).filter('.hidden').removeClass('hidden');
		});
	});

	if (activetab != '' && $(activetab + '-tab').length) {
		$(activetab + '-tab').parent().addClass('cc-active');
	} else {
		$('.nav-tab-wrapper > li > a:first').parent().addClass('cc-active');
	}

	$('.nav-tab-wrapper > li > a').click(function (evt) {
		$('ul.cc-child').hide();
		$(this).siblings('.cc-child').show();
		if (!$(this).parent().hasClass('cc-active')) {

			$('.nav-tab-wrapper > li > a').parent().removeClass('cc-active');
			$(this).parent().addClass('cc-active').blur();
			var clicked_group = $(this).attr('href');
			if (typeof(localStorage) != 'undefined') {
				localStorage.setItem("activetab", $(this).attr('href'));
			}
			$('.group').hide();
			$(clicked_group).fadeIn(function () {
				cc_height($(clicked_group).height());
			});
		}
		evt.preventDefault();

		// Editor Height (needs improvement)
		$('.wp-editor-wrap').each(function () {
			var editor_iframe = $(this).find('iframe');
			if (editor_iframe.height() < 30) {
				editor_iframe.css({'height': 'auto'});
			}
		});

	});

	// scroll to section
	$('.cc-child > li > a').click(function (evt) {
		var parent_tab = $(this).parent().parent().parent();
		var parent_group = $(this).parent().parent().siblings('a').attr('href');

		$(this).parent().parent().show();

		// fade in heading area if it is currently not open
		if (!parent_tab.hasClass('cc-active')) {

			$('.nav-tab-wrapper > li > a').parent().removeClass('cc-active');
			parent_tab.addClass('cc-active').blur();
			if (typeof(localStorage) != 'undefined') {
				localStorage.setItem("activetab", parent_group);
			}

			$('.group').hide();
			$(parent_group).show();
		}

		var section_group = $(this).attr('href');
		$('html, body').animate({ scrollTop: $(section_group).offset().top - 30 }, 'slow');
		evt.preventDefault();
	});

	$('.group .collapsed input:checkbox').click(unhideHidden);

	function unhideHidden() {
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		} else {
			$(this).parent().parent().parent().nextAll().each(function () {
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;
				}
				$(this).addClass('hidden');
			});
		}
	}

	// Height function
	function cc_height(height) {
		var height_min = '';
		var total_height = '';
		var content_height = height;
		var menu_height = $('.cc-left-menu ul.cc-parent').height();
		if ($('body').width() > 767) {
			if (height < menu_height) {
				content_height = menu_height + 50;
			} else {
				content_height = content_height + 50;
			}
			total_height = (content_height) + 'px';
		}
		$('.cc-left-menu').height(total_height);
	}

	// Color Picker
	$('.colorSelector').each(function () {
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $(Othis).next('input').attr('value');
		$(this).ColorPicker({
			color: initialColor,
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$(Othis).children('div').css('backgroundColor', '#' + hex);
				$(Othis).next('input').attr('value', '#' + hex);
			}
		});
	}); //end color picker

	// Hide checkboxes and convert them to toggle switches
	$('.checkbox-toggle').hide();
	$('.checkbox-toggle').after(function () {
		if ($(this).is(":checked")) {
			return "<a href='#' class='toggle checked' id='" + $(this).attr("id") + "' ref='" + $(this).attr("id") + "'></a>";
		} else {
			return "<a href='#' class='toggle' id='" + $(this).attr("id") + "' ref='" + $(this).attr("id") + "'></a>";
		}
	});

	// When the toggle switch is clicked, check off / de-select the associated checkbox
	$('.toggle').click(function (e) {
		var checkboxID = $(this).attr("ref");
		var checkbox = $('#' + checkboxID);

		if (checkbox.is(":checked")) {
			checkbox.removeAttr("checked").change();
		} else {
			checkbox.attr("checked", "checked").change();
		}
		$(this).toggleClass("checked");
		e.preventDefault();
	});

	// Image Options
	$('.of-radio-img-img').click(function () {
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});

	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	// Fade out the save message
	$('.fade').delay(1000).fadeOut(1000);

	// Section Order
	var initialize = function (id) {
		var el = $("#" + id);

		function update(base) {
			var value_set = base.find("#values");
			var val = '';
			base.find('.right_list .list_items span').each(function () {
				val += '<input type="hidden" name="' + value_set.data('key') + '[' + id + '][' + $(this).data('key') + ']" value="true" />';
			});
			value_set.html(val);

			el.find('.right_list .action').show();
			el.find('.left_list .action').hide();

			/* To hide subsections when element is removed from active list */
			var hidden = base.find("input[class='blog-section-order-tracker']");
			var val = [];
			base.find('.right_list .list_items span').each(function () {
				val.push($(this).data('key'));
			})
			hidden.val(val.join(",")).change();
			$('.right_list .action').show();
			$('.left_list .action').hide();
		}

		el.find(".left_list .list_items").delegate(".action", "click", function () {
			var item = $(this).closest('.list_item');
			$(this).closest('.section_order').children('.right_list').children('.list_items').append(item);
			update($(this).closest(".section_order"));
		});
		el.find(".right_list .list_items").delegate(".action", "click", function () {
			var item = $(this).closest('.list_item');
			$(this).val('Add');
			$(this).closest('.section_order').children('.left_list').children('.list_items').append(item);
			$(this).hide();
			update($(this).closest(".section_order"));
		});
		el.find(".right_list .list_items").sortable({
			update: function () {
				update($(this).closest(".section_order"));
			},
			connectWith: '#' + id + ' .left_list .list_items'
		});

		el.find(".left_list .list_items").sortable({
			connectWith: '#' + id + ' .right_list .list_items'
		});

		update(el);
	}

	$('.section_order').each(function () {
		initialize($(this).attr('id'));
	});

	// Mobile Modal Menu
	$('#cc-mobile-modal ul.cc-parent > li > a').click(function () {
		$('#cc-mobile-modal').modal('hide');
	});


// sets up scrolling left menu

	$(window).scroll(function () {
		var off_set = $('.cc-header').offset();
		var top_height = '';
		if ($(window).scrollTop() < (80 + off_set.top)) {
			top_height = 0;
		}
		else {
			top_height = $(window).scrollTop() - (80 + off_set.top);
		}
		$('.nav-tab-wrapper')
			.stop()
			.animate({"paddingTop": (top_height) + "px"}, 1);
	});

	/* for the font face preview */

	// Change demo text font on change of font selector dropdown
	$('#typography_options_face').change(function () {
		var font = $(this).val();
		if (font !== "null")
			$("#font_demo_text > p").css("font-family", font);
	});

	// Change demo text font on change of google font input field
	$('#google_font_field').change(function () {
		var font = $(this).val();
		if (font !== "null")
			$("#font_demo_text > p").google_fonts({fontname: font});
	});

	$('#typography_options_size').change(function () {
		var size = $(this).val();
		if (size !== "null")
			$("#font_demo_text > p").css("font-size", size);
	});

	$('#typography_options_style').change(function () {
		var style = $(this).val();
		if (style !== "null")
			$("#font_demo_text > p").css("font-weight", style);
	});

	// Script to show hide the Google Text Font input depending on the value of the Text select
	var text = $('#typography_options_face').val();

	if (text != 'Google Fonts') {
		$('#google_font_field').parent().hide();
	}
	else {
		$('#google_font_field').parent().show();
	}
	$('#typography_options_face').change(function () {
		var text_change = $(this).val();
		if (text_change != 'Google Fonts') {
			$('#google_font_field').parent().hide();
		}
		else {
			$('#google_font_field').parent().show();
		}
	});

	// Script to hide show the Google Heading Font input depending on value of the Heading select
	var font = $('#font_family_headings_face').val();
	if (font != 'Google Fonts') {
		$('#google_font_headings').parent().hide();
	}
	else {
		$('#google_font_headings').parent().show();
	}
	$('#font_family_headings_face').change(function () {
		var font_change = $(this).val();
		if (font_change != 'Google Fonts') {
			$('#google_font_headings').parent().hide();
		}
		else {
			$('#google_font_headings').parent().show();
		}
	});

	/* Hide/Show toggle items */
	$('.field-container').children('.toggle-container').each(function () {
		var toggle = $(this).children(':input');
		var toggle_id = $(this).children(':input').attr('id');

		$(this).change(function () {
			if (toggle.is(":checked")) {
				$('.' + toggle_id + '_toggle').parent('.field-container').fadeIn();
			}
			else {
				$('.' + toggle_id + '_toggle').parent('.field-container').hide();
			}
		}).change();
	});

	/**
	 * Select toggle function watches select inputs and hides/shows relevant sections
	 *
	 * select option must have class select-toggle
	 *
	 * any elements to hide/show must have a class like option-select-toggle
	 *
	 */
	function select_toggle() {
		// Loop through all options
		$('.select-toggle option').each(function () {
			// Get option name
			var value = $(this).val();
			// Create class name for elements
			var classes = '.' + value + '-select-toggle';
			// If the option is selected show that element
			if (this.selected) {
				$(classes).parent('.field-container').show();
			}
			// Otherwise hide it
			else {
				$(classes).parent('.field-container').hide();
			}
		})
	}

	// Run the function once on page load
	$('.select-toggle').each(function () {
		select_toggle();
	})
	// Run the function on select change
	$('.select-toggle').change(function () {
		select_toggle();
	});
	/**
	 * End of select hide/show function
	 */

	/* add controls for modal welcome note */
	$('#welcomeModal').modal();

	$('#welcomeModalSave').click(function (e) {
		$('#modal_welcome_note_display').attr('checked', false);
	});

	/* **************** JS for slider customization starts ****************** */

	// Hide empty slider options 
	$('#cyberchimps_blog_slider_lite_section .field-container-wrapper .field-container').each(function () {
		if ($(this).children('.input-append').children('.upload').val() == '') {
			$(this).hide();
			$(this).next().hide();
			$(this).next().next().hide();
		}
	});

	// Check whetehr total number of slider is less than maximum possible number of sliders.
	if ($('#cyberchimps_blog_slider_lite_section .field-container-wrapper .field-container:last').prev().is(':hidden')) {

		// Add button to add new slider.
		$('#cyberchimps_blog_slider_lite_section .field-container-wrapper').append('<div class="field-container"><button id="add_new_slide" class="btn btn-primary"><i class="icon-plus icon-white"></i></button></div>');

		// Print remaining number of slider that can be added.
		$('#cyberchimps_blog_slider_lite_section .field-container:last').append('<div class="slider-countdown">' + slider_countdown() + ' more sliders remaining</div>');
	}
	else {
		$('#cyberchimps_blog_slider_lite_section .field-container:last').append('Maximum possible number of sliders are already added');
	}

	// Things to be done when add new slider button is clicked.
	$('#cyberchimps_blog_slider_lite_section #add_new_slide').click(function (e) {
		e.preventDefault();

		// running the show thrice call both the slide and link inputs
		$('#cyberchimps_blog_slider_lite_section .field-container-wrapper .field-container:hidden:first').show();
		$('#cyberchimps_blog_slider_lite_section .field-container-wrapper .field-container:hidden:first').show();
		$('#cyberchimps_blog_slider_lite_section .field-container-wrapper .field-container:hidden:first').show();

		// Hide "Add new slider" button if maximum possible number of sliders are already added.
		$('#cyberchimps_blog_slider_lite_section .field-container-wrapper .field-container:last').each(function () {
			if ($(this).prev().is(':visible')) {
				$('#cyberchimps_blog_slider_lite_section #add_new_slide').hide();
			}
			;
		});

		// Modify slider countdown.
		$('.slider-countdown').text(slider_countdown() + ' more sliders remaining');
	});

	// Calculates and returns remaining number of sliders
	function slider_countdown() {
		var countdown = 0;
		$('#cyberchimps_blog_slider_lite_section .field-container').each(function () {
			if ($(this).css('display') == 'none') {
				countdown++;
			}
		});
		return countdown / 3;
	}

	/* **************** JS for slider customization ends ****************** */


	/* TODO this is repeated in metabox-tabs.js see if we can move it into one file */
	/**
	 * function to allow select/dropdown inputs to hide and show conditional form elements
	 *
	 * Give the select a class of .select-hide
	 * Give the sections you want hidden the class of the key/index of the option suffixed with -select
	 *
	 * e.g. a select input with the options (opt1 => 'Option 1', opt2 => 'Option 2') any field with the class of
	 * opt1-select will get shown when opt1 is selected and hidden when opt2 is selected.
	 */
	(function ($) {
		var select_hide = function (option, selected) {
			$.each(option, function (index, value) {
				$('.' + value + '-select-container').hide();
			});
			$('.' + selected + '-select-container').show();
		};

		$('.field-container .select-hide').each(function () {
			$(this).on('change',function () {
				var option = Array;
				var selected = '';
				$(this).children('option').each(function (i) {
					if ($(this).is(':selected')) {
						selected += $(this).val();
					}
					else {
						option[i] = $(this).val();
					}
				})
				select_hide(option, selected);

			}).change();
		});
	})(jQuery);

});