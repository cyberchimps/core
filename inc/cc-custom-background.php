<?php

add_action(
    'load-appearance_page_custom-background',
    array ( 'CC_Custom_Background', 'get_instance' )
);

class CC_Custom_Background
{
    protected static $instance = NULL;

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
    public static function get_instance()
    {
        NULL === self::$instance and self::$instance = new self;
        return self::$instance;
    }

    /**
     * Save our option and register the form.
     */
    public function __construct()
    {
        add_action(
            'admin_footer-appearance_page_custom-background',
            array ( $this, 'form' )
        );
				
				add_action( 'admin_head', array( $this, 'cc_background_styles' ) );

        if ( empty ( $_POST[ $this->option ] ) )
        {
            return;
        }

        check_admin_referer( $this->option, "_ccnonce-$this->option" );
        set_theme_mod( $this->option, $_POST[ $this->option ] );
    }

    /**
     * Create the form elements.
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
        $row = "'<tr><th>$this->table_header</th><td>$html</td></tr>'";
        ?>
<script>jQuery( function <?php echo $this->option; ?>($) {
    $('.form-table:last').append(<?php echo $row; ?>);
		
		$('.of-radio-img-img').click(function(){
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
    protected function get_radio_fields()
    {
        $value  = ( get_background_image() ) ? 'none' : get_theme_mod( $this->option, 'none' );
        $radios = array ( 'none', 'noise', 'blue', 'dark', 'space', 'debut_light' );
        $html   = '<div class="images-radio-container"><label for="choose-from-library-link">'.__( 'Or choose one of CyberChimps background images', 'cyberchimps' ).'</label><br>';

        foreach ( $radios as $radio )
        {
						$html .= '<div class="images-radio-subcontainer">';
            $html .= sprintf(
                ' <input type="radio" class="of-radio-img-radio" name="%1$s" style="display:none;" value="%2$s" id="%3$s"%4$s>',
                $this->option,
                $radio,
                "$this->option-$radio",
                // returns ' as value delimiters and has to be escaped
                addslashes( checked( $value, $radio, FALSE ) )
            );
						$selected = ( $value == $radio ) ? ' of-radio-img-selected' : '';
						$html .= '<img src="'.get_template_directory_uri().'/cyberchimps/lib/images/backgrounds/thumbs/'.$radio.'.png" class="of-radio-img-img'.$selected.'" alt="'.$radio.'" title="'.$radio.'" />';
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