<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Events actions used by the CyberChimps Response Core Framework
*
* Authors: Benjamin Mueller, Tyler Cunningham
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Response
* @since 1.0.4
*/

/**
* Response Twitterbar actions
*/
add_action( 'response_events_element', 'response_events_element_content' );

/*
 * Retrieves the Twitterbar options
 */
function response_events_element_content() {
	global $options, $themeslug, $post; //call globals

/**
*  If 'Default Events Template' is selected in Settings -> The Events Calendar -> Theme Settings -> Events Template, 
*  then this file loads the page template for all ECP views except for the individual 
*  event view.  Generally, this setting should only be used if you want to manually 
*  specify all the shell HTML of your ECP pages in this template file.  Use one of the other Theme 
*  Settings -> Events Template to automatically integrate views into your 
*  theme.
*
* You can customize this view by putting a replacement file of the same name (ecp-page-template.php) in the events/ directory of your theme.
*/

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

?>	

<div class="container-fluid">
<div id="tribe-events-content" class="grid">
      <!-- This title is here for ajax loading - do not remove if you wish to use ajax switching between month views -->
      <title><?php wp_title() ?></title>
		<div id='tribe-events-calendar-header' class="clearfix">
			<span class='tribe-events-month-nav'>
				<span class='tribe-events-prev-month'>
					<a href='<?php echo tribe_get_previous_month_link(); ?>'>
					&#x2190; <?php echo tribe_get_previous_month_text(); ?>
					</a>
				</span>

				<?php tribe_month_year_dropdowns( "tribe-events-" ); ?>
	
				<span class='tribe-events-next-month'>
					<a href='<?php echo tribe_get_next_month_link(); ?>'>				
					<?php echo tribe_get_next_month_text(); ?> &#x2192; 
					</a>
               <img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-loading" id="ajax-loading" alt="" style='display: none'/>
				</span>
			</span>

			<span class='tribe-events-calendar-buttons'> 
				<a class='tribe-events-button-off' href='<?php echo tribe_get_listview_link(); ?>'><?php _e('Event List', 'tribe-events-calendar')?></a>
				<a class='tribe-events-button-on' href='<?php echo tribe_get_gridview_link(); ?>'><?php _e('Calendar', 'tribe-events-calendar')?></a>
			</span>
		</div><!-- tribe-events-calendar-header -->
		<?php tribe_calendar_grid(); // See the views/table.php template for customization ?>
      <?php if( function_exists( 'tribe_get_ical_link' ) ): ?>
         <a title="<?php esc_attr_e('iCal Import', 'tribe-events-calendar') ?>" class="ical" href="<?php echo tribe_get_ical_link(); ?>"><?php _e('iCal Import', 'tribe-events-calendar') ?></a>
      <?php endif; ?>
		<?php if (tribe_get_option('donate-link', false) == true) { ?>
			<p class="tribe-promo-banner"><?php echo apply_filters('tribe_promo_banner', sprintf( __('Calendar powered by %sThe Events Calendar%s', 'tribe-events-calendar'), '<a href="http://tri.be/wordpress-events-calendar/">', '</a>' ) ); ?></p>
		<?php } ?>
	</div></div>
<?php
}
?>