<?php

if ( ! function_exists( 'einar_core_add_button_only_arrow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_button_only_arrow( $variations ) {
		$variations['only-arrow'] = esc_html__( 'Only Arrow', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_button_layouts', 'einar_core_add_button_only_arrow' );
}
