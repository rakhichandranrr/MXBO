<?php

if ( ! function_exists( 'einar_core_add_yith_wishlist_plugin_add_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function einar_core_add_yith_wishlist_plugin_add_body_classes( $classes ) {
		if ( qode_framework_is_installed( 'yith-wishlist' ) ) {
			$option = einar_core_get_post_value_through_levels( 'qodef_enable_woo_yith_wishlist_predefined_style' );

			if ( 'yes' === $option ) {
				$classes[] = 'qodef-yith-wcwl--predefined';
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'einar_core_add_yith_wishlist_plugin_add_body_classes' );
}
