<?php

if ( ! function_exists( 'einar_core_add_author_info_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_author_info_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Author_Info_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_author_info_shortcode', 9 );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Author_Info_Shortcode extends EinarCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/author-info' );
			$this->set_base( 'einar_core_author_info' );
			$this->set_name( esc_html__( 'Author Info', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays author info with provided parameters', 'einar-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'einar-core' ),
				)
			);
			$this->set_option(
                array(
                    'field_type' => 'text',
                    'name'       => 'author_username',
                    'title'      => esc_html__( 'Author Username', 'einar-core' ),
                )
			);
            $this->set_option(
                array(
                    'field_type'  => 'text',
                    'name'        => 'author_name_line_break_positions',
                    'title'       => esc_html__( 'Positions of Line Break', 'einar-core' ),
                    'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'einar-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type'    => 'select',
                    'name'          => 'disable_author_link',
                    'title'         => esc_html__( 'Disable Author Link', 'einar-core' ),
                    'options'       => einar_core_get_select_type_options_pool( 'no_yes', false ),
                    'default_value' => 'no',
                )
            );
            $this->set_option(
                array(
                    'field_type' => 'select',
                    'name'       => 'skin',
                    'title'      => esc_html__( 'Link Skin', 'einar-core' ),
                    'options'    => einar_core_get_select_type_options_pool( 'shortcode_skin_dark' ),
                )
            );
            $this->set_option(
                array(
                    'field_type'  => 'text',
                    'name'        => 'author_custom_link',
                    'title'       => esc_html__( 'Author Custom Link', 'einar-core' ),
                    'description' => esc_html__( 'Default link will open author posts list.', 'einar-core' ),
                    'dependency'  => array(
                        'show' => array(
                            'disable_author_link' => array(
                                'values'        => 'no',
                                'default_value' => 'no',
                            ),
                        ),
                    ),
                )
            );
            $this->set_option(
                array(
                    'field_type'  => 'textarea',
                    'name'        => 'author_custom_description',
                    'title'       => esc_html__( 'Author Custom Description', 'einar-core' ),
                    'description' => esc_html__( 'Default description if specified is Biographical Info from user profile.', 'einar-core' ),
                )
            );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'einar_core_author_info', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			return einar_core_get_template_part( 'shortcodes/author-info', 'templates/author-info', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-author-info';
            $holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}
