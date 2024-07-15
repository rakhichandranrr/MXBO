<?php

if ( ! function_exists( 'einar_core_add_icon_list_item_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function einar_core_add_icon_list_item_widget( $widgets ) {
		$widgets[] = 'EinarCore_Icon_List_Item_Widget';

		return $widgets;
	}

	add_filter( 'einar_core_filter_register_widgets', 'einar_core_add_icon_list_item_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EinarCore_Icon_List_Item_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'einar_core_icon_list_item',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'einar_core_icon_list_item' );
				$this->set_name( esc_html__( 'Einar Icon List Item', 'einar-core' ) );
				$this->set_description( esc_html__( 'Add a icon list item element into widget areas', 'einar-core' ) );
			}
		}

		public function render( $atts ) {
			echo EinarCore_Icon_List_Item_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
