<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Box section actions used by the CyberChimps Response Core Framework Pro Extension
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Pro
* @since 1.0
*/

/**
* Response Box Section actions
*/
add_action( 'response_box_element', 'response_box_element_content' );

/**
* Sets up the Box Section wigetized area
*
* @since 1.0
*/
function response_box_element_content() { 
	global $post;
?>

	<div class="row-fluid">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Box Left") ) : ?>
			<div id="box1" class="span4">
				<div style="padding:15px;">
				<h2 class="box-widget-title">Box Left</h2>
				<p>This is the box left widgetized area.</p>
				</div>
			</div><!--end box1-->
			<?php endif; ?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Box Middle") ) : ?>
			<div id="box2" class="span4">
				<div style="padding:15px;">
				<h2 class="box-widget-title">Box Middle</h2>
				<p>This is the box middle widgetized area.</p>
				</div>
			</div><!--end box2-->
			<?php endif; ?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Box Right") ) : ?>
			<div id="box3" class="span4">
				<div style="padding:15px;">
				<h2 class="box-widget-title">Box Right</h2>
				<p>This is the box right widgetized area.</p>
				</div>
			</div><!--end box3-->
		<?php endif; ?>	</div>

<?php
}
?>