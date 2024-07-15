<?php

if ( ! function_exists( 'einar_core_add_simple_tabbed_header_meta' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function einar_core_add_simple_tabbed_header_meta( $page ) {

		$section = $page->add_section_element(
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
				'field_type'  => 'select',
				'name'        => 'qodef_simple_tabbed_header_menu',
				'title'       => esc_html__( 'Header Menu', 'einar-core' ),
				'description' => esc_html__( 'Choose specific menu for the page.', 'einar-core' ),
				'options'     => einar_core_get_navigation_menus(),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_simple_tabbed_header_enable_fullscreen_menu',
				'title'         => esc_html__( 'Enable Fullscreen Menu', 'einar-core' ),
				'description'   => esc_html__( 'Enables fullscreen menu, beside standard menu (menu has to be assigned to Fullscreen Navigation location from WordPress Menus option).', 'einar-core' ),
				'default_value' => '',
				'options'       => einar_core_get_select_type_options_pool( 'no_yes' ),
			)
		);
	}

	add_action( 'einar_core_action_after_page_header_meta_map', 'einar_core_add_simple_tabbed_header_meta' );
}
