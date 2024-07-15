<?php

if ( ! function_exists( 'einar_core_add_blog_list_variation_minimal' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_blog_list_variation_minimal( $variations ) {
		$variations['minimal'] = esc_html__( 'Minimal', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_blog_list_layouts', 'einar_core_add_blog_list_variation_minimal' );
	add_filter( 'einar_core_filter_simple_blog_list_widget_layouts', 'einar_core_add_blog_list_variation_minimal' );
}
