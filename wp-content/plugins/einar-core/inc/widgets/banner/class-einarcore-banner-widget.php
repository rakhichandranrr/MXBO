<?php

if ( ! function_exists( 'einar_core_add_banner_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function einar_core_add_banner_widget( $widgets ) {
		$widgets[] = 'EinarCore_Banner_Widget';

		return $widgets;
	}

	add_filter( 'einar_core_filter_register_widgets', 'einar_core_add_banner_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EinarCore_Banner_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'einar_core_banner_widget' );
			$this->set_name( esc_html__( 'Einar Banner', 'einar-core' ) );
			$this->set_description( esc_html__( 'Add banner element into widget areas', 'einar-core' ) );
			$this->set_widget_option(
				array(
					'field_type' => 'image',
					'name'       => 'image',
					'title'      => esc_html__( 'Image', 'einar-core' ),
				)
			);
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
					'name'       => 'button_text',
					'title'      => esc_html__( 'Button Text', 'einar-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'button_link',
					'title'      => esc_html__( 'Button Link', 'einar-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type'    => 'select',
					'name'          => 'button_link_target',
					'title'         => esc_html__( 'Button Link Target', 'einar-core' ),
					'options'       => einar_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
		}

		public function render( $atts ) {
			$image              = $atts['image'];
			$title              = $atts['title'];
			$title_tag          = ! empty( $atts['title_tag'] ) ? $atts['title_tag'] : 'h5';
			$button_text        = $atts['button_text'];
			$button_link        = $atts['button_link'];
			$button_link_target = $atts['button_link_target'];
			?>
			<div <?php qode_framework_class_attribute( $this->get_holder_classes( $atts ) ); ?>>
				<?php if ( ! empty( $image ) ) : ?>
				<div class="qodef-m-image">
					<?php echo wp_get_attachment_image( $image, 'full' ); ?>
				</div>
				<div class="qodef-m-content">
					<div class="qodef-m-content-inner">
						<?php if ( ! empty( $title ) ) : ?>
							<?php echo '<' . einar_core_escape_title_tag( $title_tag ); ?> class="qodef-e-title">
								<?php echo qode_framework_wp_kses_html( 'content', $title ); ?>
							<?php echo '</' . einar_core_escape_title_tag( $title_tag ); ?>>
						<?php endif; ?>

						<?php if ( class_exists( 'EinarCore_Button_Shortcode' ) && ! empty( $button_text ) && ! empty( $button_link ) ) : ?>
							<?php
							$button_params = array(
								'button_layout' => 'outlined',
								'size'          => 'full',
								'link'          => $button_link,
								'text'          => $button_text,
								'target'        => $button_link_target,
							);

							echo EinarCore_Button_Shortcode::call_shortcode( $button_params );
							?>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<?php
		}

		public function get_holder_classes( $atts ) {
			$holder_classes = array();

			$holder_classes[] = 'qodef-widget-banner';

			return implode( ' ', $holder_classes );
		}
	}
}
