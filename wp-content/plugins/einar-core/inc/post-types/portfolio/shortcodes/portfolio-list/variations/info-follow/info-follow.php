<?php

if ( ! function_exists( 'einar_core_add_portfolio_list_variation_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_list_variation_info_follow( $variations ) {
		$variations['info-follow'] = esc_html__( 'Info Follow', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_list_layouts', 'einar_core_add_portfolio_list_variation_info_follow' );
}
