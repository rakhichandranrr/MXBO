<?php

if ( ! function_exists( 'einar_core_add_portfolio_single_variation_slider_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_single_variation_slider_big( $variations ) {
		$variations['slider-big'] = esc_html__( 'Slider - Big', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_single_layout_options', 'einar_core_add_portfolio_single_variation_slider_big' );
}
