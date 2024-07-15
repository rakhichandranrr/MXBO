<?php

if ( ! function_exists( 'einar_core_add_interactive_link_showcase_variation_slider' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_interactive_link_showcase_variation_slider( $variations ) {
		$variations['slider'] = esc_html__( 'Slider', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_interactive_link_showcase_layouts', 'einar_core_add_interactive_link_showcase_variation_slider' );
}
