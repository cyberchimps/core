<?php

/* Text */
add_filter( 'response_sanitize_text', 'sanitize_text_field' );

/* Textarea */
function response_sanitize_textarea($input) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags);
	return $output;
}
add_filter( 'response_sanitize_textarea', 'response_sanitize_textarea' );

/* Select */
add_filter( 'response_sanitize_select', 'response_sanitize_enum', 10, 2);

/* Radio */
add_filter( 'response_sanitize_radio', 'response_sanitize_enum', 10, 2);

/* Images */
add_filter( 'response_sanitize_images', 'response_sanitize_enum', 10, 2);

/* Checkbox */
function response_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}
add_filter( 'response_sanitize_checkbox', 'response_sanitize_checkbox' );

/* Multicheck */
function response_sanitize_multicheck( $input, $option ) {
	$output = '';
	if ( is_array( $input ) ) {
		foreach( $option['options'] as $key => $value ) {
			$output[$key] = "0";
		}
		foreach( $input as $key => $value ) {
			if ( array_key_exists( $key, $option['options'] ) && $value ) {
				$output[$key] = "1";
			}
		}
	}
	return $output;
}
add_filter( 'response_sanitize_multicheck', 'response_sanitize_multicheck', 10, 2 );

/* Toggle */
function response_sanitize_toggle( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}
add_filter( 'response_sanitize_toggle', 'response_sanitize_toggle' );

/* Color Picker */
add_filter( 'response_sanitize_color', 'response_sanitize_hex' );

/* Uploader */
function response_sanitize_upload( $input ) {
	$output = '';
	$filetype = wp_check_filetype($input);
	if ( $filetype["ext"] ) {
		$output = $input;
	}
	return $output;
}
add_filter( 'response_sanitize_upload', 'response_sanitize_upload' );

/* Editor */
function response_sanitize_editor($input) {
	if ( current_user_can( 'unfiltered_html' ) ) {
		$output = $input;
	}
	else {
		global $allowedtags;
		$output = wpautop(wp_kses( $input, $allowedtags));
	}
	return $output;
}
add_filter( 'response_sanitize_editor', 'response_sanitize_editor' );

/* Allowed Tags */
function response_sanitize_allowedtags($input) {
	global $allowedtags;
	$output = wpautop(wp_kses( $input, $allowedtags));
	return $output;
}

/* Allowed Post Tags */
function response_sanitize_allowedposttags($input) {
	global $allowedposttags;
	$output = wpautop(wp_kses( $input, $allowedposttags));
	return $output;
}
add_filter( 'response_sanitize_info', 'response_sanitize_allowedposttags' );

/* Check that the key value sent is valid */
function response_sanitize_enum( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option['options'] ) ) {
		$output = $input;
	}
	return $output;
}

/* Section Order */
function response_sanitize_section_order( $input, $option ) {
	$output = '';
	if ( is_array( $input ) ) {
		foreach( $input as $key => $value ) {
			if ( array_key_exists( $key, $option['options'] ) && $value ) {
				$output[$key] = true;
			}
		}
	}
	return $output;
}
add_filter( 'response_sanitize_section_order', 'response_sanitize_section_order', 10, 2 );

/* Background */
function response_sanitize_background( $input ) {
	$output = wp_parse_args( $input, array(
		'color' => '',
		'image'  => '',
		'repeat'  => 'repeat',
		'position' => 'top center',
		'attachment' => 'scroll'
	) );

	$output['color'] = apply_filters( 'response_sanitize_hex', $input['color'] );
	$output['image'] = apply_filters( 'response_sanitize_upload', $input['image'] );
	$output['repeat'] = apply_filters( 'response_background_repeat', $input['repeat'] );
	$output['position'] = apply_filters( 'response_background_position', $input['position'] );
	$output['attachment'] = apply_filters( 'response_background_attachment', $input['attachment'] );

	return $output;
}
add_filter( 'response_sanitize_background', 'response_sanitize_background' );

function response_sanitize_background_repeat( $value ) {
	$recognized = response_recognized_background_repeat();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'response_default_background_repeat', current( $recognized ) );
}
add_filter( 'response_background_repeat', 'response_sanitize_background_repeat' );

function response_sanitize_background_position( $value ) {
	$recognized = response_recognized_background_position();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'response_default_background_position', current( $recognized ) );
}
add_filter( 'response_background_position', 'response_sanitize_background_position' );

function response_sanitize_background_attachment( $value ) {
	$recognized = response_recognized_background_attachment();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'response_default_background_attachment', current( $recognized ) );
}
add_filter( 'response_background_attachment', 'response_sanitize_background_attachment' );

