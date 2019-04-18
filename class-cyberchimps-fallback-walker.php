<?php
/**
 * Fallback Walker
 *
 * @package  Framework
 */

/**
 * [Cyberchimps_Fallback_Walker description]
 */
class Cyberchimps_Fallback_Walker extends Walker_Page {

	/**
	 * [start_lvl description]
	 *
	 * @param  [type]  $output [description].
	 * @param  integer $depth  [description].
	 * @param  array   $args   [description].
	 * @return void          [description].
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 0 === $depth ) {
			$indent  = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
		} else {
			$indent  = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul>\n";
		}
	}

	/**
	 * [start_el description]
	 *
	 * @param  [type]  $output [description].
	 * @param  [type]  $page   [description].
	 * @param  integer $depth  [description].
	 * @param  array   $args   [description].
	 * @param  integer $current_page   [description].
	 * @return void          [description].
	 */
	public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		if ( $depth ) {
			$indent = str_repeat( "\t", $depth );
		} else {
			$indent = '';
		}

		extract( $args, EXTR_SKIP );
		$class_attr      = '';
		$data            = '';
		$link_class_attr = '';
		$caret           = '';
		if ( 0 === $depth && ! empty( $args['has_children'] ) ) {
			$class_attr     .= 'dropdown ';
			$data            = 'data-dropdown="dropdown"';
			$link_class_attr = 'dropdown-toggle';
			$caret           = '<b class="caret"></b>';
		}
		if ( ! empty( $current_page ) ) {
			$_current_page = get_page( $current_page );
			if ( ( isset( $_current_page->ancestors ) && in_array( $page->ID, (array) $_current_page->ancestors, true ) ) || ( $page->ID === $current_page ) || ( $_current_page && $page->ID === $_current_page->post_parent ) ) {
				$class_attr .= 'current-menu-item current_page_item active';
			}
		} elseif ( ( is_single() || is_archive() ) && ( get_option( 'page_for_posts' ) === $page->ID ) ) {
			$class_attr = '';
		}
		if ( '' !== $class_attr ) {
			$class_attr = ' class="' . $class_attr . '"';
		}
		$output .= $indent . '<li' . $class_attr . $data . '><a href="' . get_page_link( $page->ID ) . '"' . $link_class_attr . '>' . apply_filters( 'the_title', $page->post_title, $page->ID ) . $caret . '</a>';
	}
}
