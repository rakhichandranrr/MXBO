<?php

if ( ! function_exists( 'einar_core_add_service_list_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_service_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Service_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_service_list_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Service_List_Shortcode extends EinarCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'einar_core_filter_service_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'einar_core_filter_service_list_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/service-list' );
			$this->set_base( 'einar_core_service_list' );
			$this->set_name( esc_html__( 'Service List', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds service list element', 'einar-core' ) );
			$this->set_category( esc_html__( 'Einar Core', 'einar-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'einar-core' ),
				)
			);

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
					'field_type' => 'select',
					'name'       => 'skin',
					'title'      => esc_html__( 'Skin', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'header_skin' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title_font_size',
					'title'      => esc_html__( 'Title Font Size', 'einar-core' ),
					'group'      => esc_html__( 'Title Style', 'einar-core' ),
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
                    'name'       => 'title_font_size_1512',
                    'title'      => esc_html__( 'Title Font Size 1512', 'einar-core' ),
                    'group'      => esc_html__( 'Responsive Style', 'einar-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title_font_size_1440',
					'title'      => esc_html__( 'Title Font Size 1440', 'einar-core' ),
					'group'      => esc_html__( 'Responsive Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title_font_size_1366',
					'title'      => esc_html__( 'Title Font Size 1366', 'einar-core' ),
					'group'      => esc_html__( 'Responsive Style', 'einar-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type' => 'text',
                    'name'       => 'title_font_size_1200',
                    'title'      => esc_html__( 'Title Font Size 1200', 'einar-core' ),
                    'group'      => esc_html__( 'Responsive Style', 'einar-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title_font_size_1024',
					'title'      => esc_html__( 'Title Font Size 1024', 'einar-core' ),
					'group'      => esc_html__( 'Responsive Style', 'einar-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type' => 'text',
                    'name'       => 'title_font_size_880',
                    'title'      => esc_html__( 'Title Font Size 880', 'einar-core' ),
                    'group'      => esc_html__( 'Responsive Style', 'einar-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title_font_size_768',
					'title'      => esc_html__( 'Title Font Size 768', 'einar-core' ),
					'group'      => esc_html__( 'Responsive Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title_font_size_680',
					'title'      => esc_html__( 'Title Font Size 680', 'einar-core' ),
					'group'      => esc_html__( 'Responsive Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'link_target',
					'title'         => esc_html__( 'Link Target', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'label',
					'title'      => esc_html__( 'Label', 'einar-core' ),
					'group'      => esc_html__( 'Additional', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'label_color',
					'title'      => esc_html__( 'Label Color', 'einar-core' ),
					'group'      => esc_html__( 'Additional', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'button_text',
					'title'      => esc_html__( 'Button Text', 'einar-core' ),
					'group'      => esc_html__( 'Additional', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'button_link',
					'title'      => esc_html__( 'Button Link', 'einar-core' ),
					'group'      => esc_html__( 'Additional', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'button_link_target',
					'title'         => esc_html__( 'Button Link Target', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
					'group'         => esc_html__( 'Additional', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Child elements', 'einar-core' ),
					'items'      => array(
						array(
							'field_type' => 'text',
							'name'       => 'item_title',
							'title'      => esc_html__( 'Title', 'einar-core' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'text_1',
							'title'      => esc_html__( 'Text 1', 'einar-core' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'text_2',
							'title'      => esc_html__( 'Text 2', 'einar-core' ),
						),
						array(
							'field_type'    => 'text',
							'name'          => 'link',
							'title'         => esc_html__( 'Link', 'einar-core' ),
							'default_value' => '',
						),
						array(
							'field_type' => 'image',
							'name'       => 'image',
							'title'      => esc_html__( 'Image', 'einar-core' ),
							'multiple'   => 'no',
						),
					),
				)
			);
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'einar_core_service_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['unique_class']   = 'qodef-service-list-' . rand( 0, 1000 );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['label_styles']   = $this->get_label_styles( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['this_shortcode'] = $this;
			$this->set_responsive_styles( $atts );

			return einar_core_get_template_part( 'shortcodes/service-list', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-service-list';
			$holder_classes[] = $atts['unique_class'];
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			$font_size = $atts['title_font_size'];
			if ( ! empty( $font_size ) ) {
				if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
					$styles[] = 'font-size: ' . $font_size;
				} else {
					$styles[] = 'font-size: ' . intval( $font_size ) . 'px';
				}
			}

			return $styles;
		}

		private function set_responsive_styles( $atts ) {
			$unique_class = '.' . $atts['unique_class'] . ' .qodef-e-title';
			$screen_sizes = array( '1512', '1440', '1366', '1200', '1024', '880', '768', '680' );
			$option_keys  = array( 'font_size' );

			foreach ( $screen_sizes as $screen_size ) {
				$styles = array();

				foreach ( $option_keys as $option_key ) {
					$option_value = $atts[ 'title_' . $option_key . '_' . $screen_size ];
					$style_key    = str_replace( 'title_', '', $option_key );
					$style_key    = str_replace( '_', '-', $option_key );

					if ( '' !== $option_value ) {
						if ( qode_framework_string_ends_with_typography_units( $option_value ) ) {
							$styles[ $style_key ] = $option_value . '!important';
						} else {
							$styles[ $style_key ] = intval( $option_value ) . 'px !important';
						}
					}
				}

				if ( ! empty( $styles ) ) {
					add_filter(
						'einar_core_filter_add_responsive_' . $screen_size . '_inline_style_in_footer',
						function ( $style ) use ( $unique_class, $styles ) {
							$style .= qode_framework_dynamic_style( $unique_class, $styles );

							return $style;
						}
					);
				}
			}
		}

		public function get_label_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['label_color'] ) ) {
				$styles[] = 'color: ' . $atts['label_color'];
			}

			return $styles;
		}
	}
}
