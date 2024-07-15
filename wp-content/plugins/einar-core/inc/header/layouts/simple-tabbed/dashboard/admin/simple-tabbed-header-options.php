<?php

if ( ! function_exists( 'einar_core_add_simple_tabbed_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array  $general_header_tab
	 */
	function einar_core_add_simple_tabbed_header_options( $page, $general_header_tab ) {

		$section = $general_header_tab->add_section_element(
			array(
				'name'       => 'qodef_simple_tabbed_header_section',
				'title'      => esc_html__( 'Simple Tabbed Header', 'einar-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'simple-tabbed',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_simple_tabbed_header_height',
				'title'       => esc_html__( 'Header Height', 'einar-core' ),
				'description' => esc_html__( 'Enter header height', 'einar-core' ),
				'args'        => array(
					'suffix' => 'px',
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_simple_tabbed_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'einar-core' ),
				'description' => esc_html__( 'Enter header background color', 'einar-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_simple_tabbed_header_enable_fullscreen_menu',
				'title'         => esc_html__( 'Enable Fullscreen Menu', 'einar-core' ),
				'description'   => esc_html__( 'Enables fullscreen menu, beside standard menu (menu has to be assigned to Fullscreen Navigation location from WordPress Menus option).', 'einar-core' ),
				'default_value' => 'no',
			)
		);
	}

	add_action( 'einar_core_action_after_header_options_map', 'einar_core_add_simple_tabbed_header_options', 10, 2 );
}
