<?php

if ( ! function_exists( 'einar_core_add_team_archive_sidebar_options' ) ) {
	/**
	 * Function that add sidebar options for team archive module
	 */
	function einar_core_add_team_archive_sidebar_options( $tab ) {

		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_team_archive_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'einar-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for team archives', 'einar-core' ),
					'default_value' => 'no-sidebar',
					'options'       => einar_core_get_select_type_options_pool( 'sidebar_layouts', false ),
				)
			);

			$custom_sidebars = einar_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_team_archive_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'einar-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on team archives', 'einar-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_archive_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$team_archive_sidebar_grid_gutter_row = $tab->add_row_element(
				array(
					'name'       => 'qodef_team_archive_sidebar_grid_gutter_row',
					'dependency' => array(
						'show' => array(
							'qodef_team_archive_sidebar_grid_gutter' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$team_archive_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_archive_sidebar_grid_gutter_custom',
					'title'       => esc_html__( 'Custom Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$team_archive_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_archive_sidebar_grid_gutter_custom_1512',
					'title'       => esc_html__( 'Custom Grid Gutter - 1512', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1512px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$team_archive_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_archive_sidebar_grid_gutter_custom_1200',
					'title'       => esc_html__( 'Custom Grid Gutter - 1200', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1200px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$team_archive_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_archive_sidebar_grid_gutter_custom_680',
					'title'       => esc_html__( 'Custom Grid Gutter - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);
		}
	}

	add_action( 'einar_core_action_after_team_options_archive', 'einar_core_add_team_archive_sidebar_options' );
}

if ( ! function_exists( 'einar_core_add_team_single_sidebar_options' ) ) {
	/**
	 * Function that add sidebar options for team single module
	 */
	function einar_core_add_team_single_sidebar_options( $tab ) {

		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_team_single_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'einar-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for team singles', 'einar-core' ),
					'default_value' => 'no-sidebar',
					'options'       => einar_core_get_select_type_options_pool( 'sidebar_layouts', false ),
				)
			);

			$custom_sidebars = einar_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_team_single_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'einar-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on team singles', 'einar-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_single_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$team_single_sidebar_grid_gutter_row = $tab->add_row_element(
				array(
					'name'       => 'qodef_team_single_sidebar_grid_gutter_row',
					'dependency' => array(
						'show' => array(
							'qodef_team_single_sidebar_grid_gutter' => array(
								'values'        => 'custom',
								'default_value' => '',
							),
						),
					),
				)
			);

			$team_single_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_single_sidebar_grid_gutter_custom',
					'title'       => esc_html__( 'Custom Grid Gutter', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$team_single_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_single_sidebar_grid_gutter_custom_1512',
					'title'       => esc_html__( 'Custom Grid Gutter - 1512', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1512px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$team_single_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_single_sidebar_grid_gutter_custom_1200',
					'title'       => esc_html__( 'Custom Grid Gutter - 1200', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 1200px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$team_single_sidebar_grid_gutter_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_single_sidebar_grid_gutter_custom_680',
					'title'       => esc_html__( 'Custom Grid Gutter - 680', 'einar-core' ),
					'description' => esc_html__( 'Enter grid gutter size in pixels for screen size below 680px', 'einar-core' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);
		}
	}

	add_action( 'einar_core_action_after_team_options_single', 'einar_core_add_team_single_sidebar_options' );
}
