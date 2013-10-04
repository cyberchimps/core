<?php

/* Text */
add_filter( 'cyberchimps_sanitize_text', 'sanitize_text_field' );

/* Text that allows all html */
function cyberchimps_sanitize_text_html( $input ) {
	$output = wp_kses_post( $input );

	return $output;
}

add_filter( 'cyberchimps_sanitize_text_html', 'cyberchimps_sanitize_text_html' );

/* Unfiltered Textarea */
function cyberchimps_sanitize_unfiltered_textarea( $input ) {
	$output = cyberchimps_get_option( 'html_box', '' );
	if( current_user_can( 'unfiltered_html' ) ) {
		$output = $input;

		return $output;
	}
	else {
		return $output;
	}
}

add_filter( 'cyberchimps_sanitize_unfiltered_textarea', 'cyberchimps_sanitize_unfiltered_textarea' );

/* CSS Textarea */
function cyberchimps_sanitize_csstextarea( $input ) {

	// Remove unwanted white spaces from start and end.
	$input = trim( $input );

	if( !strlen( $input ) ) {
		return $input;
	}

	$input = wp_kses_post( $input );
	if( strlen( $input ) ) {
		$output = $input;
	}
	else {
		$options = get_option( 'cyberchimps_options' );
		$output  = $options['custom_css'];
	}

	return $output;
}

add_filter( 'cyberchimps_sanitize_csstextarea', 'cyberchimps_sanitize_csstextarea' );

/* Textarea */
function cyberchimps_sanitize_textarea( $input ) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags );

	return $output;
}

add_filter( 'cyberchimps_sanitize_textarea', 'cyberchimps_sanitize_textarea' );

/* Select */
add_filter( 'cyberchimps_sanitize_select', 'cyberchimps_sanitize_enum', 10, 2 );

/* Radio */
add_filter( 'cyberchimps_sanitize_radio', 'cyberchimps_sanitize_enum', 10, 2 );

/* Images */
add_filter( 'cyberchimps_sanitize_images', 'cyberchimps_sanitize_enum', 10, 2 );

/* Checkbox */
function cyberchimps_sanitize_checkbox( $input ) {
	if( $input ) {
		$output = '1';
	}
	else {
		$output = false;
	}

	return $output;
}

add_filter( 'cyberchimps_sanitize_checkbox', 'cyberchimps_sanitize_checkbox' );

/* Multicheck */
function cyberchimps_sanitize_multicheck( $input, $option ) {
	$output = '';
	if( is_array( $input ) ) {
		foreach( $option['options'] as $key => $value ) {
			$output[$key] = "0";
		}
		foreach( $input as $key => $value ) {
			if( array_key_exists( $key, $option['options'] ) && $value ) {
				$output[$key] = "1";
			}
		}
	}

	return $output;
}

add_filter( 'cyberchimps_sanitize_multicheck', 'cyberchimps_sanitize_multicheck', 10, 2 );

/* Toggle */
function cyberchimps_sanitize_toggle( $input ) {
	if( $input ) {
		$output = '1';
	}
	else {
		$output = false;
	}

	return $output;
}

add_filter( 'cyberchimps_sanitize_toggle', 'cyberchimps_sanitize_toggle' );

/* Color Picker */
add_filter( 'cyberchimps_sanitize_color', 'cyberchimps_sanitize_hex' );

/* Uploader */
function cyberchimps_sanitize_upload( $input ) {
	$output   = '';
	$filetype = wp_check_filetype( $input );

	// check if gravatar has been set as an image
	if( strpos( $input, 'gravatar' ) ) {
		$output = $input;
	}
	elseif( $filetype["ext"] ) {
		$output = $input;
	}

	return $output;
}

add_filter( 'cyberchimps_sanitize_upload', 'cyberchimps_sanitize_upload' );

/* Editor */
function cyberchimps_sanitize_editor( $input ) {
	if( current_user_can( 'unfiltered_html' ) ) {
		$output = $input;
	}
	else {
		global $allowedtags;
		$output = wpautop( wp_kses( $input, $allowedtags ) );
	}

	return $output;
}

add_filter( 'cyberchimps_sanitize_editor', 'cyberchimps_sanitize_editor' );

/* Allowed Tags */
function cyberchimps_sanitize_allowedtags( $input ) {
	global $allowedtags;
	$output = wpautop( wp_kses( $input, $allowedtags ) );

	return $output;
}

