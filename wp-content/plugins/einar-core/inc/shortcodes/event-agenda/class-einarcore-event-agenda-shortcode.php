<?php

if ( ! function_exists( 'einar_core_add_event_agenda_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_event_agenda_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Event_Agenda_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_event_agenda_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Event_Agenda_Shortcode extends EinarCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'einar_core_filter_event_agenda_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'einar_core_filter_event_agenda_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/event-agenda' );
			$this->set_base( 'einar_core_event_agenda' );
			$this->set_name( esc_html__( 'Event Agenda', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds event agenda element', 'einar-core' ) );
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
					'field_type'    => 'select',
					'name'          => 'link_target',
					'title'         => esc_html__( 'Link Target', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'heading_one',
					'title'         => esc_html__( 'Heading One', 'einar-core' ),
					'default_value' => esc_html__( 'Monday 23', 'einar-core' ),
					'group'         => esc_html__( 'Table Headings', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'heading_two',
					'title'         => esc_html__( 'Heading Two', 'einar-core' ),
					'default_value' => esc_html__( 'Time', 'einar-core' ),
					'group'         => esc_html__( 'Table Headings', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'heading_three',
					'title'         => esc_html__( 'Heading Three', 'einar-core' ),
					'default_value' => esc_html__( 'Location', 'einar-core' ),
					'group'         => esc_html__( 'Table Headings', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'heading_four',
					'title'         => esc_html__( 'Heading Four', 'einar-core' ),
					'default_value' => esc_html__( 'Speaker', 'einar-core' ),
					'group'         => esc_html__( 'Table Headings', 'einar-core' ),
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
							'name'       => 'time',
							'title'      => esc_html__( 'Time', 'einar-core' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'location',
							'title'      => esc_html__( 'Location', 'einar-core' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'speaker',
							'title'      => esc_html__( 'Speaker', 'einar-core' ),
						),
						array(
							'field_type'    => 'text',
							'name'          => 'link',
							'title'         => esc_html__( 'Link', 'einar-core' ),
							'default_value' => '',
						),
					),
				)
			);
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'einar_core_event_agenda', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['unique_class']   = 'qodef-event-agenda-' . rand( 0, 1000 );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['this_shortcode'] = $this;

			return einar_core_get_template_part( 'shortcodes/event-agenda', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-event-agenda';
			$holder_classes[] = $atts['unique_class'];
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}
