<?php

if ( ! function_exists( 'einar_core_add_custom_font_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function einar_core_add_custom_font_widget( $widgets ) {
		$widgets[] = 'EinarCore_Custom_Font_Widget';

		return $widgets;
	}

	add_filter( 'einar_core_filter_register_widgets', 'einar_core_add_custom_font_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EinarCore_Custom_Font_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'einar_core_custom_font',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'einar_core_custom_font' );
				$this->set_name( esc_html__( 'Einar Custom Font', 'einar-core' ) );
				$this->set_description( esc_html__( 'Add a custom font element into widget areas', 'einar-core' ) );
			}
		}

		public function render( $atts ) {
			echo EinarCore_Custom_Font_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
