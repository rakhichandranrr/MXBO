<?php

if ( ! function_exists( 'einar_core_add_progress_bar_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_progress_bar_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Progress_Bar_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_progress_bar_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Progress_Bar_Shortcode extends EinarCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/progress-bar' );
			$this->set_base( 'einar_core_progress_bar' );
			$this->set_name( esc_html__( 'Progress Bar', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays progress bar with provided parameters', 'einar-core' ) );
			$this->set_scripts(
				array(
					'progress-bar-line'   => array(
						'registered' => false,
						'url'        => EINAR_CORE_INC_URL_PATH . '/shortcodes/progress-bar/assets/js/plugins/jquery.lineProgressbar.js',
						'dependency' => array( 'jquery' ),
					),
					'progress-bar-circle' => array(
						'registered' => false,
						'url'        => EINAR_CORE_INC_URL_PATH . '/shortcodes/progress-bar/assets/js/plugins/progressbar.min.js',
						'dependency' => array( 'jquery' ),
					),
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
					'name'          => 'layout',
					'title'         => esc_html__( 'Layout', 'einar-core' ),
					'options'       => array(
						'circle'      => esc_html__( 'Circle', 'einar-core' ),
						'semi-circle' => esc_html__( 'Semi Circle', 'einar-core' ),
						'line'        => esc_html__( 'Line', 'einar-core' ),
						'custom'      => esc_html__( 'Custom', 'einar-core' ),
					),
					'default_value' => 'line',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'textarea_html',
					'name'       => 'custom_shape',
					'title'      => esc_html__( 'Custom Shape (SVG code)', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'layout' => array(
								'values'        => 'custom',
								'default_value' => '_self',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'limit_circle_size',
					'title'         => esc_html__( 'Limit Circle Size', 'einar-core' ),
					'description'   => esc_html__( 'Limits circle size to 152px.', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'layout' => array(
								'values'        => 'circle',
								'default_value' => 'circle',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'percentage_type',
					'title'      => esc_html__( 'Percentage Type', 'einar-core' ),
					'options'    => array(
						''         => esc_html__( 'Default', 'einar-core' ),
						'floating' => esc_html__( 'Floating', 'einar-core' ),
					),
					'dependency' => array(
						'show' => array(
							'layout' => array(
								'values'        => 'line',
								'default_value' => 'circle',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'active_line_color',
					'title'      => esc_html__( 'Active Line Color', 'einar-core' ),
					'group'      => esc_html__( 'Line Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'active_line_width',
					'title'       => esc_html__( 'Active Line Width', 'einar-core' ),
					'description' => esc_html__( 'Enter width for active line without unit. Default value is 4 (1 is equal 3.59px for circle and custom type)', 'einar-core' ),
					'group'       => esc_html__( 'Line Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'inactive_line_color',
					'title'      => esc_html__( 'Inactive Color', 'einar-core' ),
					'group'      => esc_html__( 'Line Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'inactive_line_width',
					'title'       => esc_html__( 'Inactive Line Width', 'einar-core' ),
					'description' => esc_html__( 'Enter width for inactive line without unit. Default value is 4 (1 is equal 3.59px for circle and custom type)', 'einar-core' ),
					'group'       => esc_html__( 'Line Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'duration',
					'title'       => esc_html__( 'Animation Duration (ms)', 'einar-core' ),
					'description' => esc_html__( 'Speed of progress animation in milliseconds. Default value is 1600.', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'number',
					'title'         => esc_html__( 'Percentage Number', 'einar-core' ),
					'description'   => esc_html__( 'Enter percentage number for progress bar', 'einar-core' ),
					'default_value' => '46',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'number_color',
					'title'      => esc_html__( 'Number Color', 'einar-core' ),
					'group'      => esc_html__( 'Number Style', 'einar-core' ),
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
					'options'       => einar_core_get_select_type_options_pool( 'title_tag', true, array(), array( 'span' => 'SPAN' ) ),
					'default_value' => 'span',
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
					'field_type'  => 'text',
					'name'        => 'title_margin',
					'title'       => esc_html__( 'Title Margin', 'einar-core' ),
					'description' => esc_html__( 'If you selected a progress bar layout other than line this option corresponds to the margin top; in the event line layout type is selected, the option corresponds to the margin bottom.', 'einar-core' ),
					'group'       => esc_html__( 'Title Style', 'einar-core' ),
				)
			);
		}

		public function load_assets() {
			$atts = $this->get_atts();

			if ( 'line' === $atts['layout'] ) {
				wp_enqueue_script( 'progress-bar-line' );
			} else {
				wp_enqueue_script( 'progress-bar-circle' );
			}
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'einar_core_progress_bar', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['data_attrs']     = $this->get_data_attrs( $atts );

			return einar_core_get_template_part( 'shortcodes/progress-bar', 'templates/progress-bar', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-progress-bar';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['limit_circle_size'] ) ? 'qodef-limit-circle-size--' . $atts['limit_circle_size'] : '';

			if ( 'line' === $atts['layout'] && ! empty( $atts['percentage_type'] ) ) {
				$holder_classes[] = 'qodef-percentage--' . $atts['percentage_type'];
			}

			return implode( ' ', $holder_classes );
		}

		private function get_data_attrs( $atts ) {
			$data = array();

			if ( ! empty( $atts['layout'] ) ) {
				$data['data-layout'] = $atts['layout'];
			}

			$data['data-active-line-color'] = ! empty( $atts['active_line_color'] ) ? $atts['active_line_color'] : '#fff';
			$data['data-active-line-width'] = ! empty( $atts['active_line_width'] ) ? floatval( $atts['active_line_width'] ) : 4;

			$data['data-inactive-line-color'] = ! empty( $atts['inactive_line_color'] ) ? $atts['inactive_line_color'] : '#afafaf';
			$data['data-inactive-line-width'] = ! empty( $atts['inactive_line_width'] ) ? floatval( $atts['inactive_line_width'] ) : 4;

			$data['data-duration'] = ! empty( $atts['duration'] ) ? intval( $atts['duration'] ) : '';
			$data['data-number']   = ! empty( $atts['number'] ) ? $atts['number'] : '0.00';

			$data['data-text-color'] = ! empty( $atts['number_color'] ) ? $atts['number_color'] : '#fff';

			return $data;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['title_margin'] ) {
				if ( 'line' === $atts['layout'] ) {
					$styles[] = 'margin-bottom: ' . intval( $atts['title_margin'] ) . 'px';
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin'] ) . 'px';
				}
			}

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}
	}
}
