<?php

if ( ! function_exists( 'einar_core_add_image_with_text_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function einar_core_add_image_with_text_widget( $widgets ) {
		$widgets[] = 'EinarCore_Image_With_Text_Widget';

		return $widgets;
	}

	add_filter( 'einar_core_filter_register_widgets', 'einar_core_add_image_with_text_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EinarCore_Image_With_Text_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'einar_core_image_with_text',
					'exclude'        => array( 'custom_class' ),
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'einar_core_image_with_text' );
				$this->set_name( esc_html__( 'Einar Image With Text', 'einar-core' ) );
				$this->set_description( esc_html__( 'Add a image with text element into widget areas', 'einar-core' ) );
			}
		}

		public function render( $atts ) {
			echo EinarCore_Image_With_Text_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
