<?php

if ( ! function_exists( 'einar_core_filter_portfolio_interactive_showcase_interactive_list_overlay' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_filter_portfolio_interactive_showcase_interactive_list_overlay( $variations ) {
		$variations['overlay'] = esc_html__( 'Overlay', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_interactive_showcase_interactive_list_animation_options', 'einar_core_filter_portfolio_interactive_showcase_interactive_list_overlay' );
}
