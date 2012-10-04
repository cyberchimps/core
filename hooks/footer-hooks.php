<?php
/**
 * FIXME: Edit Title Content
 *
 * FIXME: Edit Description Content
 *
 * Please do not edit this file. This file is part of the Cyber Chimps Framework and all modifications
 * should be made in a child theme.
 * FIXME: POINT USERS TO DOWNLOAD OUR STARTER CHILD THEME AND DOCUMENTATION
 *
 * @category Cyber Chimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

/**
* Adds the CyberChimps credit.
*
* @since 1.0
*/
function cyberchimps_footer_credit() { 
	?>
	<div class="span6">
		<div id="credit">
			<?php if (cyberchimps_get_option('footer_cyberchimps_link') == '1') {  ?>
			<a href="http://cyberchimps.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/cyberchimps/lib/images/achimps.png" alt="CyberChimps" /></a>
			<?php } ?>
		</div>
	</div>
	<?php
}
add_action ( 'cyberchimps_footer', 'cyberchimps_footer_credit' );

/**
* Adds the afterfooter copyright area. 
*
* @since 1.0
*/
function cyberchimps_footer_copyright() {
	echo '<div class="span6">';
	$copyright = ( cyberchimps_get_option('footer_copyright_text') ) ? cyberchimps_get_option('footer_copyright_text') : '';
	echo '<div id="copyright">' . $copyright . '</div>';
	echo '</div>';
}
add_action ( 'cyberchimps_footer', 'cyberchimps_footer_copyright' );