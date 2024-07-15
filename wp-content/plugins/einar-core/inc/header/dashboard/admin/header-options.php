<?php

if ( ! function_exists( 'einar_core_add_header_options' ) ) {
	/**
	 * Function that add header options for this module
	 */
	function einar_core_add_header_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => EINAR_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'layout'      => 'tabbed',
				'slug'        => 'header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Header', 'einar-core' ),
				'description' => esc_html__( 'Global Header Options', 'einar-core' ),
			)
		);

		if ( $page ) {
			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-header-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General Settings', 'einar-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_header_layout',
					'title'         => esc_html__( 'Header Layout', 'einar-core' ),
					'description'   => esc_html__( 'Choose a header layout to set for your website', 'einar-core' ),
					'args'          => array( 'images' => true ),
					'options'       => apply_filters( 'einar_core_filter_header_layout_option', array() ),
					'default_value' => apply_filters( 'einar_core_filter_header_layout_default_option_value', '' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'einar-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'header_skin', false ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_header_options_map', $page, $general_tab );
		}
	}

	add_action( 'einar_core_action_default_options_init', 'einar_core_add_header_options', einar_core_get_admin_options_map_position( 'header' ) );
}
