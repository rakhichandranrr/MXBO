<?php

if ( ! function_exists( 'einar_core_add_predefined_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function einar_core_add_predefined_spinner_layout_option( $layouts ) {
		$layouts['predefined'] = esc_html__( 'Predefined', 'einar-core' );

		return $layouts;
	}

	add_filter( 'einar_core_filter_page_spinner_layout_options', 'einar_core_add_predefined_spinner_layout_option' );
}

if ( ! function_exists( 'einar_core_add_predefined_spinner_layout_classes' ) ) {
	/**
	 * Function that return classes for page spinner area
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function einar_core_add_predefined_spinner_layout_classes( $classes ) {
		$type = einar_core_get_post_value_through_levels( 'qodef_page_spinner_type' );

		if ( 'predefined' === $type ) {
			$classes[] = 'qodef--custom-spinner';
		}

		return $classes;
	}

	add_filter( 'einar_core_filter_page_spinner_classes', 'einar_core_add_predefined_spinner_layout_classes' );
}

if ( ! function_exists( 'einar_core_set_predefined_spinner_layout_as_default_option' ) ) {
	/**
	 * Function that set default value for page spinner layout options map
	 *
	 * @param string $default_value
	 *
	 * @return string
	 */
	function einar_core_set_predefined_spinner_layout_as_default_option( $default_value ) {
		return 'predefined';
	}

	add_filter( 'einar_core_filter_page_spinner_default_layout_option', 'einar_core_set_predefined_spinner_layout_as_default_option' );
}

if ( ! function_exists( 'einar_core_spinner_get_split_chars' ) ) {
	/**
	 * Function that return modified text value with html tags
	 *
	 * @param string $text
	 *
	 * @return string that contains html content
	 */
	function einar_core_spinner_get_split_chars( $text ) {
		if ( ! empty( $text ) ) {
			$split_text_chars        = mb_str_split( $text );

			foreach ( $split_text_chars as $char_position => $value ) {
				$split_text_chars[ $char_position ] = '<span class="qode--char"><span class="qode--char-inner">' . $split_text_chars[ $char_position ] . '</span></span>';
			}

			$text = implode( '', $split_text_chars );
		}

		return $text;
	}
}

if ( ! function_exists( 'einar_core_spinner_get_split_chunks' ) ) {
	/**
	 * Function that return modified text value with html tags
	 *
	 * @param string $text
	 *
	 * @return string that contains html content
	 */
	function einar_core_spinner_get_split_chunks( $text ) {
		if ( ! empty( $text ) ) {
			$text_chars = mb_str_split( $text );
			$text_length = count( $text_chars );

			$text_top        = mb_str_split( $text, ceil( $text_length / 2 ) )[0];
			$text_top_length = mb_strlen( $text_top );
			$text_top_left   = mb_substr( $text_top, 0, ceil( $text_top_length / 2 ) );
			$text_top_right  = mb_substr( $text_top, ceil( $text_top_length / 2 ) );

			$text_bottom        = mb_str_split( $text, ceil( $text_length / 2 ) )[1];
			$text_bottom_length = mb_strlen( $text_bottom );
			$text_bottom_left   = mb_substr( $text_bottom, 0, floor( $text_bottom_length / 2 ) );
			$text_bottom_right  = mb_substr( $text_bottom, floor( $text_bottom_length / 2 ) );

			$text = [$text_top_left, $text_top_right, $text_bottom_left, $text_bottom_right ];
		}

		return $text;
	}
}
