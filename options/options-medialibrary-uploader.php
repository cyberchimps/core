<?php
/**
 * WooThemes Media Library-driven AJAX File Uploader Module (2010-11-05)
 *
 * Slightly modified and Forked from the Options Framework
 *
 */
if( is_admin() ) {
	// Load additional css and js for image uploads on the Cyber Chimps Framework Theme Options page
	$cyberchimps_page = 'appearance_page_cyberchimps_theme_options';
	add_action( "admin_print_styles-$cyberchimps_page", 'cyberchimps_mlu_css', 0 );
	add_action( "admin_print_scripts-$cyberchimps_page", 'cyberchimps_mlu_js', 0 );
}

/**
 * Sets up a custom post type to attach image to. This allows us to have
 * individual galleries for different uploaders.
 */
if( !function_exists( 'cyberchimps_mlu_init' ) ) {
	function cyberchimps_mlu_init() {
		register_post_type( 'cybrchmpsthmoption', array(
			'labels'            => array(
				'name' => __( 'Theme Options Media', 'cyberchimps_core' ),
			),
			'public'            => true,
			'show_ui'           => false,
			'capability_type'   => 'post',
			'hierarchical'      => false,
			'rewrite'           => false,
			'supports'          => array( 'title', 'editor' ),
			'query_var'         => false,
			'can_export'        => true,
			'show_in_nav_menus' => false,
			'public'            => false
		) );
	}
}

/**
 * Adds the Thickbox CSS file and specific loading and button images to the header
 * on the pages where this function is called.
 */
if( !function_exists( 'cyberchimps_mlu_css' ) ) {
	function cyberchimps_mlu_css() {
		$_html = '';
		$_html .= '<link rel="stylesheet" href="' . dirname( __FILE__ ) . '/lib/js/thickbox/thickbox.css" type="text/css" media="screen" />' . "\n";
		$_html .= '<script type="text/javascript">
		var tb_pathToImage = "' . dirname( __FILE__ ) . '/lib/js/thickbox/loadingAnimation.gif";
	    var tb_closeImage = "' . dirname( __FILE__ ) . '/lib/js/thickbox/tb-close.png";
	    </script>' . "\n";
		echo $_html;
	}
}

/**
 * Registers and enqueues (loads) the necessary JavaScript file for working with the
 * Media Library-driven AJAX File Uploader Module.
 */
if( !function_exists( 'cyberchimps_mlu_js' ) ) {
	function cyberchimps_mlu_js() {
		// Registers custom scripts for the Media Library AJAX uploader.
		wp_enqueue_script( 'cyberchimps-medialibrary-uploader', dirname( __FILE__ ) . '/lib/js/options-medialibrary-uploader.js', array( 'jquery', 'thickbox' ) );
		wp_enqueue_script( 'media-upload' );
	}
}

/**
 * Media Uploader Using the WordPress Media Library.
 *
 * Parameters:
 * - string $_id - A token to identify this field (the name).
 * - string $_value - The value of the field, if present.
 * - string $_mode - The display mode of the field.
 * - string $_desc - An optional description of the field.
 * - int $_postid - An optional post id (used in the meta boxes).
 *
 * Dependencies:
 * - optionsframework_mlu_get_silentpost()
 */
if( !function_exists( 'cyberchimps_medialibrary_uploader' ) ) {
	function cyberchimps_medialibrary_uploader( $_class, $_id, $_value, $_mode = 'full', $_desc = '', $_postid = 0, $_name = '' ) {

		$output          = '';
		$id              = '';
		$class           = '';
		$container_class = '';
		$int             = '';
		$value           = '';
		$name            = '';

		$id              = strip_tags( strtolower( $_id ) );
		$container_class = strip_tags( strtolower( $_class ) );
		// Change for each field, using a "silent" post. If no post is present, one will be created.
		$int = cyberchimps_mlu_get_silentpost( $id );

		// If a value is passed and we don't have a stored value, use the value that's passed through.
		if( $_value != '' && $value == '' ) {
			$value = $_value;
		}

		if( $_name != '' ) {
			$name = '[' . $id . '][' . $_name . ']';
		}
		else {
			$name = '[' . $id . ']';
		}

		if( $value ) {
			$class = ' has-file';
		}

		$output .= '<div class="input-append ' . $container_class . '"><input id="' . $id . '" class="upload" type="text" name="cyberchimps_options' . $name . '" value="' . $value . '" />' . "\n";
		$output .= '<input id="upload_' . $id . '" class="upload_button btn" type="button" value="' . __( 'Upload', 'cyberchimps_core' ) . '" rel="' . $int . '" /></div>' . "\n";

		if( $_desc != '' ) {
			$output .= '<span class="cyberchimps_metabox_desc">' . $_desc . '</span>' . "\n";
		}

		$output .= '<div class="screenshot" id="' . $id . '_image">' . "\n";

		if( $value != '' ) {
			$remove = '<a href="javascript:(void);" class="mlu_remove button">Remove</a>';
			$image  = ( strpos( $value, 'gravatar' ) ) ? $value : preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );
			if( $image ) {
				$output .= '<img src="' . $value . '" alt="" />' . $remove . '';
			}
			else {
				$parts = explode( "/", $value );
				for( $i = 0; $i < sizeof( $parts ); ++$i ) {
					$title = $parts[$i];
				}

				// No output preview if it's not an image.			
				$output .= '';

				// Standard generic output if it's not an image.	
				$title = __( 'View File', 'cyberchimps_core' );
				$output .= '<div class="no_image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span>' . $remove . '</div>';
			}
		}
		$output .= '</div>' . "\n";

		return $output;
	}
}

