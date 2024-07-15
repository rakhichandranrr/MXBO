<?php

if ( ! function_exists( 'einar_core_filter_clients_list_image_only_animation_options' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function einar_core_filter_clients_list_image_only_animation_options( $options ) {
		$hover_option         = array();
		$option_filter        = apply_filters( 'einar_core_filter_clients_list_image_only_animation_options', array() );
		$default_hover_option = apply_filters( 'einar_core_filter_clients_list_image_only_default_animation_option', array() );

		$options_map = einar_core_get_variations_options_map( $option_filter );

		$option = array(
			'field_type'    => 'select',
			'name'          => 'hover_animation_image-only',
			'title'         => esc_html__( 'Hover Animation', 'einar-core' ),
			'options'       => $option_filter,
			'default_value' => $default_hover_option,
			'dependency'    => array(
				'show' => array(
					'layout' => array(
						'values'        => 'image-only',
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

	add_filter( 'einar_core_filter_clients_list_hover_animation_options', 'einar_core_filter_clients_list_image_only_animation_options' );
}
