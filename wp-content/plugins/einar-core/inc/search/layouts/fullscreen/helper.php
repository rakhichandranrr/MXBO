<?php

if ( ! function_exists( 'einar_core_register_fullscreen_search_layout' ) ) {
	/**
	 * Function that add variation layout into global list
	 *
	 * @param array $search_layouts
	 *
	 * @return array
	 */
	function einar_core_register_fullscreen_search_layout( $search_layouts ) {
		$search_layouts['fullscreen'] = 'EinarCore_Fullscreen_Search';

		return $search_layouts;
	}

	add_filter( 'einar_core_filter_register_search_layouts', 'einar_core_register_fullscreen_search_layout' );
}
