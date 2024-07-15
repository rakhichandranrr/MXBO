<?php

if ( ! function_exists( 'einar_core_add_service_list_variation_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_service_list_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'einar-core' );
		
		return $variations;
	}
	
	add_filter( 'einar_core_filter_service_list_layouts', 'einar_core_add_service_list_variation_standard' );
}
