<?php

if ( ! function_exists( 'einar_core_add_clients_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_clients_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Clients_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_clients_list_shortcode' );
}

if ( class_exists( 'EinarCore_List_Shortcode' ) ) {
	class EinarCore_Clients_List_Shortcode extends EinarCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'clients' );
			$this->set_post_type_additional_taxonomies( array( 'clients-category' ) );
			$this->set_layouts( apply_filters( 'einar_core_filter_clients_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'einar_core_filter_clients_list_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'einar_core_filter_clients_list_hover_animation_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_CPT_URL_PATH . '/clients/shortcodes/clients-list' );
			$this->set_base( 'einar_core_clients_list' );
			$this->set_name( esc_html__( 'Clients List', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of clients', 'einar-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'einar-core' ),
				)
			);
			$this->map_list_options(
				array(
					'exclude_behavior' => array( 'masonry', 'justified-gallery' ),
					'exclude_option'   => array( 'images_proportion' ),
                    'include_columns'  => array(  7 => esc_html__('Seven', 'einar-core'), 8 => esc_html__('Eight', 'einar-core'),),
				)
			);
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options(
				array(
					'layouts'          => $this->get_layouts(),
					'hover_animations' => $this->get_hover_animation_options(),
					'exclude_option'   => array( 'title_tag', 'text_transform' ),
				)
			);
			$this->set_option(
				array(
					'name'        => 'retina_scaling',
					'field_type'  => 'select',
					'title'       => esc_html__( 'Enable Retina Scaling', 'einar-core' ),
					'options'     => einar_core_get_select_type_options_pool( 'no_yes', false ),
					'description' => esc_html__( 'Uploaded Client Images should be two times the size.', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'initial_opacity',
					'title'         => esc_html__( 'Initial Opacity', 'einar-core' ),
					'description'   => esc_html__( 'Enter value for initial image opacity. Value can be between 0 and 1', 'einar-core' ),
					'default_value' => '1',
					'dependency'    => array(
						'show' => array(
							'hover_animation_image-only' => array(
								'values'        => 'fade',
								'default_value' => '',
							),
						),
					),
					'group'         => esc_html__( 'Layout', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'hover_opacity',
					'title'         => esc_html__( 'Hover Opacity', 'einar-core' ),
					'description'   => esc_html__( 'Enter value for image opacity when hovered. Value can be between 0 and 1', 'einar-core' ),
					'default_value' => '.5',
					'dependency'    => array(
						'show' => array(
							'hover_animation_image-only' => array(
								'values'        => 'fade',
								'default_value' => '',
							),
						),
					),
					'group'         => esc_html__( 'Layout', 'einar-core' ),
				)
			);
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type'] = $this->get_post_type();

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['query_result']   = new WP_Query( einar_core_get_query_params( $atts ) );

			return einar_core_get_template_part( 'post-types/clients/shortcodes/clients-list', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-clients-list';
            //retina_scaling
            if( 'yes' === $atts['retina_scaling'] ) {
                $holder_classes[] = 'qodef-clients-list-enable-retina-scale';
            }
			$list_classes            = $this->get_list_classes( $atts );
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );
			$holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes );

			return implode( ' ', $holder_classes );
		}

		private function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		private function get_holder_styles( $atts ) {
			$holder_styles = array();

			if ( ! empty( $atts['initial_opacity'] ) ) {
				$styles[] = '--qodef-client-initial-opacity: ' . min( $atts['initial_opacity'], 1 );
			}

			if ( ! empty( $atts['hover_opacity'] ) ) {
				$styles[] = '--qodef-client-hover-opacity: ' . min( $atts['hover_opacity'], 1 );
			}

			$list_styles   = $this->get_list_styles( $atts );
			$holder_styles = array_merge( $holder_styles, $list_styles );

			return $holder_styles;
		}
	}
}
