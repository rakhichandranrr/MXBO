<?php

if ( ! function_exists( 'einar_core_filter_clients_list_image_only_fade_in' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_filter_clients_list_image_only_fade_in( $variations ) {
		$variations['fade-in'] = esc_html__( 'Fade In', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_clients_list_image_only_animation_options', 'einar_core_filter_clients_list_image_only_fade_in' );
}
