<?php

if ( ! function_exists( 'einar_core_add_page_footer_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function einar_core_add_page_footer_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => EINAR_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'footer',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Footer', 'einar-core' ),
				'description' => esc_html__( 'Global Footer Options', 'einar-core' ),
			)
		);

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_footer',
					'title'         => esc_html__( 'Enable Page Footer', 'einar-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page footer', 'einar-core' ),
					'default_value' => 'yes',
				)
			);

			$page_footer_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_footer_section',
					'title'      => esc_html__( 'Footer Area', 'einar-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_footer' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			// General Footer Area Options

			$page_footer_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_footer_skin',
					'title'       => esc_html__( 'Footer Skin', 'einar-core' ),
					'description' => esc_html__( 'Choose a predefined footer style for footer elements', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'header_skin', false ),
				)
			);

			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_uncovering_footer',
					'title'         => esc_html__( 'Enable Uncovering Footer', 'einar-core' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'einar-core' ),
					'default_value' => 'no',
				)
			);

			// Logo Footer Area Section
			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_logo_footer_area',
					'title'         => esc_html__( 'Enable Logo Footer Area', 'einar-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable logo footer area', 'einar-core' ),
					'default_value' => 'no',
				)
			);

			$logo_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_logo_footer_area_section',
					'title'      => esc_html__( 'Logo Footer Area', 'einar-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_logo_footer_area' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

            $logo_footer_area_section->add_field_element(
                array(
                    'field_type' => 'text',
                    'name'       => 'qodef_footer_logo_height',
                    'title'      => esc_html__( 'Footer Logo Height', 'einar-core' ),
                    'args'       => array(
                        'suffix'    => esc_html__( 'px', 'einar-core' ),
                    ),
                )
            );

            $logo_footer_area_section->add_field_element(
                array(
                    'field_type' => 'text',
                    'name'       => 'qodef_footer_mobile_logo_height',
                    'title'      => esc_html__( 'Footer Mobile Logo Height', 'einar-core' ),
                    'args'       => array(
                        'suffix'    => esc_html__( 'px', 'einar-core' ),
                    ),
                )
            );

			$logo_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_logo_down',
					'title'         => esc_html__( 'Footer Logo Image Slightly Down', 'einar-core' ),
					'default_value' => 'yes',
				)
			);

			$logo_footer_area_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_footer_logo_main',
					'title'       => esc_html__( 'Logo - Main', 'einar-core' ),
					'description' => esc_html__( 'Choose main logo image', 'einar-core' ),
					'multiple'    => 'no',
				)
			);

			$logo_footer_area_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_footer_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'einar-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'einar-core' ),
					'multiple'    => 'no',
				)
			);

			$logo_footer_area_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_footer_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'einar-core' ),
					'description' => esc_html__( 'Choose light logo image', 'einar-core' ),
					'multiple'    => 'no',
				)
			);

			// Top Footer Area Section

			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_top_footer_area',
					'title'         => esc_html__( 'Enable Top Footer Area', 'einar-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable top footer area', 'einar-core' ),
					'default_value' => 'yes',
				)
			);

			$top_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_top_footer_area_section',
					'title'      => esc_html__( 'Top Footer Area', 'einar-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_top_footer_area' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_top_area_in_grid',
					'title'         => esc_html__( 'Top Footer Area In Grid', 'einar-core' ),
					'description'   => esc_html__( 'Enabling this option will set page top footer area to be in grid', 'einar-core' ),
					'default_value' => 'no',
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_top_area_columns',
					'title'         => esc_html__( 'Top Footer Area Columns', 'einar-core' ),
					'description'   => esc_html__( 'Choose number of columns for top footer area', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'columns_number', true, array( '4', '5', '6' ) ),
					'default_value' => '3',
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_top_area_grid_gutter',
					'title'         => esc_html__( 'Top Footer Area Grid Gutter', 'einar-core' ),
					'description'   => esc_html__( 'Choose grid gutter size to set space between columns for top footer area', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'items_space' ),
					'default_value' => 'medium',
				)
			);

			$footer_top_area_grid_gutter_row = $top_footer_area_section->add_row_element(
				array(
					'name'       => 'qodef_set_footer_top_area_grid_gutter_row',
					'dependency' => array(
						'show' => array(
							'qodef_set_footer_top_area_grid_gutter' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$footer_top_area_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_set_footer_top_area_grid_gutter_custom',
					'title'       => esc_html__( 'Custom Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$footer_top_area_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_set_footer_top_area_grid_gutter_custom_1512',
					'title'       => esc_html__( 'Custom Grid Gutter - 1512', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1512px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$footer_top_area_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_set_footer_top_area_grid_gutter_custom_1200',
					'title'       => esc_html__( 'Custom Grid Gutter - 1200', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1200px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$footer_top_area_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_set_footer_top_area_grid_gutter_custom_680',
					'title'       => esc_html__( 'Custom Grid Gutter - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_content_alignment',
					'title'       => esc_html__( 'Content Alignment', 'einar-core' ),
					'description' => esc_html__( 'Set widgets content alignment inside top footer area', 'einar-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'einar-core' ),
						'left'   => esc_html__( 'Left', 'einar-core' ),
						'center' => esc_html__( 'Center', 'einar-core' ),
						'right'  => esc_html__( 'Right', 'einar-core' ),
					),
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_columns_distribution',
					'title'       => esc_html__( 'Columns Distribution', 'einar-core' ),
					'description' => esc_html__( 'Set widgets content alignment inside top footer area', 'einar-core' ),
					'options'     => array(
						''         => esc_html__( 'Default', 'einar-core' ),
						'25-25-50' => esc_html__( '25% 25% 50%', 'einar-core' ),
					),
					'dependency'  => array(
						'show' => array(
							'qodef_set_footer_top_area_columns' => array(
								'values'        => '3',
								'default_value' => '3',
							),
						),
					),
				)
			);

			$top_footer_area_styles_section = $top_footer_area_section->add_section_element(
				array(
					'name'  => 'qodef_top_footer_area_styles_section',
					'title' => esc_html__( 'Top Footer Area Styles', 'einar-core' ),
				)
			);

			$top_footer_area_styles_row = $top_footer_area_styles_section->add_row_element(
				array(
					'name'  => 'qodef_top_footer_area_styles_row',
					'title' => '',
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_padding_top',
					'title'      => esc_html__( 'Padding Top', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_padding_bottom',
					'title'      => esc_html__( 'Padding Bottom', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_side_padding',
					'title'      => esc_html__( 'Side Padding', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_top_footer_area_background_image',
					'title'      => esc_html__( 'Background Image', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'einar-core' ),
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_top_footer_area_top_border_style',
					'title'      => esc_html__( 'Top Border Style', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'border_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row_2 = $top_footer_area_styles_section->add_row_element(
				array(
					'name'  => 'qodef_top_footer_area_styles_row_2',
					'title' => '',
				)
			);

			$top_footer_area_styles_row_2->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_top_footer_area_widgets_margin_bottom',
					'title'       => esc_html__( 'Widgets Margin Bottom', 'einar-core' ),
					'description' => esc_html__( 'Set space value between widgets', 'einar-core' ),
					'args'        => array(
						'col_width' => 4,
					),
				)
			);

			$top_footer_area_styles_row_2->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_top_footer_area_widgets_title_margin_bottom',
					'title'       => esc_html__( 'Widgets Title Margin Bottom', 'einar-core' ),
					'description' => esc_html__( 'Set space value between widget title and widget content', 'einar-core' ),
					'args'        => array(
						'col_width' => 4,
					),
				)
			);

			// Bottom Footer Area Section

			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_bottom_footer_area',
					'title'         => esc_html__( 'Enable Bottom Footer Area', 'einar-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable bottom footer area', 'einar-core' ),
					'default_value' => 'yes',
				)
			);

			$bottom_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_bottom_footer_area_section',
					'title'      => esc_html__( 'Bottom Footer Area', 'einar-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_bottom_footer_area' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_bottom_area_in_grid',
					'title'         => esc_html__( 'Bottom Footer Area In Grid', 'einar-core' ),
					'description'   => esc_html__( 'Enabling this option will set page bottom footer area to be in grid', 'einar-core' ),
					'default_value' => 'yes',
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_bottom_area_columns',
					'title'         => esc_html__( 'Bottom Footer Area Columns', 'einar-core' ),
					'description'   => esc_html__( 'Choose number of columns for bottom footer area', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'columns_number', true, array( '3', '4', '5', '6' ) ),
					'default_value' => '2',
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_grid_gutter',
					'title'       => esc_html__( 'Bottom Footer Area Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for bottom footer area', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$footer_bottom_area_grid_gutter_row = $bottom_footer_area_section->add_row_element(
				array(
					'name'       => 'qodef_set_footer_bottom_area_grid_gutter_row',
					'dependency' => array(
						'show' => array(
							'qodef_set_footer_bottom_area_grid_gutter' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$footer_bottom_area_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_set_footer_bottom_area_grid_gutter_custom',
					'title'       => esc_html__( 'Custom Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$footer_bottom_area_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_set_footer_bottom_area_grid_gutter_custom_1512',
					'title'       => esc_html__( 'Custom Grid Gutter - 1512', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1512px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$footer_bottom_area_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_set_footer_bottom_area_grid_gutter_custom_1200',
					'title'       => esc_html__( 'Custom Grid Gutter - 1200', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1200px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$footer_bottom_area_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_set_footer_bottom_area_grid_gutter_custom_680',
					'title'       => esc_html__( 'Custom Grid Gutter - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_content_alignment',
					'title'       => esc_html__( 'Content Alignment', 'einar-core' ),
					'description' => esc_html__( 'Set widgets content alignment inside bottom footer area', 'einar-core' ),
					'options'     => array(
						''              => esc_html__( 'Default', 'einar-core' ),
						'left'          => esc_html__( 'Left', 'einar-core' ),
						'center'        => esc_html__( 'Center', 'einar-core' ),
						'right'         => esc_html__( 'Right', 'einar-core' ),
						'space-between' => esc_html__( 'Space Between', 'einar-core' ),
					),
				)
			);

			$bottom_footer_area_styles_section = $bottom_footer_area_section->add_section_element(
				array(
					'name'  => 'qodef_bottom_footer_area_styles_section',
					'title' => esc_html__( 'Bottom Footer Area Styles', 'einar-core' ),
				)
			);

			$bottom_footer_area_styles_row = $bottom_footer_area_styles_section->add_row_element(
				array(
					'name'  => 'qodef_bottom_footer_area_styles_row',
					'title' => '',
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_padding_top',
					'title'      => esc_html__( 'Padding Top', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_padding_bottom',
					'title'      => esc_html__( 'Padding Bottom', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_side_padding',
					'title'      => esc_html__( 'Side Padding', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'einar-core' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'einar-core' ),
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_bottom_footer_area_top_border_style',
					'title'      => esc_html__( 'Top Border Style', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'border_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_page_footer_options_map', $page );
		}
	}

	add_action( 'einar_core_action_default_options_init', 'einar_core_add_page_footer_options', einar_core_get_admin_options_map_position( 'footer' ) );
}
