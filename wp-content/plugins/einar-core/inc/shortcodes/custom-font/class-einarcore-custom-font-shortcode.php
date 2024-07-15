<?php

if ( ! function_exists( 'einar_core_add_custom_font_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function einar_core_add_custom_font_shortcode( $shortcodes ) {
		$shortcodes[] = 'EinarCore_Custom_Font_Shortcode';

		return $shortcodes;
	}

	add_filter( 'einar_core_filter_register_shortcodes', 'einar_core_add_custom_font_shortcode' );
}

if ( class_exists( 'EinarCore_Shortcode' ) ) {
	class EinarCore_Custom_Font_Shortcode extends EinarCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'einar_core_filter_custom_font_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EINAR_CORE_SHORTCODES_URL_PATH . '/custom-font' );
			$this->set_base( 'einar_core_custom_font' );
			$this->set_name( esc_html__( 'Custom Font', 'einar-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays custom font with provided parameters', 'einar-core' ) );

			$options_map = einar_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'layout',
					'title'         => esc_html__( 'Layout', 'einar-core' ),
					'options'       => $this->get_layouts(),
					'default_value' => $options_map['default_value'],
					'visibility'    => array(
						'map_for_page_builder' => $options_map['visibility'],
						'map_for_widget'       => $options_map['visibility'],
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
					'field_type'    => 'textarea',
					'name'          => 'title',
					'title'         => esc_html__( 'Title Text', 'einar-core' ),
					'default_value' => esc_html__( 'Custom Title Text', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'link',
					'title'      => esc_html__( 'Link', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'target',
					'title'         => esc_html__( 'Target', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_break_positions',
					'title'       => esc_html__( 'Positions of Line Break', 'einar-core' ),
					'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'einar-core' ),
					'group'       => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_end_decoration',
					'title'         => esc_html__( 'Title End Decoration', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'decoration_shape',
					'title'         => esc_html__( 'Decoration Shape', 'einar-core' ),
					'options'       => array(
						'arrow'         => esc_html__( 'Arrow', 'einar-core' ),
						'circle'        => esc_html__( 'Animated Circle', 'einar-core' ),
						'circle-static' => esc_html__( 'Static Circle', 'einar-core' ),
					),
					'default_value' => 'arrow',
					'dependency'    => array(
						'show' => array(
							'title_end_decoration' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
					'group'         => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'color_decoration',
					'title'      => esc_html__( 'Decoration Color', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'decoration_margin',
					'title'      => esc_html__( 'Decoration Margin', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'decoration_width',
					'title'      => esc_html__( 'Decoration Width', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'p',
					'group'         => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'color',
					'title'      => esc_html__( 'Color', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'font_family',
					'title'      => esc_html__( 'Font Family', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'font_size',
					'title'      => esc_html__( 'Font Size', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'line_height',
					'title'      => esc_html__( 'Line Height', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'font_weight',
					'title'      => esc_html__( 'Font Weight', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'font_weight' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'font_style',
					'title'      => esc_html__( 'Font Style', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'font_style' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'text_transform',
					'title'      => esc_html__( 'Text Transform', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'text_transform' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'text_center',
					'title'      => esc_html__( 'Text Alignment', 'einar-core' ),
					'options'    => array(
						''       => esc_html__( 'Default', 'einar-core' ),
						'left'   => esc_html__( 'Left', 'einar-core' ),
						'right'  => esc_html__( 'Right', 'einar-core' ),
						'center' => esc_html__( 'Center', 'einar-core' ),
					),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'margin',
					'title'      => esc_html__( 'Margin', 'einar-core' ),
					'group'      => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'enable_appear',
					'title'      => esc_html__( 'Enable Appear', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'no_yes', false ),
					'dependency' => array(
						'hide' => array(
							'type_out_effect' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'type_out_effect',
					'title'         => esc_html__( 'Enable Type Out Effect', 'einar-core' ),
					'options'       => array(
						'no'             => esc_html__( 'No', 'einar-core' ),
						'yes'            => esc_html__( 'Yes', 'einar-core' ),
						'highlight-text' => esc_html__( 'Highlight Text', 'einar-core' ),
					),
					'default_value' => 'no',
					'description'   => esc_html__( 'Adds a type out effect inside custom font content', 'einar-core' ),
					'group'         => esc_html__( 'Typography', 'einar-core' )
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'type_out_position',
					'title'       => esc_html__( 'Position of Type Out Effect', 'einar-core' ),
					'description' => esc_html__( 'Enter the position of the word after which you would like to display type out effect (e.g. if you would like the type out effect after the 3rd word, you would enter "3")', 'einar-core' ),
					'dependency'  => array(
						'show' => array(
							'type_out_effect' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					),
					'group'       => esc_html__( 'Typography', 'einar-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'typed_color',
					'title'      => esc_html__( 'Typed Color', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'type_out_effect' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					),
					'group'      => esc_html__( 'Typography', 'einar-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'typed_ending_1',
					'title'      => esc_html__( 'Typed Ending Number 1', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'type_out_effect' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					),
					'group'      => esc_html__( 'Typography', 'einar-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'typed_ending_2',
					'title'      => esc_html__( 'Typed Ending Number 2', 'einar-core' ),
					'dependency' => array(
						'hide' => array(
							'typed_ending_1' => array(
								'values' => ''
							)
						)
					),
					'group'      => esc_html__( 'Typography', 'einar-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'typed_ending_3',
					'title'      => esc_html__( 'Typed Ending Number 3', 'einar-core' ),
					'dependency' => array(
						'hide' => array(
							'typed_ending_2' => array(
								'values' => ''
							)
						)
					),
					'group'      => esc_html__( 'Typography', 'einar-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'typed_ending_4',
					'title'      => esc_html__( 'Typed Ending Number 4', 'einar-core' ),
					'dependency' => array(
						'hide' => array(
							'typed_ending_3' => array(
								'values' => ''
							)
						)
					),
					'group'      => esc_html__( 'Typography', 'einar-core' )
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_break_word',
					'title'         => esc_html__( 'Break Word Before Type Out Effect', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'type_out_effect' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					),
					'group'         => esc_html__( 'Typography', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'disable_break_word',
					'title'         => esc_html__( 'Disable Line Break for Smaller Screens', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'type_out_effect' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					),
					'group'         => esc_html__( 'Typography', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'disable_title_break_words',
					'title'         => esc_html__( 'Disable Text Line Break', 'einar-core' ),
					'description'   => esc_html__( 'Enabling this option will disable text line breaks for screen size 1024 and lower', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'highlight_position',
					'title'       => esc_html__( 'Highlight Text Position', 'einar-core' ),
					'description' => esc_html__( 'Enter the positions of the words you would like to display as "highlight" text. Separate start and end positions with commas (e.g. if you would like to wrap from fifth to ninth words, you would enter "5,9") or if you want to highlight whole text fill -1', 'einar-core' ),
					'dependency'  => array(
						'show' => array(
							'type_out_effect' => array(
								'values' => 'highlight-text'
							)
						)
					),
					'group'       => esc_html__( 'Typography', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'highlight_color',
					'title'      => esc_html__( 'Highlight Text Color', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'type_out_effect' => array(
								'values' => 'highlight-text'
							)
						)
					),
					'group'      => esc_html__( 'Typography', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'highlight_background_color',
					'title'      => esc_html__( 'Highlight Text Background Color', 'einar-core' ),
					'dependency' => array(
						'show' => array(
							'type_out_effect' => array(
								'values' => 'highlight-text'
							)
						)
					),
					'group'      => esc_html__( 'Typography', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_1680',
					'title'       => esc_html__( 'Font Size', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1680', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1680 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_1680',
					'title'       => esc_html__( 'Line Height', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1680', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1680 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_1680',
					'title'       => esc_html__( 'Letter Spacing', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1680', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1680 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_1512',
					'title'       => esc_html__( 'Font Size', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1512', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1512 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_1512',
					'title'       => esc_html__( 'Line Height', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1512', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1512 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_1512',
					'title'       => esc_html__( 'Letter Spacing', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1512', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1512 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_1368',
					'title'       => esc_html__( 'Font Size', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1368', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1368 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_1368',
					'title'       => esc_html__( 'Line Height', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1368', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1368 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_1368',
					'title'       => esc_html__( 'Letter Spacing', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1368', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1368 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_1200',
					'title'       => esc_html__( 'Font Size', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1200', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1200 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_1200',
					'title'       => esc_html__( 'Line Height', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1200', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1200 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_1200',
					'title'       => esc_html__( 'Letter Spacing', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1200', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1200 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_1024',
					'title'       => esc_html__( 'Font Size', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1024', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1024 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_1024',
					'title'       => esc_html__( 'Line Height', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1024', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1024 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_1024',
					'title'       => esc_html__( 'Letter Spacing', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1024', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 1024 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_880',
					'title'       => esc_html__( 'Font Size', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 880', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 880 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_880',
					'title'       => esc_html__( 'Line Height', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 880', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 880 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_880',
					'title'       => esc_html__( 'Letter Spacing', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 880', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 880 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_680',
					'title'       => esc_html__( 'Font Size', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 680', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 680 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_680',
					'title'       => esc_html__( 'Line Height', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 680', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 680 Style', 'einar-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_680',
					'title'       => esc_html__( 'Letter Spacing', 'einar-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 680', 'einar-core' ),
					'group'       => esc_html__( 'Screen Size 680 Style', 'einar-core' ),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'einar_core_custom_font', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['unique_class']      = 'qodef-custom-font-' . rand( 0, 1000 );
			$atts['holder_classes']    = $this->get_holder_classes( $atts );
			$atts['title']             = $this->get_modified_title( $atts );
			$atts['holder_styles']     = $this->get_holder_styles( $atts );
			$atts['decoration_styles'] = $this->get_decoration_styles( $atts );

			$this->set_responsive_styles( $atts );

			return einar_core_get_template_part( 'shortcodes/custom-font', 'variations/' . $atts['layout'] . '/templates/custom-font', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-custom-font';
			$holder_classes[] = $atts['unique_class'];
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = $atts['type_out_effect'] === 'yes' ? 'qodef-cf-has-type-out' : '';
			$holder_classes[] = $atts['disable_break_word'] === 'yes' ? 'qodef-disable-title-break' : '';
            $holder_classes[] = ! empty( $atts['decoration_width'] ) ? 'qodef-custom-widht-shape': '';
			$holder_classes[] = 'yes' === $atts['disable_title_break_words'] ? 'qodef-title-break--disabled' : '';
			$holder_classes[] = ! empty( $atts['text_center'] ) ? 'qodef-alignment--' . $atts['text_center'] : '';
			$holder_classes[] = ! empty( $atts['decoration_shape'] ) ? 'qodef-decoration--' . $atts['decoration_shape'] : '';
			$holder_classes[] = ( 'yes' === $atts['enable_appear'] ) ? 'qodef--has-appear' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_modified_title( $atts ) {
			$title             = $atts['title'];
			$type_out_effect   = $atts['type_out_effect'];
			$title_break_word  = $atts['title_break_word'];

			if( empty($atts['type_out_position'])) {
                $atts['type_out_position'] = '';
            }

			$type_out_position = str_replace( ' ', '', $atts['type_out_position'] );

			if ( ! empty( $title ) && ( $type_out_effect === 'no' ) && ! empty( $atts['line_break_positions'] ) ) {
				$split_title          = explode( ' ', $title );
				$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

				foreach ( $line_break_positions as $position ) {
					$position = intval( $position );
					if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
						$split_title[ $position - 1 ] = $split_title[ $position - 1 ] . '<br />';
					}
				}

				$title = implode( ' ', $split_title );
			} else if ( ! empty( $title ) && ( $type_out_effect === 'yes' ) ) {
				$split_title = explode( ' ', $title );

				if ( $type_out_effect === 'yes' && ! empty( $type_out_position ) ) {
					$typed_styles = $this->get_typed_styles( $atts );
					$data         = array();

					if ( isset( $atts['typed_ending_1'] ) && ! empty( $atts['typed_ending_1'] ) ) {
						$data[] = $atts['typed_ending_1'];
					}
					if ( isset( $atts['typed_ending_2'] ) && ! empty( $atts['typed_ending_2'] ) ) {
						$data[] = $atts['typed_ending_2'];
					}
					if ( isset( $atts['typed_ending_3'] ) && ! empty( $atts['typed_ending_3'] ) ) {
						$data[] = $atts['typed_ending_3'];
					}

					$typed_html = '<span class="qodef-cf-typed-wrap" ' . qode_framework_get_inline_attr( json_encode( $data ), 'data-strings', ' ' ) . qode_framework_get_inline_style( $typed_styles ) . '><span class="qodef-cf-typed">';
					$typed_html .= '</span></span>';

					if ( ! empty( $split_title[ $type_out_position - 1 ] ) && $title_break_word === 'yes' ) {
						$split_title[ $type_out_position - 1 ] = $split_title[ $type_out_position - 1 ] . '<br/>' . $typed_html;
					} else {
						$split_title[ $type_out_position - 1 ] = $split_title[ $type_out_position - 1 ] . ' ' . $typed_html;
					}
				}

				$title = implode( ' ', $split_title );

			} else if ( ! empty( $title ) && ( $type_out_effect === 'highlight-text' ) ) {

				if ( ! empty( $title ) && ! empty( $atts['highlight_position'] ) ) {

					$highlight_styles   = $this->get_highlight_styles( $atts );
					$highlight_position = $atts['highlight_position'];
					$text_prefix        = '<span class="qodef-highlight-text" ' . qode_framework_get_inline_style( $highlight_styles ) . '>';
					$text_suffix        = '</span>';
					$text_break         = '<br>';

					if ( '-1' === $highlight_position ) {

						if ( ! empty( $atts['line_break_positions'] ) ) {
							$split_title          = explode( ' ', $title );
							$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

							foreach ( $line_break_positions as $position ) {
								$position = intval( $position );
								if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
									$split_title[ $position - 1 ] = $split_title[ $position - 1 ] . $text_break;
								}
							}

							$title = implode( ' ', $split_title );
						}

						$title = $text_prefix . $title . $text_suffix;
					} else {
						$split_text           = explode( ' ', $title );
						$highlight_position   = explode( ',', str_replace( ' ', '', $atts['highlight_position'] ) );
						$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );
						$positions            = array_filter(
							array(
								'start' => isset( $highlight_position[0] ) ? $highlight_position[0] : '',
								'end'   => isset( $highlight_position[1] ) ? $highlight_position[1] : '',
							)
						);
						$positions            = array_merge( $positions, $line_break_positions );
						asort( $positions );

						if ( ! empty( $positions ) ) {
							foreach ( $positions as $key => $value ) {
								$text_prefix_html = 'start' === $key ? $text_prefix : '';
								$text_suffix_html = 'end' === $key ? $text_suffix : '';
								$text_break_html  = in_array( $value, $line_break_positions, true ) && 'start' !== $key && 'end' !== $key ? $text_break : '';

								if ( isset( $split_text[ intval( $value ) - 1 ] ) && ! empty( $split_text[ intval( $value ) - 1 ] ) ) {
									$split_text[ $value - 1 ] = $text_prefix_html . $split_text[ $value - 1 ] . $text_suffix_html . $text_break_html;
								}
							}

							$title = implode( ' ', $split_text );
						}
					}
				} else {
					$text_break = '<br>';
					if ( ! empty( $atts['line_break_positions'] ) ) {
						$split_title          = explode( ' ', $title );
						$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

						foreach ( $line_break_positions as $position ) {
							$position = intval( $position );
							if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
								$split_title[ $position - 1 ] = $split_title[ $position - 1 ] . $text_break;
							}
						}

						$title = implode( ' ', $split_title );
					}
				}
			}

			return $title;
		}

		private function get_typed_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['typed_color'] ) ) {
				$styles[] = 'color: ' . $atts['typed_color'];
			}

			return implode( ';', $styles );
		}

		private function get_decoration_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['color_decoration'] ) ) {
				$styles[] = 'color: ' . $atts['color_decoration'];
			}

			if ( ! empty( $atts['decoration_margin'] ) ) {
				$styles[] = 'margin: ' . $atts['decoration_margin'];
			}
			if ( ! empty( $atts['decoration_width'] ) ) {
				$styles[] = 'width: ' . $atts['decoration_width'];
			}

			return implode( ';', $styles );
		}

		private function get_highlight_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['highlight_color'] ) ) {
				$styles[] = 'color: ' . $atts['highlight_color'];
			}

			if ( ! empty( $atts['highlight_background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['highlight_background_color'];
			}

			return $styles;
		}

		private function get_holder_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['color'] ) ) {
				$styles[] = 'color: ' . $atts['color'];
			}

			if ( ! empty( $atts['font_family'] ) ) {
				$styles[] = 'font-family: ' . $atts['font_family'];
			}

			$font_size = $atts['font_size'];
			if ( ! empty( $font_size ) ) {
				if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
					$styles[] = 'font-size: ' . $font_size;
				} else {
					$styles[] = 'font-size: ' . intval( $font_size ) . 'px';
				}
			}

			$line_height = $atts['line_height'];
			if ( ! empty( $line_height ) ) {
				if ( qode_framework_string_ends_with_typography_units( $line_height ) ) {
					$styles[] = 'line-height: ' . $line_height;
				} else {
					$styles[] = 'line-height: ' . intval( $line_height ) . 'px';
				}
			}

			$letter_spacing = $atts['letter_spacing'];
			if ( '' !== $letter_spacing ) {
				if ( qode_framework_string_ends_with_typography_units( $letter_spacing ) ) {
					$styles[] = 'letter-spacing: ' . $letter_spacing;
				} else {
					$styles[] = 'letter-spacing: ' . intval( $letter_spacing ) . 'px';
				}
			}

			if ( ! empty( $atts['font_weight'] ) ) {
				$styles[] = 'font-weight: ' . $atts['font_weight'];
			}

			if ( ! empty( $atts['font_style'] ) ) {
				$styles[] = 'font-style: ' . $atts['font_style'];
			}

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			if ( '' !== $atts['margin'] ) {
				$styles[] = 'margin: ' . $atts['margin'];
			}

			return $styles;
		}

		private function set_responsive_styles( $atts ) {
			$unique_class = '.' . $atts['unique_class'];
			$screen_sizes = array( '1680', '1512', '1368', '1200', '1024', '880', '680' );
			$option_keys  = array( 'font_size', 'line_height', 'letter_spacing' );

			foreach ( $screen_sizes as $screen_size ) {
				$styles = array();

				foreach ( $option_keys as $option_key ) {
					$option_value = $atts[ $option_key . '_' . $screen_size ];
					$style_key    = str_replace( '_', '-', $option_key );

					if ( '' !== $option_value ) {
						if ( qode_framework_string_ends_with_typography_units( $option_value ) ) {
							$styles[ $style_key ] = $option_value . '!important';
						} else {
							$styles[ $style_key ] = intval( $option_value ) . 'px !important';
						}
					}
				}

				if ( ! empty( $styles ) ) {
					add_filter(
						'einar_core_filter_add_responsive_' . $screen_size . '_inline_style_in_footer',
						function ( $style ) use ( $unique_class, $styles ) {
							$style .= qode_framework_dynamic_style( $unique_class, $styles );

							return $style;
						}
					);
				}
			}
		}
	}
}
