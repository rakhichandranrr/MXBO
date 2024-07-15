<?php

if ( ! function_exists( 'einar_core_add_portfolio_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function einar_core_add_portfolio_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'  => array( 'portfolio-item' ),
				'type'   => 'meta',
				'slug'   => 'portfolio-item',
				'title'  => esc_html__( 'Portfolio Settings', 'einar-core' ),
				'layout' => 'tabbed',
			)
		);

		if ( $page ) {

			$general_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-general',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'General Settings', 'einar-core' ),
					'description' => esc_html__( 'General portfolio settings', 'einar-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_content_skin',
					'title'       => esc_html__( 'Portfolio Skin', 'einar-core' ),
					'description' => esc_html__( 'Change content and header skin to dark or use default for predefined style.', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'page_skin' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_layout',
					'title'       => esc_html__( 'Single Layout', 'einar-core' ),
					'description' => esc_html__( 'Choose default layout for portfolio single', 'einar-core' ),
					'options'     => apply_filters( 'einar_core_filter_portfolio_single_layout_options', array( '' => esc_html__( 'Default', 'einar-core' ) ) ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_portfolio_gallery_below_slider',
					'title'       => esc_html__( 'Gallery Below Slider', 'einar-core' ),
					'description' => esc_html__( 'While Media items images are for slider, these images are for gallery that will be rendered after slider and content.', 'einar-core' ),
					'multiple'    => 'yes',
					'dependency'  => array(
						'show' => array(
							'qodef_portfolio_single_layout' => array(
								'values'        => array(
									'slider-big',
									'slider-small',
								),
								'default_value' => '',
							),
						),
					),
				)
			);

			$section_columns = $general_tab->add_section_element(
				array(
					'name'       => 'qodef_portfolio_columns_section',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_single_layout' => array(
								'values'        => array(
									'masonry-big',
									'masonry-small',
									'gallery-big',
									'gallery-small',
									'slider-big',
									'slider-small',
								),
								'default_value' => '',
							),
						),
					),
				)
			);

			$section_columns->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_columns_number',
					'title'      => esc_html__( 'Number of Columns', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'columns_number' ),
				)
			);

			$section_columns->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_space_between_items',
					'title'      => esc_html__( 'Items Horizontal Spacing', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$portfolio_space_between_items_row = $section_columns->add_row_element(
				array(
					'name'       => 'qodef_portfolio_space_between_items_row',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_space_between_items' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$portfolio_space_between_items_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_space_between_items_custom',
					'title'       => esc_html__( 'Custom Horizontal Spacing', 'einar-core' ),
					'description' => esc_html__( 'Enter horizontal space between items in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_space_between_items_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_space_between_items_custom_1512',
					'title'       => esc_html__( 'Custom Horizontal Spacing - 1512', 'einar-core' ),
					'description' => esc_html__( 'Enter horizontal space between items in pixels below 1512px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_space_between_items_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_space_between_items_custom_1200',
					'title'       => esc_html__( 'Custom Horizontal Spacing - 1200', 'einar-core' ),
					'description' => esc_html__( 'Enter horizontal space between items in pixels below 1200px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_space_between_items_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_space_between_items_custom_680',
					'title'       => esc_html__( 'Custom Horizontal Spacing - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter horizontal space between items in pixels below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$section_columns->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_vertical_space_between_items',
					'title'      => esc_html__( 'Items Vertical Spacing', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$portfolio_vertical_space_between_items_row = $section_columns->add_row_element(
				array(
					'name'       => 'qodef_portfolio_vertical_space_between_items_row',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_vertical_space_between_items' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$portfolio_vertical_space_between_items_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_vertical_space_between_items_custom',
					'title'       => esc_html__( 'Custom Vertical Spacing', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_vertical_space_between_items_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_vertical_space_between_items_custom_1440',
					'title'       => esc_html__( 'Custom Vertical Spacing - 1440', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1440px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_vertical_space_between_items_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_vertical_space_between_items_custom_1024',
					'title'       => esc_html__( 'Custom Vertical Spacing - 1024', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1024px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_vertical_space_between_items_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_vertical_space_between_items_custom_680',
					'title'       => esc_html__( 'Custom Vertical Spacing - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$section_media = $general_tab->add_section_element(
				array(
					'name'        => 'qodef_portfolio_media_section',
					'title'       => esc_html__( 'Media Settings', 'einar-core' ),
					'description' => esc_html__( 'Media that will be displayed on portfolio page', 'einar-core' ),
					'dependency'  => array(
						'hide' => array(
							'qodef_portfolio_single_layout' => array(
								'values'        => array(
									'custom',
								),
								'default_value' => '',
							),
						),
					),
				)
			);

			$media_repeater = $section_media->add_repeater_element(
				array(
					'name'        => 'qodef_portfolio_media',
					'title'       => esc_html__( 'Media Items', 'einar-core' ),
					'description' => esc_html__( 'Enter media items for this portfolio', 'einar-core' ),
					'button_text' => esc_html__( 'Add Media', 'einar-core' ),
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_media_type',
					'title'         => esc_html__( 'Media Item Type', 'einar-core' ),
					'options'       => array(
						'gallery' => esc_html__( 'Gallery', 'einar-core' ),
						'image'   => esc_html__( 'Image', 'einar-core' ),
						'video'   => esc_html__( 'Video', 'einar-core' ),
						'audio'   => esc_html__( 'Audio', 'einar-core' ),
					),
					'default_value' => 'gallery',
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_portfolio_gallery',
					'title'      => esc_html__( 'Upload Portfolio Images', 'einar-core' ),
					'multiple'   => 'yes',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'gallery',
								'default_value' => 'gallery',
							),
						),
					),
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_portfolio_image',
					'title'      => esc_html__( 'Upload Portfolio Image', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'image',
								'default_value' => 'gallery',
							),
						),
					),
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_video',
					'title'       => esc_html__( 'Video URL', 'einar-core' ),
					'description' => esc_html__( 'Enter your video URL', 'einar-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'video',
								'default_value' => 'gallery',
							),
						),
					),
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_audio',
					'title'       => esc_html__( 'Audio URL', 'einar-core' ),
					'description' => esc_html__( 'Enter your audio URL', 'einar-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'audio',
								'default_value' => 'gallery',
							),
						),
					),
				)
			);

			$section_info = $general_tab->add_section_element(
				array(
					'name'        => 'qodef_portfolio_info_section',
					'title'       => esc_html__( 'Info Settings', 'einar-core' ),
					'description' => esc_html__( 'Info that will be displayed on portfolio page', 'einar-core' ),
				)
			);

            $section_info->add_field_element(
                array(
                    'field_type'  => 'textarea',
                    'name'        => 'qodef_portfolio_description',
                    'title'       => esc_html__( 'Portfolio Description', 'einar-core' ),
                    'description' => esc_html__( 'Enter Portfolio Short Description', 'einar-core' ),
                    'dependency'  => array(
                        'show' => array(
                            'qodef_portfolio_single_layout' => array(
                                'values'        => array(
                                    'custom-image',
                                ),
                                'default_value' => '',
                            ),
                        ),
                    ),
                )
            );

			$info_items_repeater = $section_info->add_repeater_element(
				array(
					'name'        => 'qodef_portfolio_info_items',
					'title'       => esc_html__( 'Info Items', 'einar-core' ),
					'description' => esc_html__( 'Enter additional info for portoflio item', 'einar-core' ),
					'button_text' => esc_html__( 'Add Item', 'einar-core' ),
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_label',
					'title'      => esc_html__( 'Item Label', 'einar-core' ),
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_value',
					'title'      => esc_html__( 'Item Text', 'einar-core' ),
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_link',
					'title'      => esc_html__( 'Item Link', 'einar-core' ),
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_info_item_target',
					'title'      => esc_html__( 'Item Target', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'link_target' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_portfolio_meta_box_map', $page, $general_tab );
		}
	}

	add_action( 'einar_core_action_default_meta_boxes_init', 'einar_core_add_portfolio_single_meta_box' );
}

if ( ! function_exists( 'einar_core_include_general_meta_boxes_for_portfolio_single' ) ) {
	/**
	 * Function that add general meta box options for this module
	 */
	function einar_core_include_general_meta_boxes_for_portfolio_single() {
		$callbacks = einar_core_general_meta_box_callbacks();

		if ( ! empty( $callbacks ) ) {
			foreach ( $callbacks as $module => $callback ) {

				if ( 'page-sidebar' !== $module ) {
					add_action( 'einar_core_action_after_portfolio_meta_box_map', $callback );
				}
			}
		}
	}

	add_action( 'einar_core_action_default_meta_boxes_init', 'einar_core_include_general_meta_boxes_for_portfolio_single', 8 ); // Permission 8 is set in order to load it before default meta box function
}