/* Typography */
function response_sanitize_typography( $input, $option ) {

	$output = wp_parse_args( $input, array(
		'size'  => '',
		'face'  => '',
		'style' => '',
		'color' => ''
	) );

	if ( isset( $option['options']['faces'] ) && isset( $input['face'] ) ) {
		if ( !( array_key_exists( $input['face'], $option['options']['faces'] ) ) ) {
			$output['face'] = '';
		}
	}
	else {
		$output['face']  = apply_filters( 'response_font_face', $output['face'] );
	}

	$output['size']  = apply_filters( 'response_font_size', $output['size'] );
	$output['style'] = apply_filters( 'response_font_style', $output['style'] );
	$output['color'] = apply_filters( 'response_sanitize_color', $output['color'] );
	return $output;
}
add_filter( 'response_sanitize_typography', 'response_sanitize_typography', 10, 2 );

function response_sanitize_font_size( $value ) {
	$recognized = response_recognized_font_sizes();
	$value_check = preg_replace('/px/','', $value);
	if ( in_array( (int) $value_check, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'response_default_font_size', $recognized );
}
add_filter( 'response_font_size', 'response_sanitize_font_size' );

function response_sanitize_font_style( $value ) {
	$recognized = response_recognized_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'response_default_font_style', current( $recognized ) );
}
add_filter( 'response_font_style', 'response_sanitize_font_style' );

function response_sanitize_font_face( $value ) {
	$recognized = response_recognized_font_faces();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'response_default_font_face', current( $recognized ) );
}
add_filter( 'response_font_face', 'response_sanitize_font_face' );

/**
 * Get recognized background repeat settings
 *
 * @return   array
 *
 */
function response_recognized_background_repeat() {
	$default = array(
		'no-repeat' => __('No Repeat', 'response'),
		'repeat-x'  => __('Repeat Horizontally', 'response'),
		'repeat-y'  => __('Repeat Vertically', 'response'),
		'repeat'    => __('Repeat All', 'response'),
		);
	return apply_filters( 'response_recognized_background_repeat', $default );
}

/**
 * Get recognized background positions
 *
 * @return   array
 *
 */
function response_recognized_background_position() {
	$default = array(
		'top left'      => __('Top Left', 'response'),
		'top center'    => __('Top Center', 'response'),
		'top right'     => __('Top Right', 'response'),
		'center left'   => __('Middle Left', 'response'),
		'center center' => __('Middle Center', 'response'),
		'center right'  => __('Middle Right', 'response'),
		'bottom left'   => __('Bottom Left', 'response'),
		'bottom center' => __('Bottom Center', 'response'),
		'bottom right'  => __('Bottom Right', 'response')
		);
	return apply_filters( 'response_recognized_background_position', $default );
}

/**
 * Get recognized background attachment
 *
 * @return   array
 *
 */
function response_recognized_background_attachment() {
	$default = array(
		'scroll' => __('Scroll Normally', 'response'),
		'fixed'  => __('Fixed in Place', 'response')
		);
	return apply_filters( 'response_recognized_background_attachment', $default );
}

/**
 * Sanitize a color represented in hexidecimal notation.
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @param    string    The value that this function should return if it cannot be recognized as a color.
 * @return   string
 *
 */
function response_sanitize_hex( $hex, $default = '' ) {
	if ( response_validate_hex( $hex ) ) {
		return $hex;
	}
	return $default;
}

/**
 * Get recognized font sizes.
 *
 * Returns an indexed array of all recognized font sizes.
 * Values are integers and represent a range of sizes from
 * smallest to largest.
 *
 * @return   array
 */
function response_recognized_font_sizes() {
	$sizes = range( 9, 71 );
	$sizes = apply_filters( 'response_recognized_font_sizes', $sizes );
	$sizes = array_map( 'absint', $sizes );
	return $sizes;
}

/**
 * Get recognized font faces.
 *
 * Returns an array of all recognized font faces.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function response_recognized_font_faces() {
	$default = array(
		'arial'     => 'Arial',
		'verdana'   => 'Verdana, Geneva',
		'trebuchet' => 'Trebuchet',
		'georgia'   => 'Georgia',
		'times'     => 'Times New Roman',
		'tahoma'    => 'Tahoma, Geneva',
		'palatino'  => 'Palatino',
		'helvetica' => 'Helvetica*'
		);
	return apply_filters( 'response_recognized_font_faces', $default );
}

/**
 * Get recognized font styles.
 *
 * Returns an array of all recognized font styles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function response_recognized_font_styles() {
	$default = array(
		'normal'      => __('Normal', 'response'),
		'italic'      => __('Italic', 'response'),
		'bold'        => __('Bold', 'response'),
		'bold italic' => __('Bold Italic', 'response')
		);
	return apply_filters( 'response_recognized_font_styles', $default );
}

/**
 * Is a given string a color formatted in hexidecimal notation?
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @return   bool
 *
 */
function response_validate_hex( $hex ) {
	$hex = trim( $hex );
	
	/* Strip recognized prefixes. */
	if ( 0 === strpos( $hex, '#' ) ) {
		$hex = substr( $hex, 1 );
	} elseif ( 0 === strpos( $hex, '%23' ) ) {
		$hex = substr( $hex, 3 );
	}
	
	/* Regex match. */
	if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		return false;
	} else {
		return true;
	}
}