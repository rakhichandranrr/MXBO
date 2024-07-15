<?php

if ( ! function_exists( 'einar_core_filter_portfolio_list_info_below_glass_effect' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_filter_portfolio_list_info_below_glass_effect( $variations ) {
		$variations['glass-effect'] = esc_html__( 'Glass Effect', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_list_info_below_animation_options', 'einar_core_filter_portfolio_list_info_below_glass_effect' );
}
