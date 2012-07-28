<?php
/**
 * FIXME: Edit Title Content
 *
 * FIXME: Edit Description Content
 *
 * Please do not edit this file. This file is part of the Response core framework and all modifications
 * should be made in a child theme.
 * FIXME: POINT USERS TO DOWNLOAD OUR STARTER CHILD THEME AND DOCUMENTATION
 *
 * @category Response
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

// TODO: this is where we will build our default headings for the options page
function response_add_core_headings( $headings_list ) {
	
	$headings_list = array();
	
	$headings_list[] = array(
		'id' => 'response_welcome_heading',
		'title' => __('Welcome', 'response'),
		'description' => __('Welcome Description', 'response'),
	);
	
	$headings_list[] = array(
		'id' => 'response_design_heading',
		'title' => __('Design', 'response'),
		'description' => __('Design Description', 'response'),
	);
	
	$headings_list[] = array(
		'id' => 'response_header_heading',
		'title' => __('Header', 'response'),
		'description' => __('Header Description', 'response'),
	);
	
	$headings_list[] = array(
		'id' => 'response_blog_heading',
		'title' => __('Blog', 'response'),
		'description' => __('Blog Description', 'response'),
	);
	
	$headings_list[] = array(
		'id' => 'response_templates_heading',
		'title' => __('Templates', 'response'),
	);
	
	$headings_list[] = array(
		'id' => 'response_footer_heading',
		'title' => __('Footer', 'response'),
	);
	
	$headings_list[] = array(
		'id' => 'response_import_export_heading',
		'title' => __('Import/Export', 'response'),
	);
	
	return $headings_list;
}
add_filter('response_heading_list', 'response_add_core_headings');

// TODO: this is where we will build our default sections for the options page
function response_add_core_sections( $sections_list ) {
	
	$sections_list = array();
	
	$sections_list[] = array(
		'id' => 'response_temp_styling_section',
		'label' => __('Styling Section', 'response'),
		'heading' => 'response_design_heading'
	);
	
	$sections_list[] = array(
		'id' => 'response_responsive_section',
		'label' => __('Responsive', 'response'),
		'description' => __('Responsive Description', 'response'),
		'heading' => 'response_design_heading'
	);
	
	$sections_list[] = array(
		'id' => 'response_typography_section',
		'label' => __('Typography', 'response'),
		'description' => __('Typography Description', 'response'),
		'heading' => 'response_design_heading'
	);
	
	$sections_list[] = array(
		'id' => 'response_background_section',
		'label' => __('Background', 'response'),
		'description' => __('Background Description', 'response'),
		'heading' => 'response_design_heading'
	);
	
	$sections_list[] = array(
		'id' => 'response_layout_section',
		'label' => __('Layout', 'response'),
		'description' => __('Layout Description', 'response'),
		'heading' => 'response_design_heading'
	);
	
	$sections_list[] = array(
		'id' => 'response_custom_colors_section',
		'label' => __('Custom Colors', 'response'),
		'description' => __('Custom Colors Description', 'response'),
		'heading' => 'response_design_heading'
	);
	
	$sections_list[] = array(
		'id' => 'response_custom_css_section',
		'label' => __('Custom CSS', 'response'),
		'description' => __('Custom CSS Description', 'response'),
		'heading' => 'response_design_heading'
	);
	
	$sections_list[] = array(
		'id' => 'response_header_drag_drop_section',
		'label' => __('Header Drag/Drop', 'response'),
		'description' => __('Header Drag/Drop Description', 'response'),
		'heading' => 'response_header_heading'
	);

	return $sections_list;
}
add_filter('response_section_list', 'response_add_core_sections');

// TODO: this is where we will build our default sections for the options page
function response_add_core_fields( $fields_list ) {
	
	$fields_list = array();
	
	// Responsive Section
	$fields_list[] = array(
		'id' => 'response_responsive_design_field',
		'name' => __('Responsive Design', 'response'),
		'type' => 'select',
		'std' => 'on',
		'options' => array(
			'on' => __('On', 'response'),
			'off' => __('Off', 'response'),
		),
		'section' => 'response_responsive_section',
		'heading' => 'response_design_heading',
	);
	
	$fields_list[] = array(
		'id' => 'response_responsive_videos_field',
		'name' => __('Responsive Videos', 'response'),
		'type' => 'select',
		'std' => 'on',
		'options' => array(
			'on' => __('On', 'response'),
			'off' => __('Off', 'response'),
		),
		'section' => 'response_responsive_section',
		'heading' => 'response_design_heading',
	);
	
	$fields_list[] = array(
		'id' => 'response_skin_color_field',
		'name' => __('Select a Skin Color', 'response'),
		'type' => 'select',
		'std' => 'default',
		'options' => array(
			'default' => __('Default', 'response'),
			'greeb' => __('Green', 'response'),
		),
		'section' => 'response_responsive_section',
		'heading' => 'response_design_heading',
	);
	
	
	$fields_list[] = array(
		'id' => 'response_responsive_videos_field',
		'name' => __('Responsive Videos', 'response'),
		'type' => 'select',
		'std' => 'on',
		'options' => array(
			'on' => __('On', 'response'),
			'off' => __('Off', 'response'),
		),
		'section' => 'response_responsive_section',
		'heading' => 'response_design_heading',
	);
	
	$fields_list[] = array(
		'id' => 'response_skin_color_field',
		'name' => __('Select a Skin Color', 'response'),
		'type' => 'select',
		'std' => 'default',
		'options' => array(
			'default' => __('Default', 'response'),
			'greeb' => __('Green', 'response'),
		),
		'section' => 'response_responsive_section',
		'heading' => 'response_design_heading',
	);
	
	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);
	
	// Typography Section
	$fields_list[] = array(
		'id' => 'response_typography_field',
		'name' => __('Typkit Code', 'response'),
		'desc' => __('Typekit Code description.', 'response'),
		'type' => 'typography',
		'std' => $typography_defaults,
		'options' => $typography_options,
		'section' => 'response_typography_section',
		'heading' => 'response_design_heading'
	);
	
	$fields_list[] = array(
		'id' => 'response_typekit_code_field',
		'name' => __('Typkit Code', 'response'),
		'desc' => __('Typekit Code description.', 'response'),
		'type' => 'textarea',
		'std' => '',
		'section' => 'response_typography_section',
		'heading' => 'response_design_heading'
	);
	
	$fields_list[] = array(
		'id' => 'response_drag_drop_field',
		'name' => __('Typkit Code', 'response'),
		'desc' => __('Typekit Code description.', 'response'),
		'callback' => 'response_drag_drop_field',
		'std' => "ifeature_header_content",
		'options' => array(
			"ifeature_header_content" => "Logo + Icons",
			"ifeature_sitename_contact" => "Logo + Contact",
			"ifeature_description_icons" => "Description + Icons",
			"ifeature_logo_menu" => "Logo + Menu",
			"ifeature_logo_Description" => "Logo + Description",
			"ifeature_banner" => "Banner",
			"ifeature_custom_header_element" => "Custom",
			"synapse_navigation" => "iMenu",
			"ifeature_sitename_register" => "Logo + Login"
		),
		'section' => 'response_header_drag_drop_section',
		'heading' => 'response_header_heading'
	);
	
	
	/* Fields for Reference Remove Once Fields are Finished */
	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/core/lib/images/';
	
	
	$fields_list[] = array(
		'id' => 'core_text',
		'name' => __('Input Text', 'options_framework_theme'),
		'desc' => __('A text input field.', 'options_framework_theme'),
		'std' => 'Default Value',
		'type' => 'text',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading', // TODO: try to remove and have add_settings_field pull from get_sections()
	);
	
	$fields_list[] = array(
		'name' => __('Input Text Mini', 'options_framework_theme'),
		'desc' => __('A mini text input field.', 'options_framework_theme'),
		'id' => 'example_text_mini',
		'std' => 'Default',
		'class' => 'input-mini',
		'type' => 'text',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Input Text', 'options_framework_theme'),
		'desc' => __('A text input field.', 'options_framework_theme'),
		'id' => 'example_text',
		'std' => 'Default Value',
		'type' => 'text',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Textarea', 'options_framework_theme'),
		'desc' => __('Textarea description.', 'options_framework_theme'),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Input Select Small', 'options_framework_theme'),
		'desc' => __('Small Select Box.', 'options_framework_theme'),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'select-mini', //mini, tiny, small
		'options' => $test_array,
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Input Select Wide', 'options_framework_theme'),
		'desc' => __('A wider select box.', 'options_framework_theme'),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array,
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Select a Category', 'options_framework_theme'),
		'desc' => __('Passed an array of categories with cat_ID and cat_name', 'options_framework_theme'),
		'id' => 'example_select_categories',
		'type' => 'select',
		'options' => $options_categories,
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');
		
	$fields_list[] = array(
		'name' => __('Select a Tag', 'options_check'),
		'desc' => __('Passed an array of tags with term_id and term_name', 'options_check'),
		'id' => 'example_select_tags',
		'type' => 'select',
		'options' => $options_tags,
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Select a Page', 'options_framework_theme'),
		'desc' => __('Passed an pages with ID and post_title', 'options_framework_theme'),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages,
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Input Radio (one)', 'options_framework_theme'),
		'desc' => __('Radio select with default options "one".', 'options_framework_theme'),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array,
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Example Info', 'options_framework_theme'),
		'desc' => __('This is just some example information you can put in the panel.', 'options_framework_theme'),
		'type' => 'info',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Input Checkbox', 'options_framework_theme'),
		'desc' => __('Example checkbox, defaults to true.', 'options_framework_theme'),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Check to Show a Hidden Text Input', 'options_framework_theme'),
		'desc' => __('Click here and see what happens.', 'options_framework_theme'),
		'id' => 'example_showhidden',
		'type' => 'checkbox',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');
		
	$fields_list[] = array(
		'name' => __('Hidden Text Input', 'options_framework_theme'),
		'desc' => __('This option is hidden unless activated by a checkbox click.', 'options_framework_theme'),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Uploader Test', 'options_framework_theme'),
		'desc' => __('This creates a full size uploader that previews the image.', 'options_framework_theme'),
		'id' => 'example_uploader',
		'type' => 'upload',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png'),
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading'
	);

	$fields_list[] = array(
		'name' =>  __('Example Background', 'options_framework_theme'),
		'desc' => __('Change the background CSS.', 'options_framework_theme'),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading' );

	$fields_list[] = array(
		'name' => __('Multicheck', 'options_framework_theme'),
		'desc' => __('Multicheck description.', 'options_framework_theme'),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array,
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	$fields_list[] = array(
		'name' => __('Colorpicker', 'options_framework_theme'),
		'desc' => __('No color selected by default.', 'options_framework_theme'),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading' );
		
	$fields_list[] = array( 'name' => __('Typography', 'options_framework_theme'),
		'desc' => __('Example typography.', 'options_framework_theme'),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading' );
		
	$fields_list[] = array(
		'name' => __('Custom Typography', 'options_framework_theme'),
		'desc' => __('Custom typography options.', 'options_framework_theme'),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options,
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading');

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
		 */

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	$fields_list[] = array(
		'name' => __('Default Text Editor', 'options_framework_theme'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'options_framework_theme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings,
		'section' => 'response_temp_styling_section',
		'heading' => 'response_design_heading' );
	
	return $fields_list;
}
add_filter('response_field_list', 'response_add_core_fields');