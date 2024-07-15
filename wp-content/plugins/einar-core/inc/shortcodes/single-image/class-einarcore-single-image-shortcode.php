<?php

if ( ! function_exists( 'einar_core_add_single_image_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function einar_core_add_single_image_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Single_Image_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_single_image_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Single_Image_Shortcode extends EinarCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'einar_core_filter_single_image_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'einar_core_filter_single_image_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/single-image' );
			$this->set_base( 'einar_core_single_image' );
			$this->set_name( esc_html__( 'Single Image', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image element', 'einar-core' ) );
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
					'field_type' => 'image',
					'name'       => 'image',
					'title'      => esc_html__( 'Image', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'retina_scaling',
					'title'         => esc_html__( 'Enable Retina Scaling', 'einar-core' ),
					'description'   => esc_html__( 'Image uploaded should be two times the height.', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => '',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'images_proportion',
					'default_value' => 'full',
					'title'         => esc_html__( 'Image Proportions', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'list_image_dimension', false ),
					'dependency'    => array(
						'hide' => array(
							'retina_scaling' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'custom_image_width',
					'title'       => esc_html__( 'Custom Image Width', 'einar-core' ),
					'description' => esc_html__( 'Enter image width in px', 'einar-core' ),
					'dependency'  => array(
						'show' => array(
							'images_proportion' => array(
								'values'        => 'custom',
								'default_value' => 'full',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'custom_image_height',
					'title'       => esc_html__( 'Custom Image Height', 'einar-core' ),
					'description' => esc_html__( 'Enter image height in px', 'einar-core' ),
					'dependency'  => array(
						'show' => array(
							'images_proportion' => array(
								'values'        => 'custom',
								'default_value' => 'full',
							),
						),
					),
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
					'field_type' => 'text',
					'name'       => 'link',
					'title'      => esc_html__( 'Custom Link', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'image_action' => array(
								'values'        => array( 'custom-link' ),
								'default_value' => '',
							),
						),
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

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'offset_movement',
					'title'         => esc_html__( 'Enable Offset Movement', 'einar-core' ),
					'options' => array(
						''       => esc_html__( 'No', 'einar-core' ),
						'scroll' => esc_html__( 'Scroll', 'einar-core' ),
						'cursor' => esc_html__( 'Cursor', 'einar-core' ),
					),
					'default_value' => '',
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
					'field_type' => 'color',
					'name'       => 'background_color',
					'title'      => esc_html__( 'Appear Background Color', 'einar-core' ),
					'dependency'    => array(
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
			$html = qode_framework_call_shortcode( 'einar_core_single_image', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {

			if ( isset( $atts['image_action'] ) && 'open-popup' === $atts['image_action'] ) {
				wp_enqueue_style( 'magnific-popup' );
				wp_enqueue_script( 'jquery-magnific-popup' );
			}
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['styles']         = $this->get_styles( $atts );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			return einar_core_get_template_part( 'shortcodes/single-image', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-single-image';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['offset_movement'] ) ? 'qodef-' . $atts['offset_movement'] . '-item' : '';
			$holder_classes[] = ( 'yes' === $atts['retina_scaling'] ) ? 'qodef--retina' : '';
			$holder_classes[] = ( 'yes' === $atts['enable_appear'] ) ? 'qodef--has-appear' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['background_color'] ) ) {
				$styles[] = '--qode-bg-color: ' . $atts['background_color'];
			}

			return $styles;
		}
	}
}
