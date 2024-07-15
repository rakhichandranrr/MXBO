<?php

if ( ! function_exists( 'einar_core_add_blog_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function einar_core_add_blog_list_widget( $widgets ) {
		$widgets[] = 'EinarCore_Blog_List_Widget';

		return $widgets;
	}

	add_filter( 'einar_core_filter_register_widgets', 'einar_core_add_blog_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EinarCore_Blog_List_Widget extends QodeFrameworkWidget {

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
					'shortcode_base' => 'einar_core_blog_list',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'einar_core_blog_list' );
				$this->set_name( esc_html__( 'Einar Blog List', 'einar-core' ) );
				$this->set_description( esc_html__( 'Display a list of blog posts', 'einar-core' ) );
			}
		}

		public function render( $atts ) {
			$atts['is_widget_element'] = 'yes';

			echo EinarCore_Blog_List_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
