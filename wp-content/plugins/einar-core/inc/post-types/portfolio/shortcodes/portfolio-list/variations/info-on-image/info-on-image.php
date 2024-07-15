<?php

if ( ! function_exists( 'einar_core_add_portfolio_list_variation_info_on_image' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_list_variation_info_on_image( $variations ) {
		$variations['info-on-image'] = esc_html__( 'Info On Image', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_list_layouts', 'einar_core_add_portfolio_list_variation_info_on_image' );
}
