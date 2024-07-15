<?php

if ( ! function_exists( 'einar_core_add_author_info_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function einar_core_add_author_info_widget( $widgets ) {
		$widgets[] = 'EinarCore_Author_Info_Widget';

		return $widgets;
	}

	add_filter( 'einar_core_filter_register_widgets', 'einar_core_add_author_info_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EinarCore_Author_Info_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'einar_core_author_info',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'einar_core_author_info' );
				$this->set_name( esc_html__( 'Einar Author Info', 'einar-core' ) );
				$this->set_description( esc_html__( 'Add a author info element into widget areas', 'einar-core' ) );
			}
		}

		public function render( $atts ) {
			echo EinarCore_Author_Info_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
