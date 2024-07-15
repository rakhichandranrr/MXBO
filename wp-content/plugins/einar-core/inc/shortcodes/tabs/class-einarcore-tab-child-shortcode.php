<?php

if ( ! function_exists( 'einar_core_add_tabs_child_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_tabs_child_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Tabs_Child_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_tabs_child_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Tabs_Child_Shortcode extends EinarCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/tabs' );
			$this->set_base( 'einar_core_tabs_child' );
			$this->set_name( esc_html__( 'Tabs Child', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds tab child to tabs holder', 'einar-core' ) );
			$this->set_is_child_shortcode( true );
			$this->set_parent_elements(
				array(
					'einar_core_tabs',
				)
			);
			$this->set_is_parent_shortcode( true );

			$elementor_sections  = array();
			$elementor_templates = array();
			if ( qode_framework_is_installed( 'elementor' ) ) {
				$elementor_sections  = einar_core_generate_elementor_templates_control_predefined( $this );
				$elementor_templates = einar_core_return_elementor_templates_predefined();
			}

			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'tab_title',
					'title'      => esc_html__( 'Title', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'layout',
					'title'         => esc_html__( 'Layout', 'einar-core' ),
					'default_value' => '',
					'visibility'    => array( 'map_for_page_builder' => false ),
				)
			);

			if ( ! empty( $elementor_templates ) ) {
				$this->set_option( $elementor_sections );
			}
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['tab_title'] = $atts['tab_title'] . '-' . rand( 0, 1000 );
			$atts['content']   = $content;

			return einar_core_get_template_part( 'shortcodes/tabs', 'variations/' . $atts['layout'] . '/templates/child', '', $atts );
		}
	}
}
