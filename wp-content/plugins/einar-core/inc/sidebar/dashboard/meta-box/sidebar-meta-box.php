<?php

if ( ! function_exists( 'einar_core_add_page_sidebar_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function einar_core_add_page_sidebar_meta_box( $page ) {

		if ( $page ) {

			$sidebar_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-sidebar',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Sidebar Settings', 'einar-core' ),
					'description' => esc_html__( 'Sidebar layout settings', 'einar-core' ),
				)
			);

			$sidebar_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_sidebar_layout',
					'title'       => esc_html__( 'Sidebar Layout', 'einar-core' ),
					'description' => esc_html__( 'Choose a sidebar layout', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'sidebar_layouts' ),
				)
			);

            $sidebar_tab->add_field_element(
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
				$sidebar_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_page_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'einar-core' ),
						'description' => esc_html__( 'Choose a custom sidebar', 'einar-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$sidebar_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$page_sidebar_grid_gutter_row = $sidebar_tab->add_row_element(
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

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_page_sidebar_meta_box_map', $sidebar_tab );
		}
	}

	add_action( 'einar_core_action_after_general_meta_box_map', 'einar_core_add_page_sidebar_meta_box' );
}

if ( ! function_exists( 'einar_core_add_general_page_sidebar_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function einar_core_add_general_page_sidebar_meta_box_callback( $callbacks ) {
		$callbacks['page-sidebar'] = 'einar_core_add_page_sidebar_meta_box';

		return $callbacks;
	}

	add_filter( 'einar_core_filter_general_meta_box_callbacks', 'einar_core_add_general_page_sidebar_meta_box_callback' );
}
