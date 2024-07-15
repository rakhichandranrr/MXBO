<?php

if ( ! function_exists( 'einar_core_add_rotate_circles_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function einar_core_add_rotate_circles_spinner_layout_option( $layouts ) {
		$layouts['rotate-circles'] = esc_html__( 'Rotate Circles', 'einar-core' );

		return $layouts;
	}

	add_filter( 'einar_core_filter_page_spinner_layout_options', 'einar_core_add_rotate_circles_spinner_layout_option' );
}
