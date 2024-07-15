<?php

if ( ! function_exists( 'einar_core_add_general_page_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function einar_core_add_general_page_meta_box( $page ) {

		$general_tab = $page->add_tab_element(
			array(
				'name'        => 'tab-page',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Page Settings', 'einar-core' ),
				'description' => esc_html__( 'General page layout settings', 'einar-core' ),
			)
		);

        $general_tab->add_field_element(
            array(
                'field_type'  => 'text',
                'name'        => 'qodef_page_custom_css_class',
                'title'       => esc_html__( 'Page Custom CSS Class', 'einar-core' ),
                'description' => esc_html__( 'Set custom CSS Class to body tag', 'einar-core' ),
            )
        );

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_main_color',
				'title'       => esc_html__( 'Main Color', 'einar-core' ),
				'description' => esc_html__( 'Choose the most dominant theme color', 'einar-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_main_opposite_color',
				'title'       => esc_html__( 'Main Opposite Color', 'einar-core' ),
				'description' => esc_html__( 'Choose the opposite color from the main color', 'einar-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_second_color',
				'title'       => esc_html__( 'Second Color', 'einar-core' ),
				'description' => esc_html__( 'Choose the secondary theme color', 'einar-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_page_background_color',
				'title'       => esc_html__( 'Page Background Color', 'einar-core' ),
				'description' => esc_html__( 'Set background color', 'einar-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_page_background_image',
				'title'       => esc_html__( 'Page Background Image', 'einar-core' ),
				'description' => esc_html__( 'Set background image', 'einar-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_repeat',
				'title'       => esc_html__( 'Page Background Image Repeat', 'einar-core' ),
				'description' => esc_html__( 'Set background image repeat', 'einar-core' ),
				'options'     => array(
					''          => esc_html__( 'Default', 'einar-core' ),
					'no-repeat' => esc_html__( 'No Repeat', 'einar-core' ),
					'repeat'    => esc_html__( 'Repeat', 'einar-core' ),
					'repeat-x'  => esc_html__( 'Repeat-x', 'einar-core' ),
					'repeat-y'  => esc_html__( 'Repeat-y', 'einar-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_size',
				'title'       => esc_html__( 'Page Background Image Size', 'einar-core' ),
				'description' => esc_html__( 'Set background image size', 'einar-core' ),
				'options'     => array(
					''        => esc_html__( 'Default', 'einar-core' ),
					'contain' => esc_html__( 'Contain', 'einar-core' ),
					'cover'   => esc_html__( 'Cover', 'einar-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_attachment',
				'title'       => esc_html__( 'Page Background Image Attachment', 'einar-core' ),
				'description' => esc_html__( 'Set background image attachment', 'einar-core' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'einar-core' ),
					'fixed'  => esc_html__( 'Fixed', 'einar-core' ),
					'scroll' => esc_html__( 'Scroll', 'einar-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding',
				'title'       => esc_html__( 'Page Content Padding', 'einar-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'einar-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding_mobile',
				'title'       => esc_html__( 'Page Content Padding Mobile', 'einar-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'einar-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_boxed',
				'title'         => esc_html__( 'Boxed Layout', 'einar-core' ),
				'description'   => esc_html__( 'Set boxed layout', 'einar-core' ),
				'default_value' => '',
				'options'       => einar_core_get_select_type_options_pool( 'yes_no' ),
			)
		);

		$boxed_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_boxed_section',
				'title'      => esc_html__( 'Boxed Layout Section', 'einar-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_boxed' => array(
							'values'        => 'no',
							'default_value' => '',
						),
					),
				),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_boxed_background_color',
				'title'       => esc_html__( 'Boxed Background Color', 'einar-core' ),
				'description' => esc_html__( 'Set boxed background color', 'einar-core' ),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_boxed_background_pattern',
				'title'       => esc_html__( 'Boxed Background Pattern', 'einar-core' ),
				'description' => esc_html__( 'Set boxed background pattern', 'einar-core' ),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_boxed_background_pattern_behavior',
				'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'einar-core' ),
				'description' => esc_html__( 'Set boxed background pattern behavior', 'einar-core' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'einar-core' ),
					'fixed'  => esc_html__( 'Fixed', 'einar-core' ),
					'scroll' => esc_html__( 'Scroll', 'einar-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_passepartout',
				'title'         => esc_html__( 'Passepartout', 'einar-core' ),
				'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'einar-core' ),
				'default_value' => '',
				'options'       => einar_core_get_select_type_options_pool( 'yes_no' ),
			)
		);

		$passepartout_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_passepartout_section',
				'dependency' => array(
					'hide' => array(
						'qodef_passepartout' => array(
							'values'        => 'no',
							'default_value' => '',
						),
					),
				),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_passepartout_color',
				'title'       => esc_html__( 'Passepartout Color', 'einar-core' ),
				'description' => esc_html__( 'Choose background color for passepartout', 'einar-core' ),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_passepartout_image',
				'title'       => esc_html__( 'Passepartout Background Image', 'einar-core' ),
				'description' => esc_html__( 'Set background image for passepartout', 'einar-core' ),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size',
				'title'       => esc_html__( 'Passepartout Size', 'einar-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout', 'einar-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'einar-core' ),
				),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size_responsive',
				'title'       => esc_html__( 'Passepartout Responsive Size', 'einar-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'einar-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'einar-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_width',
				'title'       => esc_html__( 'Initial Width of Content', 'einar-core' ),
				'description' => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'einar-core' ),
				'options'     => einar_core_get_select_type_options_pool( 'content_width' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_content_behind_header',
				'title'         => esc_html__( 'Always put content behind header', 'einar-core' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'einar-core' ),
			)
		);

		// Hook to include additional options after module options
		do_action( 'einar_core_action_after_general_page_meta_box_map', $general_tab );
	}

	add_action( 'einar_core_action_after_general_meta_box_map', 'einar_core_add_general_page_meta_box', 9 );
}

if ( ! function_exists( 'einar_core_add_general_page_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function einar_core_add_general_page_meta_box_callback( $callbacks ) {
		$callbacks['page'] = 'einar_core_add_general_page_meta_box';

		return $callbacks;
	}

	add_filter( 'einar_core_filter_general_meta_box_callbacks', 'einar_core_add_general_page_meta_box_callback' );
}