/* Allowed Post Tags */
function cyberchimps_sanitize_allowedposttags( $input ) {
	global $allowedposttags;
	$output = wpautop( wp_kses( $input, $allowedposttags ) );

	return $output;
}

add_filter( 'cyberchimps_sanitize_info', 'cyberchimps_sanitize_allowedposttags' );

/* Check that the key value sent is valid */
function cyberchimps_sanitize_enum( $input, $option ) {
	$output = '';
	if( $input != false ) {
		if( array_key_exists( $input, $option['options'] ) ) {
			$output = $input;
		}
	}

	return $output;
}

/* Section Order */
function cyberchimps_sanitize_section_order( $input, $option ) {
	$output = '';
	if( is_array( $input ) ) {
		foreach( $input as $key => $value ) {
			if( array_key_exists( $key, $option['options'] ) && $key ) {
				$output[] = $key;
			}
			elseif( array_key_exists( $value, $option['options'] ) && $value ) {
				$output[] = $value;
			}
		}
	}

	return $output;
}

add_filter( 'cyberchimps_sanitize_section_order', 'cyberchimps_sanitize_section_order', 10, 2 );

/* Background */
function cyberchimps_sanitize_background( $input ) {
	$output = wp_parse_args( $input, array(
		'color'      => '',
		'image'      => '',
		'repeat'     => 'repeat',
		'position'   => 'top center',
		'attachment' => 'scroll'
	) );

	$output['color']      = apply_filters( 'cyberchimps_sanitize_hex', $input['color'] );
	$output['image']      = apply_filters( 'cyberchimps_sanitize_upload', $input['image'] );
	$output['repeat']     = apply_filters( 'cyberchimps_background_repeat', $input['repeat'] );
	$output['position']   = apply_filters( 'cyberchimps_background_position', $input['position'] );
	$output['attachment'] = apply_filters( 'cyberchimps_background_attachment', $input['attachment'] );

	return $output;
}

add_filter( 'cyberchimps_sanitize_background', 'cyberchimps_sanitize_background' );

function cyberchimps_sanitize_background_repeat( $value ) {
	$recognized = cyberchimps_recognized_background_repeat();
	if( array_key_exists( $value, $recognized ) ) {
		return $value;
	}

	return apply_filters( 'cyberchimps_default_background_repeat', current( $recognized ) );
}

add_filter( 'cyberchimps_background_repeat', 'cyberchimps_sanitize_background_repeat' );

function cyberchimps_sanitize_background_position( $value ) {
	$recognized = cyberchimps_recognized_background_position();
	if( array_key_exists( $value, $recognized ) ) {
		return $value;
	}

	return apply_filters( 'cyberchimps_default_background_position', current( $recognized ) );
}

add_filter( 'cyberchimps_background_position', 'cyberchimps_sanitize_background_position' );

function cyberchimps_sanitize_background_attachment( $value ) {
	$recognized = cyberchimps_recognized_background_attachment();
	if( array_key_exists( $value, $recognized ) ) {
		return $value;
	}

	return apply_filters( 'cyberchimps_default_background_attachment', current( $recognized ) );
}

add_filter( 'cyberchimps_background_attachment', 'cyberchimps_sanitize_background_attachment' );

/* Typography */
function cyberchimps_sanitize_typography( $input, $option ) {

	$output = wp_parse_args( $input, array(
		'size'  => '',
		'face'  => '',
		'style' => '',
		'color' => ''
	) );

	if( isset( $option['options']['faces'] ) && isset( $input['face'] ) ) {
		if( !( array_key_exists( $input['face'], $option['options']['faces'] ) ) ) {
			$output['face'] = '';
		}
	}
	else {
		$output['face'] = apply_filters( 'cyberchimps_font_face', $output['face'] );
	}

	$output['size']  = apply_filters( 'cyberchimps_font_size', $output['size'] );
	$output['style'] = apply_filters( 'cyberchimps_font_style', $output['style'] );
	$output['color'] = apply_filters( 'cyberchimps_sanitize_color', $output['color'] );

	return $output;
}

add_filter( 'cyberchimps_sanitize_typography', 'cyberchimps_sanitize_typography', 10, 2 );

function cyberchimps_sanitize_font_size( $value ) {
	$recognized  = cyberchimps_recognized_font_sizes();
	$value_check = preg_replace( '/px/', '', $value );
	if( in_array( (int)$value_check, $recognized ) ) {
		return $value;
	}

	return apply_filters( 'cyberchimps_default_font_size', $recognized );
}

