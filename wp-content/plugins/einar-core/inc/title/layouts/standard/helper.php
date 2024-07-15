<?php

if ( ! function_exists( 'einar_core_register_standard_title_layout' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $layouts
	 *
	 * @return array
	 */
	function einar_core_register_standard_title_layout( $layouts ) {
		$layouts['standard'] = 'EinarCore_Standard_Title';

		return $layouts;
	}

	add_filter( 'einar_core_filter_register_title_layouts', 'einar_core_register_standard_title_layout' );
}

if ( ! function_exists( 'einar_core_add_standard_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function einar_core_add_standard_title_layout_option( $layouts ) {
		$layouts['standard'] = esc_html__( 'Standard', 'einar-core' );

		return $layouts;
	}

	add_filter( 'einar_core_filter_title_layout_options', 'einar_core_add_standard_title_layout_option' );
}

if ( ! function_exists( 'einar_core_get_standard_title_layout_subtitle_text' ) ) {
	/**
	 * Function that render current page subtitle text
	 */
	function einar_core_get_standard_title_layout_subtitle_text() {
		$subtitle_meta = einar_core_get_post_value_through_levels( 'qodef_page_title_subtitle' );
		$subtitle      = array( 'subtitle' => ! empty( $subtitle_meta ) ? $subtitle_meta : '' );

		return apply_filters( 'einar_core_filter_standard_title_layout_subtitle_text', $subtitle );
	}
}
