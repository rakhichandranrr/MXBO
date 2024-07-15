<?php

if ( ! function_exists( 'einar_core_filter_portfolio_interactive_showcase_interactive_list_animation_options' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function einar_core_filter_portfolio_interactive_showcase_interactive_list_animation_options( $options ) {
		$hover_option  = array();
		$option_filter = apply_filters( 'einar_core_filter_portfolio_interactive_showcase_interactive_list_animation_options', array() );
		$options_map   = einar_core_get_variations_options_map( $option_filter );

		$option = array(
			'field_type'    => 'select',
			'name'          => 'hover_animation_interactive-list',
			'title'         => esc_html__( 'Hover Animation', 'einar-core' ),
			'options'       => $option_filter,
			'default_value' => $options_map['default_value'],
			'dependency'    => array(
				'show' => array(
					'layout' => array(
						'values'        => 'interactive-list',
						'default_value' => '',
					),
				),
			),
			'group'         => esc_html__( 'Layout', 'einar-core' ),
			'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] ),
		);

		$hover_option[] = $option;

		return array_merge( $options, $hover_option );
	}

	add_filter( 'einar_core_filter_portfolio_interactive_showcase_hover_animation_options', 'einar_core_filter_portfolio_interactive_showcase_interactive_list_animation_options' );
}
