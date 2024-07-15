<a <?php qode_framework_class_attribute( $holder_classes ); ?> href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>" <?php qode_framework_inline_attrs( $data_attrs ); ?> <?php qode_framework_inline_style( $styles ); ?>>
	<span class="qodef-m-inner">
		<?php
		if ( ! empty( $show_button_arrow ) && 'yes' === $show_button_arrow ) {
			einar_core_render_svg_icon( 'arrow-button-simple' );
		}
		?>
		<span class="qodef-m-text"><?php echo esc_html( $text ); ?></span>
	</span>
</a>