<?php

if ( ! function_exists( 'einar_core_add_sticky_header_meta_options' ) ) {
	/**
	 * Function that add additional meta box options for current module
	 *
	 * @param object $section
	 * @param array  $custom_sidebars
	 */
	function einar_core_add_sticky_header_meta_options( $section, $custom_sidebars ) {

		if ( $section ) {

			$sticky_section = $section->add_section_element(
				array(
					'name'       => 'qodef_sticky_header_section',
					'dependency' => array(
						'show' => array(
							'qodef_header_scroll_appearance' => array(
								'values'        => 'sticky',
								'default_value' => '',
							),
						),
					),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_sticky_header_appearance',
					'title'       => esc_html__( 'Sticky Header Appearance', 'einar-core' ),
					'description' => esc_html__( 'Select the appearance of sticky header when you scrolling the page', 'einar-core' ),
					'options'     => array(
						''     => esc_html__( 'Default', 'einar-core' ),
						'down' => esc_html__( 'Show Sticky on Scroll Down/Up', 'einar-core' ),
						'up'   => esc_html__( 'Show Sticky on Scroll Up', 'einar-core' ),
					),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_sticky_header_skin',
					'title'       => esc_html__( 'Sticky Header Skin', 'einar-core' ),
					'description' => esc_html__( 'Choose a predefined sticky header style for header elements', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'header_skin' ),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_sticky_header_scroll_amount',
					'title'       => esc_html__( 'Sticky Scroll Amount', 'einar-core' ),
					'description' => esc_html__( 'Enter scroll amount for sticky header to appear', 'einar-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'einar-core' ),
					),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_sticky_header_side_padding',
					'title'       => esc_html__( 'Sticky Header Side Padding', 'einar-core' ),
					'description' => esc_html__( 'Enter side padding for sticky header area', 'einar-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'einar-core' ),
					),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_sticky_header_background_color',
					'title'       => esc_html__( 'Sticky Header Background Color', 'einar-core' ),
					'description' => esc_html__( 'Enter sticky header background color', 'einar-core' ),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_sticky_header_custom_widget_area_one',
					'title'       => esc_html__( 'Choose Custom Sticky Header Widget Area One', 'einar-core' ),
					'description' => esc_html__( 'Choose custom widget area to display in sticky header widget area one', 'einar-core' ),
					'options'     => $custom_sidebars,
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_sticky_header_custom_widget_area_two',
					'title'       => esc_html__( 'Choose Custom Sticky Header Widget Area Two', 'einar-core' ),
					'description' => esc_html__( 'Choose custom widget area to display in sticky header widget area two', 'einar-core' ),
					'options'     => $custom_sidebars,
				)
			);
		}
	}

	add_action( 'einar_core_action_after_header_scroll_appearance_meta_options_map', 'einar_core_add_sticky_header_meta_options', 10, 2 );
}

if ( ! function_exists( 'einar_core_add_sticky_header_logo_meta_options' ) ) {
	/**
	 * Function that add additional header logo meta box options
	 *
	 * @param object $logo_tab
	 * @param array  $header_page
	 * @param array  $logo_image_section
	 */
	function einar_core_add_sticky_header_logo_meta_options( $logo_tab, $header_page, $logo_image_section ) {

		if ( $header_page ) {
			$logo_image_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_sticky',
					'title'       => esc_html__( 'Logo - Sticky', 'einar-core' ),
					'description' => esc_html__( 'Choose sticky logo image', 'einar-core' ),
					'multiple'    => 'no',
				)
			);
		}
	}

	add_action( 'einar_core_action_after_header_logo_image_section_meta_map', 'einar_core_add_sticky_header_logo_meta_options', 10, 3 );
}

if ( ! function_exists( 'einar_core_add_sticky_header_logo_svg_meta_options' ) ) {
	/**
	 * Function that add additional header logo options
	 *
	 * @param object $page
	 * @param array  $header_tab
	 * @param array  $logo_svg_path_section
	 */
	function einar_core_add_sticky_header_logo_svg_meta_options( $page, $header_tab, $logo_svg_path_section ) {

		if ( $header_tab ) {
			$logo_svg_path_section->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_logo_sticky_svg_path',
					'title'       => esc_html__( 'Logo Sticky - SVG Path', 'einar-core' ),
					'description' => esc_html__( 'Enter your logo icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'einar-core' ),
				)
			);
		}
	}

	add_action( 'einar_core_action_before_header_logo_svg_path_section_meta_map', 'einar_core_add_sticky_header_logo_svg_meta_options', 10, 3 );
}
