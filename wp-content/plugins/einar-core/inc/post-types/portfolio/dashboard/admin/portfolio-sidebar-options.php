<?php

if ( ! function_exists( 'einar_core_add_portfolio_archive_sidebar_options' ) ) {
	/**
	 * Function that add sidebar options for portfolio archive module
	 */
	function einar_core_add_portfolio_archive_sidebar_options( $tab ) {

		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_archive_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'einar-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for portfolio archives', 'einar-core' ),
					'default_value' => 'no-sidebar',
					'options'       => einar_core_get_select_type_options_pool( 'sidebar_layouts', false ),
				)
			);

			$custom_sidebars = einar_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_portfolio_archive_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'einar-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on portfolio archives', 'einar-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_archive_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$portfolio_archive_sidebar_grid_gutter_row = $tab->add_row_element(
				array(
					'name'       => 'qodef_portfolio_archive_sidebar_grid_gutter_row',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_archive_sidebar_grid_gutter' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$portfolio_archive_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_archive_sidebar_grid_gutter_custom',
					'title'       => esc_html__( 'Custom Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_archive_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_archive_sidebar_grid_gutter_custom_1440',
					'title'       => esc_html__( 'Custom Grid Gutter - 1440', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1440px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_archive_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_archive_sidebar_grid_gutter_custom_1024',
					'title'       => esc_html__( 'Custom Grid Gutter - 1024', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1024px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_archive_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_archive_sidebar_grid_gutter_custom_680',
					'title'       => esc_html__( 'Custom Grid Gutter - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);
		}
	}

	add_action( 'einar_core_action_after_portfolio_options_archive', 'einar_core_add_portfolio_archive_sidebar_options' );
}

if ( ! function_exists( 'einar_core_add_portfolio_single_sidebar_options' ) ) {
	/**
	 * Function that add sidebar options for portfolio single module
	 */
	function einar_core_add_portfolio_single_sidebar_options( $tab ) {

		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'einar-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for portfolio singles', 'einar-core' ),
					'default_value' => 'no-sidebar',
					'options'       => einar_core_get_select_type_options_pool( 'sidebar_layouts', false ),
				)
			);

			$custom_sidebars = einar_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_portfolio_single_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'einar-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on portfolio singles', 'einar-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$portfolio_single_sidebar_grid_gutter_row = $tab->add_row_element(
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

	add_action( 'einar_core_action_after_portfolio_options_single', 'einar_core_add_portfolio_single_sidebar_options' );
}
