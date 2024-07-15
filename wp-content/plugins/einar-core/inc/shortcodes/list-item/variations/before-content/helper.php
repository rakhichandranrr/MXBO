<?php

if ( ! function_exists( 'einar_core_add_list_item_variation_before_content' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_list_item_variation_before_content( $variations ) {
		$variations['before-content'] = esc_html__( 'Before Content', 'einar-core' );
		
		return $variations;
	}
	
	add_filter( 'einar_core_filter_list_item_layouts', 'einar_core_add_list_item_variation_before_content' );
}
