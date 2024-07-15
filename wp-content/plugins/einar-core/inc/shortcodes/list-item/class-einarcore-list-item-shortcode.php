<?php

if ( ! function_exists( 'einar_core_add_list_item_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_list_item_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCoreListItemShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_list_item_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCoreListItemShortcode extends EinarCore_Shortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'einar_core_filter_list_item_layouts', array() ) );
			
			$options_map = einar_core_get_variations_options_map( $this->get_layouts() );
			$default_value = $options_map['default_value'];
			
			$this->set_extra_options( apply_filters( 'einar_core_filter_list_item_extra_options', array(), $default_value ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/list-item' );
			$this->set_base( 'einar_core_list_item' );
			$this->set_name( esc_html__( 'List Item', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds list item element', 'einar-core' ) );
			$this->set_category( esc_html__( 'Einar Core', 'einar-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'einar-core' ),
			) );
			
			$options_map = einar_core_get_variations_options_map( $this->get_layouts() );
			
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'einar-core' ),
				'options'		=> $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'link',
				'title'         => esc_html__( 'Link', 'einar-core' ),
				'default_value' => ''
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Link Target', 'einar-core' ),
				'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
            $this->set_option(
                array(
                    'field_type'  => 'text',
                    'name'        => 'line_break_positions',
                    'title'       => esc_html__( 'Positions of Line Break', 'einar-core' ),
                    'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'einar-core' ),
                    'group'       => esc_html__( 'Content', 'einar-core' ),
                )
            );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'number',
                'title'      => esc_html__( 'Number', 'einar-core' ),
                'group'      => esc_html__( 'Content', 'einar-core' )
            ) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'number_font_size',
                'title'      => esc_html__( 'Number Font Size (px or em)', 'einar-core' ),
                'group'      => esc_html__( 'Content', 'einar-core' )
            ) );
            $this->set_option( array(
                'field_type' => 'color',
                'name'       => 'number_color',
                'title'      => esc_html__( 'Number Color', 'einar-core' ),
                'group'      => esc_html__( 'Content', 'einar-core' )
            ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'einar-core' ),
				'group'      => esc_html__( 'Content', 'einar-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'einar-core' ),
				'options'       => einar_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'p',
				'group'         => esc_html__( 'Content', 'einar-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'einar-core' ),
				'group'      => esc_html__( 'Content', 'einar-core' )
			) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'title_line_height',
                'title'      => esc_html__( 'Title Line Height', 'einar-core' ),
                'group'      => esc_html__( 'Content', 'einar-core' )
            ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_margin_top',
				'title'      => esc_html__( 'Title Margin Top', 'einar-core' ),
				'group'      => esc_html__( 'Content', 'einar-core' )
			) );
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'skin',
					'title'      => esc_html__( 'Skin', 'einar-core' ),
					'options'    => array(
						''      => esc_html__( 'Default', 'einar-core' ),
						'dark' => esc_html__( 'Dark', 'einar-core' ),
					),
					'group'      => esc_html__( 'Content', 'einar-core' )
				)
			);
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_appear',
				'title'         => esc_html__( 'Appear Animation', 'einar-core' ),
				'options'       => einar_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no'
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
            $atts['title']          = $this->get_modified_title( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['number_styles']  = $this->get_number_styles( $atts );
			$atts['animation_data'] = $this->get_animation_data( $atts );
			
			return einar_core_get_template_part( 'shortcodes/list-item', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-list-item';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty ( $atts['enable_appear'] ) && $atts['enable_appear'] == 'yes' ? 'qodef--has-appear qodef--splitting' : '';
			$holder_classes[] = ! empty ( $atts['enable_decoration'] ) && $atts['enable_decoration'] == 'yes' ? 'qodef--has-decoration' : '';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-list-item--' . $atts['skin'] : '';
			
			$holder_classes = apply_filters( 'einar_core_filter_list_item_variation_classes', $holder_classes, $atts );
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_animation_data( $atts ) {
			$animation_data = array();
			
			$animation_data[] = ( ! empty ( $atts['enable_appear'] ) && $atts['enable_appear'] == 'yes') ? 'data-splitting' : '';
			
			return implode( ' ', $animation_data );
		}

        private function get_modified_title( $atts ) {
            $title = $atts['title'];

            if ( ! empty( $title ) && ! empty( $atts['line_break_positions'] ) ) {
                $split_title          = explode( ' ', $title );
                $line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

                foreach ( $line_break_positions as $position ) {
                    $position = intval( $position );
                    if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
                        $split_title[ $position - 1 ] = $split_title[ $position - 1 ] . '<br />';
                    }
                }

                $title = implode( ' ', $split_title );
            }

            return $title;
        }

		private function get_title_styles( $atts ) {
			$styles = array();

            if ( $atts['title_line_height'] !== '' ) {
                if ( qode_framework_string_ends_with_space_units( $atts['title_line_height'] ) ) {
                    $styles[] = 'line-height: ' . $atts['title_line_height'];
                } else {
                    $styles[] = 'line-height: ' . intval( $atts['title_line_height'] ) . 'px';
                }
            }
			
			if ( $atts['title_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}
			
			return $styles;
		}

        private function get_number_styles( $atts ) {
            $styles = array();


            if ( ! empty( $atts['number_font_size'] ) ) {
                $styles[] = 'font-size: ' . $atts['number_font_size'];
            }

            if ( ! empty( $atts['number_color'] ) ) {
                $styles[] = 'color: ' . $atts['number_color'];
            }

            return $styles;
        }
	}
}
