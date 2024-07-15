<?php

if ( ! function_exists( 'einar_core_add_banner_variation_link_overlay' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_banner_variation_link_overlay( $variations ) {
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_banner_layouts', 'einar_core_add_banner_variation_link_overlay' );
}
