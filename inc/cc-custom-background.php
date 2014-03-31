<?php

add_action(
	'load-appearance_page_custom-background',
	array( 'CC_Custom_Background', 'get_instance' )
);

class CC_Custom_Background {
	protected static $instance = null;

	/**
	 * The name for the option. Will be saved as theme option.
	 */
	protected $option = 'cyberchimps_background';

	/**
	 * Label on the left side of our new option.
	 */
	protected $table_header = 'CyberChimps Background';

	/**
	 * Return an instance.
	 */
	public static function get_instance() {
		null === self::$instance and self::$instance = new self;

		return self::$instance;
	}

	/**
	 * Save our option and register the form.
	 */
	public function __construct() {
		add_action(
			'admin_footer-appearance_page_custom-background',
			array( $this, 'form' )
		);

		add_action( 'admin_head', array( $this, 'cc_background_styles' ) );

		if( empty ( $_POST[$this->option] ) ) {
			return;
		}

		check_admin_referer( $this->option, "_ccnonce-$this->option" );
		set_theme_mod( $this->option, $_POST[$this->option] );
	}

	/**
	 * Create the form elements.
	 */
	public function form() {
		$nonce = wp_nonce_field(
			$this->option,
			"_ccnonce-$this->option",
			true, // check referer
			false // do not echo
		);
		$html  = $nonce . $this->get_radio_fields();
		$this->print_script( $html );
	}

	/**
	 * Create the jQuery function that inserts our form fields.
	 *
	 * @param  string $html Radio buttons
	 *
	 * @return void
	 */
	protected function print_script( $html ) {
		$row = "'<tr><th>$this->table_header</th><td>$html</td></tr>'";
		?>
		<script>jQuery(function <?php echo $this->option; ?>($) {
				$('.form-table:last').append(<?php echo $row; ?>);

				$('.of-radio-img-img').click(function () {
					$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
					$(this).addClass('of-radio-img-selected');
					$(this).siblings('.of-radio-img-radio').attr('checked', 'checked');
				});
			});</script>
	<?php
	}

	/**
	 * Helper for form(). Create radio input fields
	 *
	 * @return string
	 */
	protected function get_radio_fields() {
		$value  = ( get_background_image() ) ? 'none' : get_theme_mod( $this->option, 'none' );
		$radios = array( 'none', 'noise', 'blue', 'dark', 'space', 'debut_light', 'silk', 'grid' );
		$html   = '<div class="images-radio-container"><label for="choose-from-library-link">' . __( 'Or choose one of CyberChimps background images', 'cyberchimps_core' ) . '</label><br>';

		foreach( $radios as $radio ) {
			$html .= '<div class="images-radio-subcontainer">';
			$html .= sprintf(
				' <input type="radio" class="of-radio-img-radio" name="%1$s" style="display:none;" value="%2$s" id="%3$s"%4$s>',
				$this->option,
				$radio,
				"$this->option-$radio",
				// returns ' as value delimiters and has to be escaped
				addslashes( checked( $value, $radio, false ) )
			);
			$selected = ( $value == $radio ) ? ' of-radio-img-selected' : '';
			$html .= '<img src="' . get_template_directory_uri() . '/cyberchimps/lib/images/backgrounds/thumbs/' . $radio . '.png" class="of-radio-img-img' . $selected . '" alt="' . $radio . '" title="' . $radio . '" />';
			$html .= '</div>';
		}

		return "$html</div>";
	}

	public function cc_background_styles() {
		$style = '<style type="text/css">
			.images-radio-container {
				float: left;
				clear: left;
				margin-bottom: 10px;
			}
			.images-radio-container > .images-radio-subcontainer {
				float: left;
				margin-right: 20px;
				margin-bottom: 5px;
			}
			.images-radio-container > .images-radio-subcontainer img {
				border: 5px solid #eee;
				padding: 2px;
			}
			.images-radio-container > .images-radio-subcontainer img.of-radio-img-selected {
				border: 5px solid #5DA7F2;
			}
			.images-radio-container > .images-radio-subcontainer img:hover {
				cursor: pointer;
				border: 5px solid #5DA7F2;
			}
			</style>';

		echo $style;
	}
}

// Default background image.
function ifeature_background_image( $options ) {
	$imagepath =  get_template_directory_uri() . '/cyberchimps/lib/images/';
	$options = array(
			'none' => $imagepath . 'backgrounds/thumbs/none.png',
			'noise' => $imagepath . 'backgrounds/thumbs/noise.png',
			'blue' => $imagepath . 'backgrounds/thumbs/blue.png',
			'dark' => $imagepath . 'backgrounds/thumbs/dark.png',
			'space' => $imagepath . 'backgrounds/thumbs/space.png',
			'debut_light' => $imagepath . 'backgrounds/thumbs/debut_light.png',
			'silk' => $imagepath . 'backgrounds/thumbs/silk.png',
			'grid' => $imagepath . 'backgrounds/thumbs/grid.png',
			);
	return $options;
}
add_filter( 'cyberchimps_background_image', 'ifeature_background_image' );

// default background color
function ifeature_default_background_color() {
	$color = 'f7f7f7';
	return $color;
}
add_filter( 'default_background_color', 'ifeature_default_background_color' );