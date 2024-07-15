<?php

if ( ! function_exists( 'einar_core_add_icon_with_text_variation_before_title' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_icon_with_text_variation_before_title( $variations ) {
		$variations['before-title'] = esc_html__( 'Before Title', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_icon_with_text_layouts', 'einar_core_add_icon_with_text_variation_before_title' );
}
