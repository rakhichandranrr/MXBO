<?php

if ( ! function_exists( 'einar_core_add_portfolio_single_variation_custom_image' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_single_variation_custom_image( $variations ) {
		$variations['custom-image'] = esc_html__( 'Custom Image', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_single_layout_options', 'einar_core_add_portfolio_single_variation_custom_image' );
}