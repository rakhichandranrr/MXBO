<?php

if ( ! function_exists( 'einar_core_set_custom_cursor_icon' ) ) {
	/**
	 * Function that add drag cursor icon into global js object
	 *
	 * @param $array
	 *
	 * @return mixed
	 */
	function einar_core_set_custom_cursor_icon( $array ) {
		$array['dragCursor'] = einar_core_get_svg_icon( 'drag-cursor' );
		$array['dotCursor']  = einar_core_get_svg_icon( 'dot-cursor' );

		return $array;
	}

	add_filter( 'einar_filter_localize_main_js', 'einar_core_set_custom_cursor_icon' );
}
