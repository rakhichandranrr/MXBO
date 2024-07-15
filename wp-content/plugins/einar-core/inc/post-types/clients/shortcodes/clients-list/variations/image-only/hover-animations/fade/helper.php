<?php

if ( ! function_exists( 'einar_core_filter_clients_list_image_only_fade' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_filter_clients_list_image_only_fade( $variations ) {
		$variations['fade'] = esc_html__( 'Fade', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_clients_list_image_only_animation_options', 'einar_core_filter_clients_list_image_only_fade' );
}

if ( ! function_exists( 'einar_core_set_fade_as_clients_list_image_only_default_animation_option' ) ) {
	/**
	 * Function that add default hover option layout for this layout
	 */
	function einar_core_set_fade_as_clients_list_image_only_default_animation_option() {
		return 'fade';
	}

	add_filter( 'einar_core_filter_clients_list_image_only_default_animation_option', 'einar_core_set_fade_as_clients_list_image_only_default_animation_option' );
}
