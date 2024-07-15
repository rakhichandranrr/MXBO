<?php

if ( ! function_exists( 'einar_core_is_fixed_backdrop_image_enabled' ) ) {
	function einar_core_is_fixed_backdrop_image_enabled() {

		return einar_core_get_post_value_through_levels( 'qodef_fixed_backdrop_image_enabled' ) !== 'no';
	}
}

if ( ! function_exists( 'einar_core_add_add_fixed_backdrop_image_to_body_classes' ) ) {
	function einar_core_add_add_fixed_backdrop_image_to_body_classes( $classes ) {

		$classes[] = einar_core_is_fixed_backdrop_image_enabled() ? 'qodef-fixed-backdrop-image--enabled' : '';
		return $classes;
	}
	
	add_filter( 'body_class', 'einar_core_add_add_fixed_backdrop_image_to_body_classes' );
}

if ( ! function_exists( 'einar_core_load_fixed_backdrop_image' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function einar_core_load_fixed_backdrop_image() {
		
		if ( einar_core_is_fixed_backdrop_image_enabled() ) {
			$parameters = array();

            einar_core_template_part( 'fixed-backdrop-image', 'templates/fixed-backdrop-image', '', $parameters );
		}
	}
	
	add_action( 'einar_action_before_wrapper_close_tag', 'einar_core_load_fixed_backdrop_image' );
}