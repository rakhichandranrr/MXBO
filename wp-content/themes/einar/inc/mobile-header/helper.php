<?php

if ( ! function_exists( 'einar_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function einar_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'einar_filter_mobile_header_template', einar_get_template_part( 'mobile-header', 'templates/mobile-header' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	add_action( 'einar_action_page_header_template', 'einar_load_page_mobile_header' );
}

if ( ! function_exists( 'einar_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function einar_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'einar_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'einar' ) ) );

		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}

	add_action( 'einar_action_after_include_modules', 'einar_register_mobile_navigation_menus' );
}
