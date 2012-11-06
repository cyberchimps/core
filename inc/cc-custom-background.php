<?php

add_action(
    'load-appearance_page_custom-background',
    array ( 'Cyberchimps_Custom_Background', 'get_instance' )
);

/**
 * Add a new row to the background options table for 'background-origin'.
 *
 * @author  Thomas Scholz http://toscho.de
 * @version 2012.09.10
 */
class Cyberchimps_Custom_Background
{
    /**
     * Main instance.
     * @type object|NULL
     */
    protected static $instance = NULL;

    /**
     * The name for the option. Will be saved as theme option.
     *
     * @link http://www.w3.org/TR/css3-background/#the-background-origin
     * @type string
     */
    protected $option = 'background_image';

    /**
     * Label on the left side of our new option.
     *
     * @type string
     */
    protected $table_header = 'CyberChimps Backgrounds';

    /**
     * Return an instance.
     *
     * @wp-hook load-appearance_page_custom-background
     * @return object
     */
    public static function get_instance()
    {
        NULL === self::$instance and self::$instance = new self;
        return self::$instance;
    }

    /**
     * Save our option and register the form.
     *
     * @wp-hook load-appearance_page_custom-background
     */
    public function __construct()
    {
        add_action(
            'admin_footer-appearance_page_custom-background',
            array ( $this, 'form' )
        );

        if ( empty ( $_POST[ $this->option ] ) )
        {
            return;
        }

        check_admin_referer( $this->option, "_ccnonce-$this->option" );
        set_theme_mod( $this->option, $_POST[ $this->option ] );
    }

    /**
     * Create the form elements.
     *
     * @wp-hook admin_footer-appearance_page_custom-background
     * @return void
     */
    public function form()
    {
        $nonce = wp_nonce_field(
            $this->option,
            "_ccnonce-$this->option",
            TRUE, // check referer
            FALSE // do not echo
            );
        $html = $nonce . $this->get_radio_fields();
        $this->print_script( $html );
    }

    /**
     * Create the jQuery function that inserts our form fields.
     *
     * @param  string $html Radio buttons
     * @return void
     */
    protected function print_script( $html )
    {
        $row = "'<p>$html</p>'";
        ?>
<script>jQuery( function <?php echo $this->option; ?>($) {
    $('#upload-form').append(<?php echo $row; ?>);
// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');		
	});
		
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
});
</script>
<style>
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
</style>
<?php
    }

    /**
     * Helper for form(). Create radio input fields
     *
     * @return string
     */
    protected function get_radio_fields()
    {
        $value  = get_theme_mod( $this->option, 'background_image' );
        $radios = array ( 'noise', 'blue', 'dark', 'space' );
        $html   = '<div class="images-radio-container"><label for="choose-from-library-link">Or choose one of CyberChimps background images:</label><br>';

        foreach ( $radios as $radio )
        {
					$html .= '<div class="images-radio-subcontainer">';
					$html .= sprintf(
							' <input type="radio" class="of-radio-img-radio" name="%1$s" value="%2$s" style="display:none;" id="%3$s"%4$s>',
							$this->option,
							$radio,
							"$this->option-$radio",
							// returns ' as value delimiters and has to be escaped
							addslashes( checked( $value, $radio, FALSE ) )
					);
					$html .= '<img src="'.get_template_directory_uri().'/cyberchimps/lib/images/backgrounds/thumbs/'.$radio.'.png" class="of-radio-img-img" alt="'.$radio.'" title="'.$radio.'" />';
					$html .= '</div>';
        }

        return "$html</div>";
    }
}