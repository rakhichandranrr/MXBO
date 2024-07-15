<?php

if ( ! function_exists( 'einar_core_add_banner_variation_link_button' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_banner_variation_link_button( $variations ) {
		$variations['link-button'] = esc_html__( 'Link Button', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_banner_layouts', 'einar_core_add_banner_variation_link_button' );
}
