<?php

if ( ! function_exists( 'einar_core_add_team_list_variation_info_right' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_team_list_variation_info_right( $variations ) {
		$variations['info-right'] = esc_html__( 'Info Right', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_team_list_layouts', 'einar_core_add_team_list_variation_info_right' );
}
