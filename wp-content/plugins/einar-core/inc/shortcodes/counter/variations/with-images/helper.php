<?php

if ( ! function_exists( 'einar_core_add_counter_variation_with_images' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_counter_variation_with_images( $variations ) {
		$variations['with-images'] = esc_html__( 'With Images', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_counter_layouts', 'einar_core_add_counter_variation_with_images' );
}

if ( ! function_exists( 'einar_core_add_with_images_layout_image_option' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function einar_core_add_with_images_layout_image_option( $options, $default_layout ) {
		$counter_options = array();

		$image_option = array(
			'field_type' => 'image',
			'name'       => 'counter_image',
			'title'      => esc_html__( 'Counter Image', 'einar-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'with-images',
						'default_value' => $default_layout,
					),
				),
			),
		);

		$counter_options[] = $image_option;

		return array_merge( $options, $counter_options );
	}

	add_filter( 'einar_core_filter_counter_extra_options', 'einar_core_add_with_images_layout_image_option', 10, 2 );
}
