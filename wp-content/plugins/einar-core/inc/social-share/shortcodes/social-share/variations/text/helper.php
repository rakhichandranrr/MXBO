<?php

if ( ! function_exists( 'einar_core_add_social_share_variation_text' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_social_share_variation_text( $variations ) {
		$variations['text'] = esc_html__( 'Text', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_social_share_layouts', 'einar_core_add_social_share_variation_text' );
	add_filter( 'einar_core_filter_social_share_layout_options', 'einar_core_add_social_share_variation_text' );
}
