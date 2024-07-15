<?php

if ( ! function_exists( 'einar_core_add_image_with_text_variation_text_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_image_with_text_variation_text_below( $variations ) {
		$variations['text-below'] = esc_html__( 'Text Below', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_image_with_text_layouts', 'einar_core_add_image_with_text_variation_text_below' );
}
