<?php

if ( ! function_exists( 'einar_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function einar_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'EinarCore_Social_Share_Widget';

		return $widgets;
	}

	add_filter( 'einar_core_filter_register_widgets', 'einar_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EinarCore_Social_Share_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'einar_core_social_share',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'einar_core_social_share' );
				$this->set_name( esc_html__( 'Einar Social Share', 'einar-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'einar-core' ) );
			}
		}

		public function render( $atts ) {
			echo EinarCore_Social_Share_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
