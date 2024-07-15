<?php

if ( ! function_exists( 'einar_core_add_animated_text_image_slider_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_animated_text_image_slider_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Animated_Text_Image_Slider_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_animated_text_image_slider_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Animated_Text_Image_Slider_Shortcode extends EinarCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/animated-text-image-slider' );
			$this->set_base( 'einar_core_animated_text_image_slider' );
			$this->set_name( esc_html__( 'Animated Text Image Slider', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds animated text image slider holder', 'einar-core' ) );
			$this->set_scripts(
				array(
					'swiper'                 => array(
						'registered' => true,
					),
					'einar-main-js' => array(
						'registered' => true,
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
					'field_type'  => 'select',
					'name'        => 'slider_loop',
					'title'       => esc_html__( 'Enable Slider Loop', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'yes_no' ),
					'description' => esc_html__( 'Default is YES', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'select',
					'name'        => 'slider_autoplay',
					'title'       => esc_html__( 'Enable Slider Autoplay', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'yes_no' ),
					'description' => esc_html__( 'Default is YES', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'slider_speed',
					'title'       => esc_html__( 'Slide Duration', 'einar-core' ),
					'description' => esc_html__( 'Default value is 5000 (ms)', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'slider_speed_animation',
					'title'       => esc_html__( 'Slide Animation Duration', 'einar-core' ),
					'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 1000.', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'slider_navigation',
					'title'         => esc_html__( 'Show Slider Navigation', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'no',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'full_height_slider',
					'title'         => esc_html__( 'Full Height Slider', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'yes',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'without_header',
					'title'         => esc_html__( 'Without header', 'einar-core' ),
					'description'   => esc_html__( 'NO value is useful when slider is somewhere in the middle of the page.', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'yes',
					'dependency'    => array(
						'hide' => array(
							'full_height_slider' => array(
								'values'        => 'no',
								'default_value' => 'yes',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'link_target',
					'title'         => esc_html__( 'Links Target', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Image Items', 'einar-core' ),
					'items'      => array(
						array(
							'field_type' => 'image',
							'name'       => 'main_image',
							'title'      => esc_html__( 'Main Image', 'einar-core' ),
						),
						array(
							'field_type'    => 'text',
							'name'          => 'item_link',
							'title'         => esc_html__( 'Link', 'einar-core' ),
							'default_value' => '',
						),
						array(
							'field_type'    => 'text',
							'name'          => 'info_title',
							'title'         => esc_html__( 'Title Top Part', 'einar-core' ),
							'default_value' => '',
						),
						array(
							'field_type'    => 'text',
							'name'          => 'info_title_superscript',
							'title'         => esc_html__( 'Title Top Superscript', 'einar-core' ),
							'default_value' => '',
						),
						array(
							'field_type'    => 'textarea',
							'name'          => 'info_description',
							'title'         => esc_html__( 'Text Description', 'einar-core' ),
							'default_value' => '',
						),
						array(
							'field_type'    => 'text',
							'name'          => 'info_title_bottom',
							'title'         => esc_html__( 'Title Bottom Part', 'einar-core' ),
							'default_value' => '',
						),
						array(
							'field_type'    => 'text',
							'name'          => 'info_title_bottom_two',
							'title'         => esc_html__( 'Title Bottom Part Two', 'einar-core' ),
							'default_value' => '',
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'show_fixed_text',
					'title'         => esc_html__( 'Show Fixed Text', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Fixed Text', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'textarea',
					'name'       => 'fixed_text_top',
					'title'      => esc_html__( 'Fixed Text Top', 'einar-core' ),
					'group'      => esc_html__( 'Fixed Text', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'show_fixed_text' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'textarea',
					'name'       => 'fixed_text_bottom',
					'title'      => esc_html__( 'Fixed Text Bottom', 'einar-core' ),
					'group'      => esc_html__( 'Fixed Text', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'show_fixed_text' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
				)
			);
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['this_shortcode'] = $this;

			return einar_core_get_template_part( 'shortcodes/animated-text-image-slider', 'templates/animated-text-image-slider', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-animated-text-image-slider';
			$holder_classes[] = isset( $atts['full_height_slider'] ) ? 'qodef-full-height-slider--' . $atts['full_height_slider'] : '';

			if ( ! empty( $atts['full_height_slider'] ) && 'yes' === $atts['full_height_slider'] ) {
				$holder_classes[] = ! empty( $atts['without_header'] ) && 'yes' === $atts['without_header'] ? 'qodef-full-height-without-header' : '';
			}

			if ( ! empty( $atts['show_fixed_text'] ) && 'yes' === $atts['show_fixed_text'] && ! empty( $atts['fixed_text'] ) ) {
				$holder_classes[] = 'qodef-with-fixed-text';
			}

			return implode( ' ', $holder_classes );
		}

		public function get_slider_data( $atts ) {
			$data = array();

			$data['slidesPerView']  = 1;
			$data['spaceBetween']   = 0;
			$data['loop']           = isset( $atts['slider_loop'] ) ? 'no' !== $atts['slider_loop'] : true;
			$data['autoplay']       = isset( $atts['slider_autoplay'] ) ? 'no' !== $atts['slider_autoplay'] : true;
			$data['speed']          = isset( $atts['slider_speed'] ) ? $atts['slider_speed'] : '';
			$data['speedAnimation'] = isset( $atts['slider_speed_animation'] ) ? $atts['slider_speed_animation'] : '';

			return json_encode( $data );
		}
	}
}
