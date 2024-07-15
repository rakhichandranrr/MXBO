<?php

if ( ! function_exists( 'einar_core_add_minimal_mobile_header_meta' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 */
	function einar_core_add_minimal_mobile_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_mobile_header_section',
				'title'      => esc_html__( 'Minimal Mobile Header', 'einar-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values'        => 'minimal',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_height',
				'title'       => esc_html__( 'Minimal Height', 'einar-core' ),
				'description' => esc_html__( 'Enter header height', 'einar-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'einar-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'einar-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'einar-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'einar-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'einar-core' ),
				'description' => esc_html__( 'Enter header background color', 'einar-core' ),
			)
		);

        $section->add_field_element(
            array(
                'field_type'  => 'color',
                'name'        => 'qodef_minimal_mobile_header_border_color',
                'title'       => esc_html__( 'Header Border Color', 'einar-core' ),
                'description' => esc_html__( 'Enter header border color', 'einar-core' ),
            )
        );
	}

	add_action( 'einar_core_action_after_page_mobile_header_meta_map', 'einar_core_add_minimal_mobile_header_meta', 10, 2 );
}
