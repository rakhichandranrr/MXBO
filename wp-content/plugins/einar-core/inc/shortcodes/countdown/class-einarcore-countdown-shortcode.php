<?php

if ( ! function_exists( 'einar_core_add_countdown_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_countdown_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Countdown_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_countdown_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Countdown_Shortcode extends EinarCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'einar_core_filter_countdown_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/countdown' );
			$this->set_base( 'einar_core_countdown' );
			$this->set_name( esc_html__( 'Countdown', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays countdown with provided parameters', 'einar-core' ) );

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
					'field_type'  => 'date',
					'name'        => 'date',
					'title'       => esc_html__( 'Date', 'einar-core' ),
					'description' => esc_html__( 'Enter date in format Y/m/d H:i:s', 'einar-core' ), //because of the wpbackery
				)
			);
            $this->set_option(
                array(
                    'field_type' => 'image',
                    'name'       => 'week_image',
                    'title'      => esc_html__( 'Week Image', 'einar-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'week_label',
					'title'      => esc_html__( 'Week Label', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'week_label_plural',
					'title'      => esc_html__( 'Week Label Plural', 'einar-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type' => 'image',
                    'name'       => 'day_image',
                    'title'      => esc_html__( 'Day Image', 'einar-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'day_label',
					'title'      => esc_html__( 'Day Label', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'day_label_plural',
					'title'      => esc_html__( 'Day Label Plural', 'einar-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type' => 'image',
                    'name'       => 'hour_image',
                    'title'      => esc_html__( 'Hour Image', 'einar-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'hour_label',
					'title'      => esc_html__( 'Hour Label', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'hour_label_plural',
					'title'      => esc_html__( 'Hour Label Plural', 'einar-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type' => 'image',
                    'name'       => 'minute_image',
                    'title'      => esc_html__( 'Minute Image', 'einar-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'minute_label',
					'title'      => esc_html__( 'Minute Label', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'minute_label_plural',
					'title'      => esc_html__( 'Minute Label Plural', 'einar-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type' => 'image',
                    'name'       => 'second_image',
                    'title'      => esc_html__( 'Second Image', 'einar-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'second_label',
					'title'      => esc_html__( 'Second Label', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'second_label_plural',
					'title'      => esc_html__( 'Second Label Plural', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'skin',
					'title'      => esc_html__( 'Skin', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'header_skin' ),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['data_attrs']     = $this->get_data_attrs( $atts );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			return einar_core_get_template_part( 'shortcodes/countdown', 'variations/' . $atts['layout'] . '/templates/countdown', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-countdown';
			$holder_classes[] = 'qodef-show--5';

			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-countdown--' . $atts['skin'] : '';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $holder_classes );
		}

		private function get_data_attrs( $atts ) {
			$data = array();

			if ( ! empty( $atts['date'] ) ) {
				$date              = $atts['date'];
				$date_formatted    = gmdate( 'Y/m/d H:i:s', strtotime( $date ) );
				$data['data-date'] = $date_formatted;
			}

			$date_formats = array(
				'week'   => array(
					'default' => esc_html__( 'Week', 'einar-core' ),
					'plural'  => esc_html__( 'Weeks', 'einar-core' ),
				),
				'day'    => array(
					'default' => esc_html__( 'Day', 'einar-core' ),
					'plural'  => esc_html__( 'Days', 'einar-core' ),
				),
				'hour'   => array(
					'default' => esc_html__( 'Hour', 'einar-core' ),
					'plural'  => esc_html__( 'Hours', 'einar-core' ),
				),
				'minute' => array(
					'default' => esc_html__( 'Minute', 'einar-core' ),
					'plural'  => esc_html__( 'Minutes', 'einar-core' ),
				),
				'second' => array(
					'default' => esc_html__( 'Second', 'einar-core' ),
					'plural'  => esc_html__( 'Seconds', 'einar-core' ),
				),
			);

			foreach ( $date_formats as $key => $value ) {
				if ( ! empty( $atts[$key . '_label'] ) ) {
					$data['data-' . $key . '-label'] = $atts[$key . '_label'];
				} else {
					$data['data-' . $key . '-label'] = $value['default'];
				}

				if ( ! empty( $atts[$key . '_label_plural'] ) ) {
					$data['data-' . $key . '-label-plural'] = $atts[$key . '_label_plural'];
				} else {
					$data['data-' . $key . '-label-plural'] = $value['plural'];
				}
			}

			return $data;
		}
	}
}
