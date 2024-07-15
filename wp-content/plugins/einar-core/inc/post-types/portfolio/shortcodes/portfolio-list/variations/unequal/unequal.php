<?php

if ( ! function_exists( 'einar_core_add_portfolio_list_variation_unequal' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_list_variation_unequal( $variations ) {
		$variations['unequal'] = esc_html__( 'Unequal', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_list_layouts', 'einar_core_add_portfolio_list_variation_unequal' );
}

if ( ! function_exists( 'einar_core_add_portfolio_list_options_unequal' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_list_options_unequal( $options ) {
		$standard_options   = array();
		$margin_option      = array(
			'field_type' => 'text',
			'name'       => 'unequal_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'einar-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'unequal',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Layout', 'einar-core' ),
		);
		$standard_options[] = $margin_option;

		return array_merge( $options, $standard_options );
	}

	add_filter( 'einar_core_filter_portfolio_list_extra_options', 'einar_core_add_portfolio_list_options_unequal' );
}
