<?php

if ( ! function_exists( 'einar_core_add_team_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function einar_core_add_team_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		$has_single     = einar_core_team_has_single();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'team' ),
				'type'  => 'meta',
				'slug'  => 'team',
				'title' => esc_html__( 'Team Single', 'einar-core' ),
			)
		);

		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'        => 'qodef_team_general_section',
					'title'       => esc_html__( 'General Settings', 'einar-core' ),
					'description' => esc_html__( 'General information about team member.', 'einar-core' ),
				)
			);

			if ( $has_single ) {
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_team_single_layout',
						'title'       => esc_html__( 'Single Layout', 'einar-core' ),
						'description' => esc_html__( 'Choose default layout for team single', 'einar-core' ),
						'options'     => array(
							'' => esc_html__( 'Default', 'einar-core' ),
						),
					)
				);
			}

			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_role',
					'title'       => esc_html__( 'Role', 'einar-core' ),
					'description' => esc_html__( 'Enter team member role', 'einar-core' ),
				)
			);

			$social_icons_repeater = $section->add_repeater_element(
				array(
					'name'        => 'qodef_team_member_social_icons',
					'title'       => esc_html__( 'Social Networks', 'einar-core' ),
					'description' => esc_html__( 'Populate team member social networks info', 'einar-core' ),
					'button_text' => esc_html__( 'Add New Network', 'einar-core' ),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_team_member_icon_source',
					'title'         => esc_html__( 'Team Member Icon Source', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'icon_source', false, array( 'predefined' ) ),
					'default_value' => 'svg_path',
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'iconpack',
					'name'       => 'qodef_team_member_icon',
					'title'      => esc_html__( 'Icon', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_team_member_icon_source' => array(
								'values'        => 'icon_pack',
								'default_value' => 'svg_path',
							),
						),
					),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_team_member_svg_path',
					'title'       => esc_html__( 'Team Member Icon SVG Path', 'einar-core' ),
					'description' => esc_html__( 'Enter your search open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_team_member_icon_source' => array(
								'values'        => 'svg_path',
								'default_value' => 'svg_path',
							),
						),
					),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_icon_link',
					'title'      => esc_html__( 'Icon Link', 'einar-core' ),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_team_member_icon_target',
					'title'      => esc_html__( 'Icon Target', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'link_target' ),
				)
			);

			if ( $has_single ) {
				$section->add_field_element(
					array(
						'field_type'  => 'date',
						'name'        => 'qodef_team_member_birth_date',
						'title'       => esc_html__( 'Birth Date', 'einar-core' ),
						'description' => esc_html__( 'Enter team member birth date', 'einar-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'text',
						'name'        => 'qodef_team_member_email',
						'title'       => esc_html__( 'E-mail', 'einar-core' ),
						'description' => esc_html__( 'Enter team member e-mail address', 'einar-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'text',
						'name'        => 'qodef_team_member_address',
						'title'       => esc_html__( 'Address', 'einar-core' ),
						'description' => esc_html__( 'Enter team member address', 'einar-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'text',
						'name'        => 'qodef_team_member_education',
						'title'       => esc_html__( 'Education', 'einar-core' ),
						'description' => esc_html__( 'Enter team member education', 'einar-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'file',
						'name'        => 'qodef_team_member_resume',
						'title'       => esc_html__( 'Resume', 'einar-core' ),
						'description' => esc_html__( 'Upload team member resume', 'einar-core' ),
						'args'        => array(
							'allowed_type' => '[application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
						),
					)
				);
			}

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_team_meta_box_map', $page, $has_single );
		}
	}

	add_action( 'einar_core_action_default_meta_boxes_init', 'einar_core_add_team_single_meta_box' );
}
