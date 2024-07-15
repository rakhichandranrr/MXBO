<?php

if ( ! function_exists( 'einar_core_filter_portfolio_list_info_on_hover_fade_in' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_filter_portfolio_list_info_on_hover_fade_in( $variations ) {
		$variations['fade-in'] = esc_html__( 'Fade In', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_list_info_on_hover_animation_options', 'einar_core_filter_portfolio_list_info_on_hover_fade_in' );
}
