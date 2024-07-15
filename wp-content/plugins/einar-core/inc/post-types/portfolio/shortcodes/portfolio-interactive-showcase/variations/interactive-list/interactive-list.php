<?php

if ( ! function_exists( 'einar_core_add_portfolio_interactive_showcase_variation_interactive_list' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_interactive_showcase_variation_interactive_list( $variations ) {
		$variations['interactive-list'] = esc_html__( 'Interactive List', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_interactive_showcase_layouts', 'einar_core_add_portfolio_interactive_showcase_variation_interactive_list' );
}
