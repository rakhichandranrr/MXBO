<?php

if ( ! function_exists( 'einar_core_add_portfolio_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Portfolio_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_portfolio_list_shortcode' );
}

if ( class_exists( 'EinarCore_List_Shortcode' ) ) {
	class EinarCore_Portfolio_List_Shortcode extends EinarCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );
			$this->set_layouts( apply_filters( 'einar_core_filter_portfolio_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'einar_core_filter_portfolio_list_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'einar_core_filter_portfolio_list_hover_animation_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-list' );
			$this->set_base( 'einar_core_portfolio_list' );
			$this->set_name( esc_html__( 'Portfolio List', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of portfolios', 'einar-core' ) );
			$this->set_scripts( apply_filters( 'einar_core_filter_portfolio_list_register_assets', array() ) );
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
					'field_type'    => 'select',
					'name'          => 'skin',
					'title'         => esc_html__( 'Skin', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'header_skin', true, array( 'none' ) ),
					'default_value' => '',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'hide_categories',
					'title'         => esc_html__( 'Hide Categories', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'yes_no', true, array( 'none' ) ),
					'default_value' => '',
					'group'         => esc_html__( 'Layout', 'einar-core' ),
				)
			);
			$this->map_list_options(
				array(
					'include_slider_option' => array(
						'slider_drag_cursor',
						'indent_slider',
						'slider_mousewheel_navigation',
					),
				)
			);
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options(
				array(
					'layouts'                 => $this->get_layouts(),
					'hover_animations'        => $this->get_hover_animation_options(),
					'default_value_title_tag' => 'h5',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'custom_margin',
					'title'         => esc_html__( 'Use Item Custom Margin', 'einar-core' ),
					'description'   => esc_html__( 'If you set this option to “Yes”, the margin values defined in the Portfolio Item Custom Margin field will be applied', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => array( 'columns', 'masonry' ),
								'default_value' => 'columns',
							),
						),
					),
					'group'         => esc_html__( 'Layout', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'enable_appear',
					'title'      => esc_html__( 'Enable Appear', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'yes_no', false ),
					'dependency'    => array(
						'hide' => array(
							'behavior' => array(
								'values'        => array( 'slider' ),
								'default_value' => 'columns',
							),
						),
					),
				)
			);
            $this->set_option(
                array(
                    'field_type' => 'select',
                    'name'       => 'enable_mobile_link',
                    'title'      => esc_html__( 'Enable Link Instead Of Ligthbox On Mobile', 'einar-core' ),
                    'options'    => einar_core_get_select_type_options_pool( 'yes_no', true ),
                    'dependency'    => array(
                        'show' => array(
                            'layout' => array(
                                'values'        => 'info-on-hover',
                                'default_value' => '',
                            ),
                        ),
                    ),
                    'group'         => esc_html__( 'Layout', 'einar-core' ),
                )
            );
			$this->map_additional_options();
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'einar_core_portfolio_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			parent::load_assets();

			do_action( 'einar_core_action_portfolio_list_load_assets', $this->get_atts() );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_filter_taxonomy( $atts );

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['query_result']   = new WP_Query( einar_core_get_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['data_attr']      = einar_core_get_pagination_data( EINAR_CORE_REL_PATH, 'post-types/portfolio/shortcodes', 'portfolio-list', 'portfolio', $atts );
			$atts['glass_effect'] = isset($atts['hover_animation_' . $atts['layout']]) && ('glass-effect' === $atts['hover_animation_' . $atts['layout']]) ? 'yes' : 'no';

			$atts['this_shortcode'] = $this;

			return einar_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			if ( 'yes' === $atts['hide_categories'] ) {
				$holder_classes[] = 'qodef-portfolio-list-hide-categories';
			}

            $holder_classes[] = ( 'yes' === $atts['enable_mobile_link'] ) ? 'qodef--link-on-mobile' : '';

			$list_classes            = $this->get_list_classes( $atts );
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );
			$holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes );

			return implode( ' ', $holder_classes );
		}

		private function get_holder_styles( $atts ) {
			$holder_styles = array();

			$list_styles   = $this->get_list_styles( $atts );
			$holder_styles = array_merge( $holder_styles, $list_styles );

			return $holder_styles;
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$list_item_classes   = $this->get_list_item_classes( $atts );
			$list_item_classes[] = ( 'yes' === $atts['enable_appear'] ) ? 'qodef--has-appear' : '';

			if ( isset( $atts['custom_margin'] ) && 'yes' === $atts['custom_margin'] ) {
				$list_item_classes[] = 'qodef-custom-margin';
			}

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			return $styles;
		}

		public function get_list_item_style( $atts ) {
			$styles = array();

			if ( isset( $atts['custom_margin'] ) && 'yes' === $atts['custom_margin'] ) {
				$margin = get_post_meta( get_the_ID(), 'qodef_portfolio_item_padding', true );

				if ( isset( $margin ) && '' !== $margin ) {
					$styles[] = 'margin: ' . get_post_meta( get_the_ID(), 'qodef_portfolio_item_padding', true );
				}
			}

			return $styles;
		}
	}
}
