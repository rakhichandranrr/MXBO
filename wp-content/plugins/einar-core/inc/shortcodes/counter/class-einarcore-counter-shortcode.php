<?php

if ( ! function_exists( 'einar_core_add_counter_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_counter_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Counter_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_counter_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Counter_Shortcode extends EinarCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'einar_core_filter_counter_layouts', array() ) );

			$options_map   = einar_core_get_variations_options_map( $this->get_layouts() );
			$default_value = $options_map['default_value'];

			$this->set_extra_options( apply_filters( 'einar_core_filter_counter_extra_options', array(), $default_value ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/counter' );
			$this->set_base( 'einar_core_counter' );
			$this->set_name( esc_html__( 'Counter', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays counter with provided parameters', 'einar-core' ) );

			$options_map = einar_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'layout',
					'title'         => esc_html__( 'Layout', 'einar-core' ),
					'options'       => $this->get_layouts(),
					'default_value' => $options_map['default_value'],
					'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'show_digit_decoration',
					'title'         => esc_html__( 'Show Digit Decoration', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'layout' => array(
								'values'        => 'simple',
								'default_value' => 'simple',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'start_digit',
					'title'         => esc_html__( 'Start Digit', 'einar-core' ),
					'default_value' => 1,
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'end_digit',
					'title'         => esc_html__( 'End Digit', 'einar-core' ),
					'default_value' => 15,
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'step_digit',
					'title'      => esc_html__( 'Step Between Digits', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'step_delay',
					'title'      => esc_html__( 'Step Delay', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'digit_label',
					'title'      => esc_html__( 'Digit Label', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'digit_font_size',
					'title'      => esc_html__( 'Digit Font Size', 'einar-core' ),
					'group'      => esc_html__( 'Digit Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'digit_color',
					'title'      => esc_html__( 'Digit Color', 'einar-core' ),
					'group'      => esc_html__( 'Digit Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'title',
					'title'         => esc_html__( 'Title', 'einar-core' ),
					'default_value' => esc_html__( 'Title Text', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'h5',
					'group'         => esc_html__( 'Title Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'title_color',
					'title'      => esc_html__( 'Title Color', 'einar-core' ),
					'group'      => esc_html__( 'Title Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title_margin_top',
					'title'      => esc_html__( 'Title Margin Top', 'einar-core' ),
					'group'      => esc_html__( 'Title Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'textarea',
					'name'          => 'text',
					'title'         => esc_html__( 'Text', 'einar-core' ),
					'default_value' => esc_html__( 'Contrary to popular belief, Lorem Ipsum is not simply random text.', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'text_color',
					'title'      => esc_html__( 'Text Color', 'einar-core' ),
					'group'      => esc_html__( 'Text Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'text_margin_top',
					'title'      => esc_html__( 'Text Margin Top', 'einar-core' ),
					'group'      => esc_html__( 'Text Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'enable_appear',
					'title'      => esc_html__('Enable Appear', 'einar-core'),
					'options'    => einar_core_get_select_type_options_pool('no_yes', false),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'appear_delay',
					'title'      => esc_html__('Appear Delay in Ms', 'einar-core'),
					'dependency' => array(
						'show' => array(
							'enable_appear' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
				)
			);
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'einar_core_counter', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['data_attrs']     = $this->get_data_attrs( $atts );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['digit_styles']   = $this->get_digit_styles( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );

			return einar_core_get_template_part( 'shortcodes/counter', 'variations/' . $atts['layout'] . '/templates/counter', '', $atts );
		}

		private function get_data_attrs( $atts ) {
			$data = array();

			if ( ! empty( $atts['appear_delay'] ) ) {

				$appear_delay = intval( $atts['appear_delay'] );

				$data['data-appear-delay'] = $appear_delay;
			}

			if ( ! empty( $atts['start_digit'] ) ) {
				$data['data-start-digit'] = $atts['start_digit'];
			}

			if ( ! empty( $atts['end_digit'] ) ) {
				$data['data-end-digit'] = $atts['end_digit'];
			}

			if ( ! empty( $atts['step_digit'] ) ) {
				$data['data-step-digit'] = $atts['step_digit'];
			}

			if ( ! empty( $atts['step_delay'] ) ) {
				$data['data-step-delay'] = $atts['step_delay'];
			}

			if ( ! empty( $atts['digit_label'] ) ) {
				$data['data-digit-label'] = $atts['digit_label'];
			}

			return $data;
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-counter';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['show_digit_decoration'] ) ? 'qodef-show-digit-decoration--' . $atts['show_digit_decoration'] : '';
			$holder_classes[] = ( 'yes' === $atts['enable_appear'] ) ? 'qodef--has-appear' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_digit_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['digit_font_size'] ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['digit_font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['digit_font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['digit_font_size'] ) . 'px';
				}
			}

			if ( ! empty( $atts['digit_color'] ) ) {
				$styles[] = 'color: ' . $atts['digit_color'];
			}

			return $styles;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['title_margin_top'] ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}

		private function get_text_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['text_margin_top'] ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
				}
			}

			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}

			return $styles;
		}
	}
}
