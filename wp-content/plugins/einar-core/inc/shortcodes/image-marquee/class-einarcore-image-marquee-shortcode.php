<?php

if ( ! function_exists( 'einar_core_add_image_marquee_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_image_marquee_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Image_Marquee_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_image_marquee_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Image_Marquee_Shortcode extends EinarCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'einar_core_filter_image_marquee_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'einar_core_filter_image_marquee_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/image-marquee' );
			$this->set_base( 'einar_core_image_marquee' );
			$this->set_name( esc_html__( 'Image Marquee', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds Image Marquee element', 'einar-core' ) );
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
					'field_type'    => 'select',
					'name'          => 'slightly_rotate_marquee',
					'title'         => esc_html__( 'Slightly Rotate Marquee', 'einar-core' ),
					'options'       => array(
						''      => esc_html__( 'No Rotation', 'einar-core' ),
						'left'  => esc_html__( 'Left', 'einar-core' ),
						'right' => esc_html__( 'Right', 'einar-core' ),
					),
					'default_value' => '',
				)
			);
            $this->set_option(
                array(
                'field_type'    => 'select',
                'name'          => 'enable_border',
                'title'         => esc_html__( 'Enable Border Around Image', 'einar-core' ),
                'options'       => einar_core_get_select_type_options_pool( 'no_yes' ),
                'default_value' => 'no'
                )
            );
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'duration',
					'title'         => esc_html__( 'Animation Duration (Seconds)', 'einar-core' ),
					'default_value' => '20',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Child elements', 'einar-core' ),
					'items'      => array(
						array(
							'field_type' => 'image',
							'name'       => 'item_image',
							'title'      => esc_html__( 'Image', 'einar-core' ),
							'multiple'   => 'no',
						),
						array(
							'field_type'    => 'text',
							'name'          => 'item_image_link',
							'title'         => esc_html__( 'Link', 'einar-core' ),
							'default_value' => '',
						),
						array(
							'field_type'    => 'select',
							'name'          => 'item_image_link_target',
							'title'         => esc_html__( 'Target', 'einar-core' ),
							'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
							'default_value' => '_self',
						),
					),
				)
			);
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']           = $this->get_holder_classes( $atts );
			$atts['items']                    = $this->parse_repeater_items( $atts['children'] );
			$atts['content_styles']           = $this->get_content_styles( $atts, false );
			$atts['mobile_content_styles']    = $this->get_content_styles( $atts, true );
			$atts['image_styles']             = $this->get_image_styles( $atts, false );
			$atts['copy_image_styles']        = $this->get_image_styles( $atts, true );
			$atts['mobile_image_styles']      = $this->get_image_styles( $atts, false, true );
			$atts['mobile_copy_image_styles'] = $this->get_image_styles( $atts, true, true );

			return einar_core_get_template_part( 'shortcodes/image-marquee', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-image-marquee';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['slightly_rotate_marquee'] ) ? 'qodef-rotate--' . $atts['slightly_rotate_marquee'] : '';
            $holder_classes[] = ! empty ( $atts['enable_border'] ) && $atts['enable_border'] == 'yes' ? 'qodef--enable-border-yes' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_content_styles( $atts, $is_mobile ) {
			$styles     = array();
			$image_size = 'full';

			foreach ( $atts['items'] as $item ) {
				if ( is_array( wp_get_attachment_image_src( $item['item_image'] ) ) ) {
					if ( $is_mobile ) {
						$image_height = ( wp_get_attachment_image_src( $item['item_image'], $image_size )[2] / 2 ) . 'px';
					} else {
						$image_height = ( wp_get_attachment_image_src( $item['item_image'], $image_size )[2] ) . 'px';
					}
				}
			}

			if ( ! empty( $image_height ) ) {
				$styles[] = 'height: ' . $image_height;
			}

			return $styles;
		}

		private function get_image_styles( $atts, $is_copy = false, $is_mobile = false ) {
			$styles = array();

			$image_size   = 'full';
			$image_width  = null;
			$image_height = '';

			foreach ( $atts['items'] as $item ) {

				if ( is_array( wp_get_attachment_image_src( $item['item_image'] ) ) ) {

					if ( $is_mobile ) {
						$image_width += intval( ( wp_get_attachment_image_src( $item['item_image'], $image_size )[1] / 2 ) );
						$image_height = ( wp_get_attachment_image_src( $item['item_image'], $image_size )[2] / 2 ) . 'px';
					} else {
						$image_width += intval( wp_get_attachment_image_src( $item['item_image'], $image_size )[1] );
						$image_height = wp_get_attachment_image_src( $item['item_image'], $image_size )[2] . 'px';
					}
				}
			}

			if ( ! empty( $image_width ) ) {
				$styles[] = 'width: ' . $image_width . 'px';
			}

			if ( ! empty( $image_height ) ) {
				$styles[] = 'height: ' . $image_height;
			}

			if ( ! empty( $atts['duration'] ) ) {
				$styles[] = 'animation: qode-move-marquee ' . intval( $atts['duration'] ) . 's linear infinite';

				if ( $is_copy ) {
					$styles[] = 'animation-name:qode-move-marquee-copy;';
				}
			}

			return $styles;
		}

		/*private function get_image_styles( $atts, $is_copy = false, $is_mobile = false ) {
			$styles = array();

			$image_id   = $atts['image'];
			$image_size = 'full';

			if ( is_array( wp_get_attachment_image_src( $image_id ) ) ) {
				$image_src = wp_get_attachment_image_src( $image_id, $image_size )[0];

				if ( $is_mobile ) {
					$image_width  = ( wp_get_attachment_image_src( $image_id, $image_size )[1] / 2 ) . 'px';
					$image_height = ( wp_get_attachment_image_src( $image_id, $image_size )[2] / 2 ) . 'px';
				} else {
					$image_width  = wp_get_attachment_image_src( $image_id, $image_size )[1] . 'px';
					$image_height = wp_get_attachment_image_src( $image_id, $image_size )[2] . 'px';
				}

				if ( ! empty( $image_src ) ) {
					$styles[] = 'background: url("' . esc_url( $image_src ) . '")';
				}

				if ( ! empty( $image_width ) ) {
					$styles[] = 'width: ' . $image_width;
				}

				if ( ! empty( $image_height ) ) {
					$styles[] = 'height: ' . $image_height;
				}

				if ( ! empty( $atts['duration'] ) ) {
					$styles[] = 'animation: qode-move-marquee ' . intval( $atts['duration'] ) . 's linear infinite';

					if ( $is_copy ) {
						$styles[] = 'animation-name:qode-move-marquee-copy;';
					}
				}
			}

			return $styles;
		}*/
	}
}
