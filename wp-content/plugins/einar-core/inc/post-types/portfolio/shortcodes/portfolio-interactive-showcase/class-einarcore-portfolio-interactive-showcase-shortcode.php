<?php

if ( ! function_exists( 'einar_core_add_portfolio_interactive_showcase_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_interactive_showcase_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Portfolio_Interactive_Showcase_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_portfolio_interactive_showcase_shortcode' );
}

if ( class_exists( 'EinarCore_List_Shortcode' ) ) {
	class EinarCore_Portfolio_Interactive_Showcase_Shortcode extends EinarCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );
			$this->set_layouts( apply_filters( 'einar_core_filter_portfolio_interactive_showcase_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'einar_core_filter_portfolio_interactive_showcase_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'einar_core_filter_portfolio_interactive_showcase_hover_animation_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-interactive-showcase' );
			$this->set_base( 'einar_core_portfolio_interactive_showcase' );
			$this->set_name( esc_html__( 'Portfolio Interactive Showcase', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of portfolios', 'einar-core' ) );
			$this->set_scripts( apply_filters( 'einar_core_filter_portfolio_interactive_showcase_register_assets', array() ) );
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
					'field_type'    => 'text',
					'name'          => 'read_more_text',
					'title'         => esc_html__( 'Read More Text', 'einar-core' ),
					'default_value' => esc_html__( 'Contact us for collab', 'einar-core' ),
					'group'         => esc_html__( 'Layout', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'read_more_link',
					'title'         => esc_html__( 'Read More Link', 'einar-core' ),
					'default_value' => '',
					'group'         => esc_html__( 'Layout', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'read_more_target',
					'title'         => esc_html__( 'Read More Target', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
					'group'         => esc_html__( 'Layout', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'textarea',
					'name'        => 'fixed_text_one',
					'title'       => esc_html__( 'Fixed Text One', 'einar-core' ),
					'description' => esc_html__( 'HTML tags for post content are allowed.', 'einar-core' ),
					'group'       => esc_html__( 'Layout', 'einar-core' ),
					'dependency'  => array(
						'show' => array(
							'layout' => array(
								'values'        => array( 'slider' ),
								'default_value' => 'interactive-list',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'textarea',
					'name'        => 'fixed_text_two',
					'title'       => esc_html__( 'Fixed Text Two', 'einar-core' ),
					'description' => esc_html__( 'HTML tags for post content are allowed.', 'einar-core' ),
					'group'       => esc_html__( 'Layout', 'einar-core' ),
					'dependency'  => array(
						'show' => array(
							'layout' => array(
								'values'        => array( 'slider' ),
								'default_value' => 'interactive-list',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'fixed_text_two_link',
					'title'      => esc_html__( 'Fixed Text Two Link', 'einar-core' ),
					'group'      => esc_html__( 'Layout', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'layout' => array(
								'values'        => array( 'slider' ),
								'default_value' => 'interactive-list',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'fixed_text_two_target',
					'title'         => esc_html__( 'Fixed Text Two Target', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
					'group'         => esc_html__( 'Layout', 'einar-core' ),
					'dependency'    => array(
						'show' => array(
							'layout' => array(
								'values'        => array( 'slider' ),
								'default_value' => 'interactive-list',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'background_color',
					'title'      => esc_html__( 'Background Color', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'layout' => array(
								'values'        => 'interactive-list',
								'default_value' => 'interactive-list',
							),
						),
					),
				)
			);
			$this->map_additional_options(
				array(
					'exclude_filter'     => true,
					'exclude_pagination' => true,
				)
			);
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'einar_core_portfolio_interactive_showcase', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			parent::load_assets();

			do_action( 'einar_core_action_portfolio_interactive_showcase_load_assets', $this->get_atts() );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_filter_taxonomy( $atts );
			$atts['styles']          = $this->get_styles( $atts );

			// force atts
			$atts['behavior']           = 'columns';
			$atts['space']              = 'no'; // spacing inherited from widgets map
			$atts['images_proportion']  = 'full';
			$atts['columns']            = 1;
			$atts['columns_responsive'] = 'predefined';

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['query_result']   = new \WP_Query( einar_core_get_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['data_attr']      = einar_core_get_pagination_data( EINAR_CORE_REL_PATH, 'post-types/portfolio/shortcodes', 'portfolio-interactive-showcase', 'portfolio', $atts );

			$atts['this_shortcode'] = $this;

			if ( 'slider' === $atts['layout'] ) {
				$atts['behavior']  = 'slider';
				$atts['title_tag'] = 'h2';
			}

			return einar_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-interactive-showcase';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			$list_classes            = $this->get_list_classes( $atts );
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );
			$holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$list_item_classes = $this->get_list_item_classes( $atts );

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

			return $styles;
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