add_filter( 'cyberchimps_font_size', 'cyberchimps_sanitize_font_size' );

function cyberchimps_sanitize_font_style( $value ) {
	$recognized = cyberchimps_recognized_font_styles();
	if( array_key_exists( $value, $recognized ) ) {
		return $value;
	}

	return apply_filters( 'cyberchimps_default_font_style', current( $recognized ) );
}

add_filter( 'cyberchimps_font_style', 'cyberchimps_sanitize_font_style' );

function cyberchimps_sanitize_font_face( $value ) {
	$recognized = cyberchimps_recognized_font_faces();
	if( array_key_exists( $value, $recognized ) ) {
		return $value;
	}

	return apply_filters( 'cyberchimps_default_font_face', current( $recognized ) );
}

add_filter( 'cyberchimps_font_face', 'cyberchimps_sanitize_font_face' );

/**
 * Get recognized background repeat settings
 *
 * @return   array
 *
 */
function cyberchimps_recognized_background_repeat() {
	$default = array(
		'no-repeat' => __( 'No Repeat', 'cyberchimps_core' ),
		'repeat-x'  => __( 'Repeat Horizontally', 'cyberchimps_core' ),
		'repeat-y'  => __( 'Repeat Vertically', 'cyberchimps_core' ),
		'repeat'    => __( 'Repeat All', 'cyberchimps_core' ),
	);

	return apply_filters( 'cyberchimps_recognized_background_repeat', $default );
}

/**
 * Get recognized background positions
 *
 * @return   array
 *
 */
function cyberchimps_recognized_background_position() {
	$default = array(
		'top left'      => __( 'Top Left', 'cyberchimps_core' ),
		'top center'    => __( 'Top Center', 'cyberchimps_core' ),
		'top right'     => __( 'Top Right', 'cyberchimps_core' ),
		'center left'   => __( 'Middle Left', 'cyberchimps_core' ),
		'center center' => __( 'Middle Center', 'cyberchimps_core' ),
		'center right'  => __( 'Middle Right', 'cyberchimps_core' ),
		'bottom left'   => __( 'Bottom Left', 'cyberchimps_core' ),
		'bottom center' => __( 'Bottom Center', 'cyberchimps_core' ),
		'bottom right'  => __( 'Bottom Right', 'cyberchimps_core' )
	);

	return apply_filters( 'cyberchimps_recognized_background_position', $default );
}

/**
 * Get recognized background attachment
 *
 * @return   array
 *
 */
function cyberchimps_recognized_background_attachment() {
	$default = array(
		'scroll' => __( 'Scroll Normally', 'cyberchimps_core' ),
		'fixed'  => __( 'Fixed in Place', 'cyberchimps_core' )
	);

	return apply_filters( 'cyberchimps_recognized_background_attachment', $default );
}

/**
 * Sanitize a color represented in hexidecimal notation.
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @param    string    The value that this function should return if it cannot be recognized as a color.
 *
 * @return   string
 *
 */
function cyberchimps_sanitize_hex( $hex, $default = '' ) {
	if( cyberchimps_validate_hex( $hex ) ) {
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
function cyberchimps_recognized_font_sizes() {
	$sizes = range( 9, 71 );
	$sizes = apply_filters( 'cyberchimps_recognized_font_sizes', $sizes );
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
function cyberchimps_recognized_font_faces() {
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

	return apply_filters( 'cyberchimps_recognized_font_faces', $default );
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
function cyberchimps_recognized_font_styles() {
	$default = array(
		'normal'      => __( 'Normal', 'cyberchimps_core' ),
		'italic'      => __( 'Italic', 'cyberchimps_core' ),
		'bold'        => __( 'Bold', 'cyberchimps_core' ),
		'bold italic' => __( 'Bold Italic', 'cyberchimps_core' )
	);

	return apply_filters( 'cyberchimps_recognized_font_styles', $default );
}

/**
 * Is a given string a color formatted in hexidecimal notation?
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 *
 * @return   bool
 *
 */
function cyberchimps_validate_hex( $hex ) {
	$hex = trim( $hex );

	/* Strip recognized prefixes. */
	if( 0 === strpos( $hex, '#' ) ) {
		$hex = substr( $hex, 1 );
	}
	elseif( 0 === strpos( $hex, '%23' ) ) {
		$hex = substr( $hex, 3 );
	}

	/* Regex match. */
	if( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		return false;
	}
	else {
		return true;
	}
}