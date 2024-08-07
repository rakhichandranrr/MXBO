<?php

if ( ! function_exists( 'einar_core_filter_portfolio_list_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_filter_portfolio_list_info_follow( $variations ) {
		$variations['follow'] = esc_html__( 'Follow', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_list_info_follow_animation_options', 'einar_core_filter_portfolio_list_info_follow' );
}
