<?php

if ( ! function_exists( 'einar_core_add_portfolio_single_sidebar_meta_boxes' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function einar_core_add_portfolio_single_sidebar_meta_boxes( $page ) {

		if ( $page ) {

			$sidebar_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-sidebar',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Sidebar Settings', 'einar-core' ),
					'description' => esc_html__( 'Portfolio sidebar settings', 'einar-core' ),
				)
			);

			$sidebar_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'einar-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for portfolio singles', 'einar-core' ),
					'default_value' => '',
					'options'       => einar_core_get_select_type_options_pool( 'sidebar_layouts' ),
				)
			);

			$custom_sidebars = einar_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$sidebar_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_portfolio_single_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'einar-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on portfolio singles', 'einar-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$sidebar_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$portfolio_single_sidebar_grid_gutter_row = $sidebar_tab->add_row_element(
				array(
					'name'       => 'qodef_portfolio_single_sidebar_grid_gutter_row',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_single_sidebar_grid_gutter' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$portfolio_single_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_single_sidebar_grid_gutter_custom',
					'title'       => esc_html__( 'Custom Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_single_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_single_sidebar_grid_gutter_custom_1440',
					'title'       => esc_html__( 'Custom Grid Gutter - 1440', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1440px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_single_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_single_sidebar_grid_gutter_custom_1024',
					'title'       => esc_html__( 'Custom Grid Gutter - 1024', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1024px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_single_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_single_sidebar_grid_gutter_custom_680',
					'title'       => esc_html__( 'Custom Grid Gutter - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);
		}
	}

	add_action( 'einar_core_action_after_portfolio_meta_box_map', 'einar_core_add_portfolio_single_sidebar_meta_boxes', 12 );
}
