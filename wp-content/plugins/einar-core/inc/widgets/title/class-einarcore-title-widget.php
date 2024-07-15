<?php

if ( ! function_exists( 'einar_core_add_title_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function einar_core_add_title_widget( $widgets ) {
		$widgets[] = 'EinarCore_Title_Widget';

		return $widgets;
	}

	add_filter( 'einar_core_filter_register_widgets', 'einar_core_add_title_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EinarCore_Title_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'einar_core_title_widget' );
			$this->set_name( esc_html__( 'Einar Title', 'einar-core' ) );
			$this->set_description( esc_html__( 'Add title element into widget areas', 'einar-core' ) );
			$this->set_widget_option(
				array(
					'field_type'    => 'text',
					'name'          => 'title',
					'title'         => esc_html__( 'Title', 'einar-core' ),
					'default_value' => esc_html__( 'Title', 'einar-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'link',
					'title'      => esc_html__( 'Link', 'einar-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type'    => 'select',
					'name'          => 'link_target',
					'title'         => esc_html__( 'Link Target', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_break_positions',
					'title'       => esc_html__( 'Positions of Line Break', 'einar-core' ),
					'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'einar-core' ),
					'group'       => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type'    => 'select',
					'name'          => 'disable_title_break_words',
					'title'         => esc_html__( 'Disable Title Line Break', 'einar-core' ),
					'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 1024 and lower', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Style', 'einar-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'title_tag',
					'title'      => esc_html__( 'Title Tag', 'einar-core' ),
					'options'    => einar_core_get_select_type_options_pool( 'title_tag' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'margin_bottom',
					'title'      => esc_html__( 'Bottom Margin', 'einar-core' ),
				)
			);
		}

		public function render( $atts ) {
			$title        = $this->get_modified_title( $atts );
			$title_tag    = ! empty( $atts['title_tag'] ) ? $atts['title_tag'] : 'h4';
			$title_styles = $this->get_title_styles( $atts );
			?>
			<?php if ( ! empty( $title ) ) : ?>
				<?php echo '<' . einar_core_escape_title_tag( $title_tag ); ?> <?php qode_framework_class_attribute( $this->get_holder_classes( $atts ) ); ?> <?php qode_framework_inline_style( $title_styles ); ?>>
					<?php if ( ! empty( $atts['link'] ) ) : ?>
						<a itemprop="url" href="<?php echo esc_url( $atts['link'] ); ?>" target="<?php echo esc_attr( $atts['link_target'] ); ?>">
					<?php endif; ?>
							<?php echo qode_framework_wp_kses_html( 'content', $title ); ?>
					<?php if ( ! empty( $atts['link'] ) ) : ?>
						</a>
					<?php endif; ?>
				<?php echo '</' . einar_core_escape_title_tag( $title_tag ); ?>>
			<?php endif; ?>
			<?php
		}

		public function get_holder_classes( $atts ) {
			$holder_classes = array();

			$holder_classes[] = 'qodef-widget-title';
			$holder_classes[] = 'yes' === $atts['disable_title_break_words'] ? 'qodef-title-break--disabled' : '';

			return implode( ' ', $holder_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			$margin_bottom = $atts['margin_bottom'];
			if ( ! empty( $margin_bottom ) ) {
				if ( qode_framework_string_ends_with_space_units( $margin_bottom ) ) {
					$styles[] = 'margin-bottom: ' . $margin_bottom;
				} else {
					$styles[] = 'margin-bottom: ' . intval( $margin_bottom ) . 'px';
				}
			}

			return implode( ';', $styles );
		}

		public function get_modified_title( $atts ) {
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
	}
}
