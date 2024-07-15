<?php

if ( ! function_exists( 'einar_core_add_testimonials_list_variation_info_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_testimonials_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_testimonials_list_layouts', 'einar_core_add_testimonials_list_variation_info_below' );
}

if ( ! function_exists( 'einar_core_add_testimonials_list_options_info_below' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function einar_core_add_testimonials_list_options_info_below( $options ) {
		$info_below_options   = array();
		$margin_option        = array(
			'field_type' => 'text',
			'name'       => 'info_below_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'einar-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-below',
						'default_value' => 'default',
					),
				),
			),
			'group'      => esc_html__( 'Layout', 'einar-core' ),
		);
		$info_below_options[] = $margin_option;

		return array_merge( $options, $info_below_options );
	}

	add_filter( 'einar_core_filter_testimonials_list_extra_options', 'einar_core_add_testimonials_list_options_info_below' );
}
