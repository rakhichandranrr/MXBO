<?php

if ( ! function_exists( 'einar_core_add_simple_tabbed_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */

	function einar_core_add_simple_tabbed_header_global_option( $header_layout_options ) {
		$header_layout_options['simple-tabbed'] = array(
			'image' => EINAR_CORE_HEADER_LAYOUTS_URL_PATH . '/simple-tabbed/assets/img/simple-tabbed-header.png',
			'label' => esc_html__( 'Simple Tabbed', 'einar-core' ),
		);

		return $header_layout_options;
	}

	add_filter( 'einar_core_filter_header_layout_option', 'einar_core_add_simple_tabbed_header_global_option' );
}

if ( ! function_exists( 'einar_core_register_simple_tabbed_header_layout' ) ) {
	/**
	 * Function which add header layout into global list
	 *
	 * @param array $header_layouts
	 *
	 * @return array
	 */
	function einar_core_register_simple_tabbed_header_layout( $header_layouts ) {
		$header_layouts['simple-tabbed'] = 'EinarCore_Simple_Tabbed_Header';

		return $header_layouts;
	}

	add_filter( 'einar_core_filter_register_header_layouts', 'einar_core_register_simple_tabbed_header_layout' );
}

if ( ! function_exists( 'einar_core_get_navigation_menus' ) ) {

	function einar_core_get_navigation_menus() {

		$nav_menus_object = wp_get_nav_menus();
		$options['']      = esc_html__( 'Default', 'einar-core' );

		foreach ( $nav_menus_object as $key => $value ) {
			$options[ $value->slug ] = $value->name;
		}

		return $options;
	}
}