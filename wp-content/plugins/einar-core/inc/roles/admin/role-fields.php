<?php

if ( ! function_exists( 'einar_core_add_admin_user_options' ) ) {
	/**
	 * Function that add global user options
	 */
	function einar_core_add_admin_user_options() {
		$qode_framework     = qode_framework_get_framework_root();
		$roles_social_scope = apply_filters( 'einar_core_filter_role_social_array', array( 'administrator', 'author' ) );

		$page = $qode_framework->add_options_page(
			array(
				'scope' => $roles_social_scope,
				'type'  => 'user',
				'title' => esc_html__( 'Social Networks', 'einar-core' ),
				'slug'  => 'admin-options',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_facebook',
					'title'       => esc_html__( 'Facebook', 'einar-core' ),
					'description' => esc_html__( 'Enter user Facebook profile URL', 'einar-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_instagram',
					'title'       => esc_html__( 'Instagram', 'einar-core' ),
					'description' => esc_html__( 'Enter user Instagram profile URL', 'einar-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_twitter',
					'title'       => esc_html__( 'Twitter', 'einar-core' ),
					'description' => esc_html__( 'Enter user Twitter profile URL', 'einar-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_linkedin',
					'title'       => esc_html__( 'LinkedIn', 'einar-core' ),
					'description' => esc_html__( 'Enter user LinkedIn profile URL', 'einar-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_pinterest',
					'title'       => esc_html__( 'Pinterest', 'einar-core' ),
					'description' => esc_html__( 'Enter user Pinterest profile URL', 'einar-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_admin_user_options_map', $page );
		}
	}

	add_action( 'einar_core_action_register_role_custom_fields', 'einar_core_add_admin_user_options' );
}