/**
 * Uses "silent" posts in the database to store relationships for images.
 * This also creates the facility to collect galleries of, for example, logo images.
 *
 * Return: $_postid.
 *
 * If no "silent" post is present, one will be created with the type "optionsframework"
 * and the post_name of "of-$_token".
 *
 * Example Usage:
 * optionsframework_mlu_get_silentpost ( 'cyberchimps_logo' );
 */
if( !function_exists( 'cyberchimps_mlu_get_silentpost' ) ) {
	function cyberchimps_mlu_get_silentpost( $_token ) {
		global $wpdb;
		$_id = 0;

		$_token = strtolower( str_replace( ' ', '_', $_token ) );

		if( $_token ) {

			// Tell the function what to look for in a post.
			$_args = array( 'post_type' => 'cybrchmpsthmoption', 'post_name' => 'of-' . $_token, 'post_status' => 'draft', 'comment_status' => 'closed', 'ping_status' => 'closed' );

			// Look in the database for a "silent" post that meets our criteria.
			$query = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_parent = 0';
			foreach( $_args as $k => $v ) {
				$query .= ' AND ' . $k . ' = "' . $v . '"';
			} // End FOREACH Loop

			$query .= ' LIMIT 1';
			$_posts = $wpdb->get_row( $query );

			// If we've got a post, loop through and get it's ID.
			if( count( $_posts ) ) {
				$_id = $_posts->ID;
			}
			else {

				// If no post is present, insert one.
				// Prepare some additional data to go with the post insertion.
				$_words     = explode( '_', $_token );
				$_title     = join( ' ', $_words );
				$_title     = ucwords( $_title );
				$_post_data = array( 'post_title' => $_title );
				$_post_data = array_merge( $_post_data, $_args );
				$_id        = wp_insert_post( $_post_data );
			}
		}

		return $_id;
	}
}

/**
 * Trigger code inside the Media Library popup.
 */
if( !function_exists( 'cyberchimps_mlu_insidepopup' ) ) {

	function cyberchimps_mlu_insidepopup() {

		if( isset( $_REQUEST['is_cybrchmpsthmoption'] ) && $_REQUEST['is_cybrchmpsthmoption'] == 'yes' ) {

			add_action( 'admin_head', 'cyberchimps_mlu_js_popup' );
			add_filter( 'media_upload_tabs', 'cyberchimps_mlu_modify_tabs' );
		}
	}
}

if( !function_exists( 'cyberchimps_mlu_js_popup' ) ) {
	function cyberchimps_mlu_js_popup() {

		$_cyberchimps_title = $_REQUEST['cyberchimps_title'];
		if( !$_cyberchimps_title ) {
			$_cyberchimps_title = 'file';
		} // End IF Statement
		?>
		<script type="text/javascript">
			<!--
			jQuery(function ($) {

				jQuery.noConflict();

				// Change the title of each tab to use the custom title text instead of "Media File".
				$('h3.media-title').each(function () {
					var current_title = $(this).html();
					var new_title = current_title.replace('media file', '<?php echo $_cyberchimps_title; ?>');
					$(this).html(new_title);
				});

				// Change the text of the "Insert into Post" buttons to read "Use this File".
				$('.savesend input.button[value*="Insert into Post"], .media-item #go_button').attr('value', 'Use this File');

				// Hide the "Insert Gallery" settings box on the "Gallery" tab.
				$('div#gallery-settings').hide();

				// Preserve the "is_cybrchmpsthmoption" parameter on the "delete" confirmation button.
				$('.savesend a.del-link').click(function () {
					var continueButton = $(this).next('.del-attachment').children('a.button[id*="del"]');
					var continueHref = continueButton.attr('href');
					continueHref = continueHref + '&is_cybrchmpsthmoption=yes';
					continueButton.attr('href', continueHref);
				});

			});
			-->
		</script>
	<?php
	}
}

/**
 * Triggered inside the Media Library popup to modify the title of the "Gallery" tab.
 */
if( !function_exists( 'cyberchimps_mlu_modify_tabs' ) ) {
	function cyberchimps_mlu_modify_tabs( $tabs ) {
		$tabs['gallery'] = str_replace( __( 'Gallery', 'cyberchimps_core' ), __( 'Previously Uploaded', 'cyberchimps_core' ), $tabs['gallery'] );

		return $tabs;
	}
}