<?php

if ( ! function_exists( 'einar_core_add_widgets_customizer_options' ) ) {
	/**
	 * Function that add customizer options for this module
	 */
	function einar_core_add_widgets_customizer_options( $page ) {

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type'  => 'section',
					'name'        => 'einar_core_performance_widgets_section',
					'title'       => esc_html__( 'Widgets', 'einar-core' ),
					'description' => esc_html__( 'Here you can select specific features to disable. Note that disabling certain features and functionality which you will not be needing or which you are otherwise not utilizing in any way can have a positive effect to the overall performance of your site.', 'einar-core' ),
				)
			);

			foreach ( glob( EINAR_CORE_INC_PATH . '/widgets/*', GLOB_ONLYDIR ) as $widget ) {
				$widget_name = basename( $widget );

				if ( 'dashboard' !== $widget_name ) {
					$widget_label = ucwords( str_replace( '-', ' ', $widget_name ) );
					$widget_name  = str_replace( '-', '_', $widget_name );

					$page->add_field_element(
						array(
							'field_type'        => 'setting',
							'option_type'       => 'option',
							'name'              => "einar_core_performance_widget_{$widget_name}",
							'default_value'     => false,
							'sanitize_callback' => 'sanitize_checkbox',
						)
					);

					$page->add_field_element(
						array(
							'field_type'  => 'control',
							'option_type' => 'checkbox',
							'section'     => 'einar_core_performance_widgets_section',
							'settings'    => "einar_core_performance_widget_{$widget_name}",
							'name'        => "einar_core_performance_widget_{$widget_name}_control",
							'title'       => $widget_label,
						)
					);
				}
			}

			// Hook to include additional options after module options
			do_action( 'einar_core_action_after_widgets_customizer_options', $page );
		}
	}

	add_action( 'einar_core_action_performance_customizer_options', 'einar_core_add_widgets_customizer_options' );
}
