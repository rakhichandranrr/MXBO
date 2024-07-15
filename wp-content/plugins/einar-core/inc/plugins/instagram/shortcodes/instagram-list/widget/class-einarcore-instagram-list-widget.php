<?php

if ( ! function_exists( 'einar_core_add_instagram_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function einar_core_add_instagram_list_widget( $widgets ) {
		if ( qode_framework_is_installed( 'instagram' ) ) {
			$widgets[] = 'EinarCore_Instagram_List_Widget';
		}

		return $widgets;
	}

	add_filter( 'einar_core_filter_register_widgets', 'einar_core_add_instagram_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EinarCore_Instagram_List_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'einar-core' ),
				)
			);
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'einar_core_instagram_list',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'einar_core_instagram_list' );
				$this->set_name( esc_html__( 'Einar Instagram List', 'einar-core' ) );
				$this->set_description( esc_html__( 'Add a instagram list element into widget areas', 'einar-core' ) );
			}
		}

		public function render( $atts ) {
			echo EinarCore_Instagram_List_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
