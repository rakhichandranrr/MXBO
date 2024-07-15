<?php

if ( ! function_exists( 'einar_core_add_separator_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_separator_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Separator_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_separator_shortcode', 9 );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Separator_Shortcode extends EinarCore_Shortcode {
		var $breakpoints = array( 1600, 1512, 1368, 1200, 1024, 880, 680 ); // match array in scss file: _separator-default.scss

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/separator' );
			$this->set_base( 'einar_core_separator' );
			$this->set_name( esc_html__( 'Separator', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays separator with provided parameters', 'einar-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'position',
					'title'      => esc_html__( 'Position', 'einar-core' ),
					'options'    => array(
						''       => esc_html__( 'Default', 'einar-core' ),
						'center' => esc_html__( 'Center', 'einar-core' ),
						'left'   => esc_html__( 'Left', 'einar-core' ),
						'right'  => esc_html__( 'Right', 'einar-core' ),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'show',
					'options'    => einar_core_get_select_type_options_pool( 'yes_no', false ),
					'title'      => esc_html__( 'Show Separator', 'einar-core' ),
				)
			);
			$breakpoints = $this->breakpoints;
			foreach ( $breakpoints as $breakpoint ) {
				$title_label = sprintf( '%s ' . $breakpoint . ' %s', esc_html__( 'Show Separator Below', 'einar-core' ), esc_html__( 'px', 'einar-core' ) );
				$this->set_option(
					array(
						'field_type' => 'select',
						'name'       => 'show_' . $breakpoint,
						'options'    => einar_core_get_select_type_options_pool( 'yes_no', false ),
						'title'      => $title_label,
					)
				);
			}
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'color',
					'title'      => esc_html__( 'Color', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'border_style',
					'title'      => esc_html__( 'Border Style', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'border_style' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'width',
					'title'      => esc_html__( 'Width (px or %)', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'thickness',
					'title'      => esc_html__( 'Thickness (px)', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'margin_top',
					'title'      => esc_html__( 'Margin Top (px or %)', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'margin_bottom',
					'title'      => esc_html__( 'Margin Bottom (px or %)', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'einar_core_separator', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']   = $this->get_holder_classes( $atts );
			$atts['separator_styles'] = $this->get_separator_styles( $atts );

			return einar_core_get_template_part( 'shortcodes/separator', 'templates/separator', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-separator';
			$holder_classes[] = 'clear';
			$holder_classes[] = ! empty( $atts['position'] ) ? 'qodef-position--' . $atts['position'] : '';
			$holder_classes[] = ! empty( $atts['show'] ) ? 'qodef-show--' . $atts['show'] : '';

			$breakpoints = $this->breakpoints;
			foreach ( $breakpoints as $breakpoint ) {
				$holder_classes[] = ! empty( $atts['show_' . $breakpoint] ) ? 'qodef-show-' . $breakpoint . '--' . $atts['show_' . $breakpoint] : '';
			}

			return implode( ' ', $holder_classes );
		}

		private function get_separator_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['color'] ) ) {
				$styles[] = 'border-color: ' . $atts['color'];
			}

			if ( ! empty( $atts['border_style'] ) ) {
				$styles[] = 'border-style: ' . $atts['border_style'];
			}

			$width = $atts['width'];
			if ( ! empty( $width ) ) {
				if ( qode_framework_string_ends_with_space_units( $width ) ) {
					$styles[] = 'width: ' . $width;
				} else {
					$styles[] = 'width: ' . intval( $width ) . 'px';
				}
			}

			$thickness = $atts['thickness'];
			if ( ! empty( $thickness ) ) {
				$styles[] = 'border-bottom-width: ' . intval( $thickness ) . 'px';
			}

			$margin_top = $atts['margin_top'];
			if ( ! empty( $margin_top ) ) {
				if ( qode_framework_string_ends_with_space_units( $margin_top ) ) {
					$styles[] = 'margin-top: ' . $margin_top;
				} else {
					$styles[] = 'margin-top: ' . intval( $margin_top ) . 'px';
				}
			}

			$margin_bottom = $atts['margin_bottom'];
			if ( ! empty( $margin_bottom ) ) {
				if ( qode_framework_string_ends_with_space_units( $margin_bottom ) ) {
					$styles[] = 'margin-bottom: ' . $margin_bottom;
				} else {
					$styles[] = 'margin-bottom: ' . intval( $margin_bottom ) . 'px';
				}
			}

			return implode( ';', $styles );
		}
	}
}
