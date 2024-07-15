<?php

if ( ! function_exists( 'einar_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function einar_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'einar-core' );

		return $options;
	}

	add_filter( 'einar_core_filter_header_scroll_appearance_option', 'einar_core_add_fixed_header_option' );
}
