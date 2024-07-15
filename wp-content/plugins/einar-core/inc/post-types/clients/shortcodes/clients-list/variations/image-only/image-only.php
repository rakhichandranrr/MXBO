<?php

if ( ! function_exists( 'einar_core_add_clients_list_variation_image_only' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_clients_list_variation_image_only( $variations ) {
		$variations['image-only'] = esc_html__( 'Image Only', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_clients_list_layouts', 'einar_core_add_clients_list_variation_image_only' );
}
