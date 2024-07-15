<?php

if ( ! function_exists( 'einar_core_add_counter_variation_simple' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_counter_variation_simple( $variations ) {
		$variations['simple'] = esc_html__( 'Simple', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_counter_layouts', 'einar_core_add_counter_variation_simple' );
}
