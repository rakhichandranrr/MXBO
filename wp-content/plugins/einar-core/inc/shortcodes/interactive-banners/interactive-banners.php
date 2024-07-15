<?php

if ( ! function_exists( 'einar_core_add_interactive_banners_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function einar_core_add_interactive_banners_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Interactive_Banners_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_interactive_banners_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Interactive_Banners_Shortcode extends EinarCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/interactive-banners' );
			$this->set_base( 'einar_core_interactive_banners' );
			$this->set_name( esc_html__( 'Interactive Banners', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays interactive banners with provided parameters', 'einar-core' ) );
			$this->set_category( esc_html__( 'Einar Core', 'einar-core' ) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'number_of_items',
				'title'         => esc_html__( 'Number Of Items', 'einar-core' ),
				'options'       => array(
					'four' => esc_html__( 'Four', 'einar-core' ),
					'five' => esc_html__( 'Five', 'einar-core' )
				),
				'default_value' => 'five'
			) );
            $this->set_option(
                array(
                    'field_type' => 'select',
                    'name'       => 'skin',
                    'title'      => esc_html__( 'Skin', 'einar-core' ),
                    'options'    => einar_core_get_select_type_options_pool( 'header_skin' ),
                )
            );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'banners_height',
				'title'      => esc_html__( 'Interactive banner\'s height', 'cevian-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Items', 'einar-core' ),
				'items'      => array(
                    array(
                        'field_type'    => 'text',
                        'name'          => 'number',
                        'title'         => esc_html__( 'Number', 'einar-core' ),
                        'default_value' => ''
                    ),
					array(
						'field_type'    => 'text',
						'name'          => 'title',
						'title'         => esc_html__( 'Title', 'einar-core' ),
						'default_value' => ''
					),
					array(
						'field_type'    => 'text',
						'name'          => 'description_1',
						'title'         => esc_html__( 'Description Line 1', 'einar-core' ),
						'default_value' => ''
					),
                    array(
                        'field_type'    => 'text',
                        'name'          => 'description_2',
                        'title'         => esc_html__( 'Description Line 2', 'einar-core' ),
                        'default_value' => ''
                    ),
                    array(
                        'field_type'    => 'text',
                        'name'          => 'description_3',
                        'title'         => esc_html__( 'Description Line 3', 'einar-core' ),
                        'default_value' => ''
                    ),
					array(
						'field_type'    => 'text',
						'name'          => 'link',
						'title'         => esc_html__( 'Link', 'einar-core' ),
						'default_value' => ''
					),
					array(
						'field_type'    => 'select',
						'name'          => 'link_target',
						'title'         => esc_html__( 'Link Target', 'einar-core' ),
						'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
						'default_value' => '_self'
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image',
						'title'      => esc_html__( 'Background Image', 'einar-core' )
					),
                    array(
                        'field_type'    => 'text',
                        'name'          => 'additional_link_text',
                        'title'         => esc_html__( 'Additional Link Text', 'einar-core' ),
                        'default_value' => ''
                    ),
                    array(
                        'field_type'    => 'text',
                        'name'          => 'additional_link',
                        'title'         => esc_html__( 'Additional Link', 'einar-core' ),
                        'default_value' => ''
                    ),
					array(
                        'field_type'    => 'select',
                        'name'          => 'additional_link_target',
                        'title'         => esc_html__( 'Additional Link Target', 'einar-core' ),
                        'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
                        'default_value' => '_self'
                    ),
				)
			) );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']          = $this->get_holder_classes( $atts );
			$atts['number_of_items_numeric'] = $atts['number_of_items'] == 'four' ? 4 : 5;
			$atts['items']                   = $this->parse_repeater_items( $atts['children'] );
			$atts['this_shortcode']          = $this;

			return einar_core_get_template_part( 'shortcodes/interactive-banners', 'templates/interactive-banners', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = ! empty( $atts['number_of_items'] ) ? ' qodef-interactive-banners-' . $atts['number_of_items'] : ' qodef-interactive-banners-five';
			$holder_classes[] = ! empty( $params['banners_height'] ) ? ' qodef-ib-full-height' : ' qodef-ib-fixed-height';
            $holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}