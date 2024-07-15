<?php

if ( ! function_exists( 'einar_core_add_page_sidebar_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function einar_core_add_page_sidebar_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => EINAR_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'sidebar',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Sidebar', 'einar-core' ),
				'description' => esc_html__( 'Global Sidebar Options', 'einar-core' ),
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'einar-core' ),
					'description'   => esc_html__( 'Choose a default sidebar layout for pages', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'sidebar_layouts', false ),
					'default_value' => 'no-sidebar',
				)
			);

            $page->add_field_element(
                array(
                    'field_type'  => 'select',
                    'name'        => 'qodef_sidebar_border',
                    'title'       => esc_html__( 'Sidebar Border', 'einar-core' ),
                    'description' => esc_html__( 'Choose sidebar border', 'einar-core' ),
                    'options'     => array(
                        ''       => esc_html__( 'Default', 'einar-core' ),
                        'left'   => esc_html__( 'Left', 'einar-core' ),
                        'right'  => esc_html__( 'Right', 'einar-core' ),
                    ),
                )
            );

			$custom_sidebars = einar_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$page->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_page_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'einar-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on pages', 'einar-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$page_sidebar_grid_gutter_row = $page->add_row_element(
				array(
					'name'       => 'qodef_page_sidebar_grid_gutter_row',
					'dependency' => array(
						'show' => array(
							'qodef_page_sidebar_grid_gutter' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_sidebar_grid_gutter_custom',
					'title'       => esc_html__( 'Custom Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$page_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_sidebar_grid_gutter_custom_1512',
					'title'       => esc_html__( 'Custom Grid Gutter - 1512', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1512px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$page_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_sidebar_grid_gutter_custom_1200',
					'title'       => esc_html__( 'Custom Grid Gutter - 1200', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1200px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$page_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_sidebar_grid_gutter_custom_680',
					'title'       => esc_html__( 'Custom Grid Gutter - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_sidebar_widgets_margin_bottom',
					'title'       => esc_html__( 'Widgets Margin Bottom', 'einar-core' ),
					'description' => esc_html__( 'Set space value between widgets', 'einar-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_page_sidebar_options_map', $page );
		}
	}

	add_action( 'einar_core_action_default_options_init', 'einar_core_add_page_sidebar_options', einar_core_get_admin_options_map_position( 'sidebar' ) );
}
