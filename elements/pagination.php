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

// FIXME: Fix documentation
function cyberchimps_load_pagination() {
	// load default pagination
	add_action('cyberchimps_after_content', 'cyberchimps_default_pagination');
}
add_action('init', 'cyberchimps_load_pagination');

// FIXME: Fix documentation
function cyberchimps_default_pagination() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
		'base' => @add_query_arg('paged','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => true,
		'prev_text' => 'Prev',
		'next_text' => 'Next',
		'type' => 'array'
	);

	if ( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if ( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

	$pagination = paginate_links( $pagination );
	
	if ( is_array($pagination) ) {
		
		echo '<div class="pagination">';
		echo '<ul>';
		foreach( $pagination as $pag ) {
			if ( strpos( $pag, 'dots' ) != false ) {
				continue;
			} else if ( strpos( $pag, 'current' ) != false ) {
				$num = preg_replace("/[^0-9]/", '', $pag);
				echo '<li class="active"><a>'.$num.'</a></li>';
			} else {
				echo '<li>'.$pag.'</li>';
			}
		}
		echo '</ul>';
		echo '</div>';
	}
}