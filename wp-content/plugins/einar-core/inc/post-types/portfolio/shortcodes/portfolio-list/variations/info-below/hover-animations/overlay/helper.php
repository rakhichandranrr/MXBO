<?php

if ( ! function_exists( 'einar_core_filter_portfolio_list_info_below_overlay' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_filter_portfolio_list_info_below_overlay( $variations ) {
		$variations['overlay'] = esc_html__( 'Overlay', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_list_info_below_animation_options', 'einar_core_filter_portfolio_list_info_below_overlay' );
}
