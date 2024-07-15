<?php

if ( ! function_exists( 'einar_core_add_social_share_variation_list' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_social_share_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_social_share_layouts', 'einar_core_add_social_share_variation_list' );
	add_filter( 'einar_core_filter_social_share_layout_options', 'einar_core_add_social_share_variation_list' );
}

if ( ! function_exists( 'einar_core_set_default_social_share_variation_list' ) ) {
	/**
	 * Function that set default variation layout for this module
	 *
	 * @return string
	 */
	function einar_core_set_default_social_share_variation_list() {
		return 'list';
	}

	add_filter( 'einar_core_filter_social_share_layout_default_value', 'einar_core_set_default_social_share_variation_list' );
}
