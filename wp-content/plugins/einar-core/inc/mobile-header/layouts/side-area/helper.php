<?php

if ( ! function_exists( 'einar_core_add_side_area_mobile_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function einar_core_add_side_area_mobile_header_global_option( $header_layout_options ) {
		$header_layout_options['side-area'] = array(
			'image' => EINAR_CORE_MOBILE_HEADER_LAYOUTS_URL_PATH . '/side-area/assets/img/side-area-header.png',
			'label' => esc_html__( 'Side Area', 'einar-core' ),
		);

		return $header_layout_options;
	}

	add_filter( 'einar_core_filter_mobile_header_layout_option', 'einar_core_add_side_area_mobile_header_global_option' );
}

if ( ! function_exists( 'einar_core_register_side_area_mobile_header_layout' ) ) {
	/**
	 * This function add header layout into global options list
	 *
	 * @param array $mobile_header_layouts
	 *
	 * @return array
	 */
	function einar_core_register_side_area_mobile_header_layout( $mobile_header_layouts ) {
		$mobile_header_layouts['side-area'] = 'EinarCore_Side_Area_Mobile_Header';

		return $mobile_header_layouts;
	}

	add_filter( 'einar_core_filter_register_mobile_header_layouts', 'einar_core_register_side_area_mobile_header_layout' );
}
