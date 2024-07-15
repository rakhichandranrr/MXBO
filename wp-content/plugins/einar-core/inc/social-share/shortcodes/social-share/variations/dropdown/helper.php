<?php

if ( ! function_exists( 'einar_core_add_social_share_variation_dropdown' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_social_share_variation_dropdown( $variations ) {
		$variations['dropdown'] = esc_html__( 'Dropdown', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_social_share_layouts', 'einar_core_add_social_share_variation_dropdown' );
	add_filter( 'einar_core_filter_social_share_layout_options', 'einar_core_add_social_share_variation_dropdown' );
}
