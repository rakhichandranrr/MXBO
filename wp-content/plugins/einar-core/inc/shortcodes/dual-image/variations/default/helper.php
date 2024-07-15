<?php

if ( ! function_exists( 'einar_core_add_dual_image_variation_default' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_dual_image_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_dual_image_layouts', 'einar_core_add_dual_image_variation_default' );
}
