<?php

if ( ! function_exists( 'einar_core_add_image_gallery_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_image_gallery_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Image_Gallery_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_image_gallery_shortcode' );
}

if ( class_exists( 'EinarCore_List_Shortcode' ) ) {
	class EinarCore_Image_Gallery_Shortcode extends EinarCore_List_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/image-gallery' );
			$this->set_base( 'einar_core_image_gallery' );
			$this->set_name( esc_html__( 'Image Gallery', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image gallery element', 'einar-core' ) );
			$this->set_scripts(
				array(
					'jquery-magnific-popup' => array(
						'registered' => true,
					),
				)
			);
			$this->set_necessary_styles(
				array(
					'magnific-popup' => array(
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
					'field_type' => 'image',
					'name'       => 'images',
					'multiple'   => 'yes',
					'title'      => esc_html__( 'Images', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'image_size',
					'title'       => esc_html__( 'Image Size', 'einar-core' ),
					'description' => esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'image_action',
					'title'      => esc_html__( 'Image Action', 'einar-core' ),
					'options'    => array(
						''            => esc_html__( 'No Action', 'einar-core' ),
						'open-popup'  => esc_html__( 'Open Popup', 'einar-core' ),
						'custom-link' => esc_html__( 'Custom Link', 'einar-core' ),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'target',
					'title'         => esc_html__( 'Custom Link Target', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
					'dependency'    => array(
						'show' => array(
							'image_action' => array(
								'values'        => 'custom-link',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->map_list_options(
				array(
					'exclude_behavior'      => array( 'justified-gallery' ),
					'exclude_option'        => array( 'images_proportion' ),
					'group'                 => esc_html__( 'Gallery Settings', 'einar-core' ),
					'include_slider_option' => array(
						'slider_direction',
						'slider_hidden_slides',
						'slider_mousewheel_navigation',
						'slider_centered_slides',
						'slider_drag_cursor',
						'navigation_inside',
						'pagination_type',
					),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'einar_core_image_gallery', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			$atts = $this->get_atts();

			if ( isset( $atts['image_action'] ) && 'open-popup' === $atts['image_action'] ) {
				wp_enqueue_style( 'magnific-popup' );
				wp_enqueue_script( 'jquery-magnific-popup' );
			}
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			if ( ! empty( $atts['navigation_inside'] ) && 'yes' === $atts['navigation_inside'] ) {
				$atts['unique'] = '';
			} else {
				$atts['unique'] = rand( 0, 1000 );
			}

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts, array( 'unique' => $atts['unique'] ) );
			$atts['images']         = $this->generate_images_params( $atts );

			return einar_core_get_template_part( 'shortcodes/image-gallery', 'templates/image-gallery', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-image-gallery';
			$holder_classes[] = ! empty( $atts['image_action'] ) && 'open-popup' === $atts['image_action'] ? 'qodef-magnific-popup qodef-popup-gallery' : '';

			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		private function get_holder_styles( $atts ) {
			$holder_styles = array();

			$list_styles   = $this->get_list_styles( $atts );
			$holder_styles = array_merge( $holder_styles, $list_styles );

			return $holder_styles;
		}

		public function get_item_classes( $atts ) {
			$item_classes   = $this->init_item_classes();
			$item_classes[] = 'qodef-image-wrapper';

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		private function generate_images_params( $atts ) {
			$image_ids = array();
			$images    = array();
			$i         = 0;

			if ( ! empty( $atts['images'] ) ) {
				$image_ids = explode( ',', $atts['images'] );
			}

			$image_size = $this->generate_image_size( $atts );

			foreach ( $image_ids as $id ) {
				if ( is_array( wp_get_attachment_image_src( $id ) ) ) {
					$image['image_id']   = intval( $id );
					$image_original      = wp_get_attachment_image_src( $id, 'full' );
					$image['url']        = $this->generate_image_url( $id, $atts, $image_original[0] );
					$image['alt']        = get_post_meta( $id, '_wp_attachment_image_alt', true );
					$image['image_size'] = $image_size;

					$images[ $i ] = $image;
					$i ++;
				}
			}

			return $images;
		}

		private function generate_image_size( $atts ) {
			$image_size = trim( $atts['image_size'] );
			preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
			if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ), true ) ) {
				return $image_size;
			} elseif ( ! empty( $matches[0] ) ) {
				return array(
					$matches[0][0],
					$matches[0][1],
				);
			} else {
				return 'full';
			}
		}

		private function generate_image_url( $id, $atts, $default ) {
			if ( 'custom-link' === $atts['image_action'] ) {
				$url = get_post_meta( $id, 'qodef_image_gallery_custom_link', true );
				if ( empty( $url ) ) {
					$url = $default;
				}
			} else {
				$url = $default;
			}

			return $url;
		}
	}
}
