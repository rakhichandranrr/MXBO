<?php

if ( ! function_exists( 'einar_core_add_video_holder_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_video_holder_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Video_Holder_Shortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_video_holder_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Video_Holder_Shortcode extends EinarCore_Shortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/video-holder' );
			$this->set_base( 'einar_core_video_holder' );
			$this->set_name( esc_html__( 'Video Holder', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds video holder element', 'einar-core' ) );
			$this->set_category( esc_html__( 'Marcello Core', 'einar-core' ) );
			$this->set_scripts(
				array(
					'jquery-appear' => array(
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
                    'field_type' => 'text',
                    'name'       => 'video_source',
                    'title'      => esc_html__( 'Link to Self Hosted Video', 'einar-core' ),
			    )
            );
			$this->set_option(
			    array(
                    'field_type'  => 'image',
                    'name'        => 'video_poster',
                    'title'       => esc_html__( 'Poster Image', 'einar-core' ),
                    'description' => esc_html__( 'Fallback poster image for the video', 'einar-core' ),
			    )
            );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_appear',
				'title'         => esc_html__( 'Enable Appear Animation', 'einar-core' ),
				'options'       => einar_core_get_select_type_options_pool( 'no_yes' ),
				'default_value' => 'no'
			) );
		}

        public static function call_shortcode( $params ) {
            $html = qode_framework_call_shortcode( 'einar_core_video_holder', $params );
            $html = str_replace( "\n", '', $html );

            return $html;
        }
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes']		= $this->get_holder_classes( $atts );

			return einar_core_get_template_part( 'shortcodes/video-holder', 'templates/video-holder', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-video-holder';
			$holder_classes[] = ! empty ( $atts['enable_appear'] ) && $atts['enable_appear'] == 'yes' ? 'qodef--has-appear' : '';
			
			return implode( ' ', $holder_classes );
		}
	}
}
