<?php

if ( ! function_exists( 'einar_core_add_button_variation_textual' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_button_variation_textual( $variations ) {
		$variations['textual'] = esc_html__( 'Textual', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_button_layouts', 'einar_core_add_button_variation_textual' );
}
