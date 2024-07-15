<?php

if ( ! function_exists( 'einar_core_add_page_footer_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function einar_core_add_page_footer_meta_box( $page ) {

		if ( $page ) {
			$custom_sidebars = einar_core_get_custom_sidebars( true, true );
			$footer_columns  = apply_filters( 'einar_core_filter_footer_areas_columns_size', array() );

			$footer_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-footer',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Footer Settings', 'einar-core' ),
					'description' => esc_html__( 'Footer layout settings', 'einar-core' ),
				)
			);

			$footer_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_page_footer',
					'title'       => esc_html__( 'Enable Page Footer', 'einar-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page footer', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			$page_footer_section = $footer_tab->add_section_element(
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
					'options'     => einar_core_get_select_type_options_pool( 'header_skin' ),
				)
			);

			$page_footer_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_uncovering_footer',
					'title'       => esc_html__( 'Enable Uncovering Footer', 'einar-core' ),
					'description' => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			// Logo Footer Area Section

			$page_footer_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_logo_footer_area',
					'title'       => esc_html__( 'Enable Logo Footer Area', 'einar-core' ),
					'description' => esc_html__( 'Use this option to enable/disable logo footer area', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'no_yes' ),
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
					'field_type' => 'select',
					'name'       => 'qodef_set_footer_logo_down',
					'title'      => esc_html__( 'Footer Logo Image Slightly Down', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'no_yes' ),
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
					'field_type'  => 'select',
					'name'        => 'qodef_enable_top_footer_area',
					'title'       => esc_html__( 'Enable Top Footer Area', 'einar-core' ),
					'description' => esc_html__( 'Use this option to enable/disable top footer area', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'no_yes' ),
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
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_in_grid',
					'title'       => esc_html__( 'Top Footer Area in Grid', 'einar-core' ),
					'description' => esc_html__( 'Enabling this option will set page top footer area to be in grid', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			if ( isset( $footer_columns['footer_top_sidebars_number'] ) && ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				for ( $i = 1; $i <= intval( $footer_columns['footer_top_sidebars_number'] ); $i ++ ) {
					$top_footer_area_section->add_field_element(
						array(
							'field_type'  => 'select',
							'name'        => 'qodef_footer_top_area_custom_widget_' . $i,
							'title'       => sprintf( esc_html__( 'Custom Footer Top Area - Column %s', 'einar-core' ), $i ),
							'description' => sprintf( esc_html__( 'Widgets added here will appear in the %s column of top footer area', 'einar-core' ), $i ),
							'options'     => $custom_sidebars,
						)
					);
				}
			}

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
					'field_type'  => 'select',
					'name'        => 'qodef_enable_bottom_footer_area',
					'title'       => esc_html__( 'Enable Bottom Footer Area', 'einar-core' ),
					'description' => esc_html__( 'Use this option to enable/disable bottom footer area', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'no_yes' ),
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
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_in_grid',
					'title'       => esc_html__( 'Bottom Footer Area in Grid', 'einar-core' ),
					'description' => esc_html__( 'Enabling this option will set page bottom footer area to be in grid', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			if ( isset( $footer_columns['footer_bottom_sidebars_number'] ) && ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				for ( $i = 1; $i <= intval( $footer_columns['footer_bottom_sidebars_number'] ); $i ++ ) {
					$bottom_footer_area_section->add_field_element(
						array(
							'field_type'  => 'select',
							'name'        => 'qodef_footer_bottom_area_custom_widget_' . $i,
							'title'       => sprintf( esc_html__( 'Custom Footer Bottom Area - Column %s', 'einar-core' ), $i ),
							'description' => sprintf( esc_html__( 'Widgets added here will appear in the %s column of bottom footer area', 'einar-core' ), $i ),
							'options'     => $custom_sidebars,
						)
					);
				}
			}

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
			do_action( 'einar_core_action_after_page_footer_meta_box_map', $footer_tab );
		}
	}

	add_action( 'einar_core_action_after_general_meta_box_map', 'einar_core_add_page_footer_meta_box' );
}

if ( ! function_exists( 'einar_core_add_general_footer_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function einar_core_add_general_footer_meta_box_callback( $callbacks ) {
		$callbacks['footer'] = 'einar_core_add_page_footer_meta_box';

		return $callbacks;
	}

	add_filter( 'einar_core_filter_general_meta_box_callbacks', 'einar_core_add_general_footer_meta_box_callback' );
}
