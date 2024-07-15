<?php

if ( ! function_exists( 'einar_core_add_two_rotating_circles_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function einar_core_add_two_rotating_circles_spinner_layout_option( $layouts ) {
		$layouts['two-rotating-circles'] = esc_html__( '2 Rotating Circles', 'einar-core' );

		return $layouts;
	}

	add_filter( 'einar_core_filter_page_spinner_layout_options', 'einar_core_add_two_rotating_circles_spinner_layout_option' );
}