<div class="qodef-custom-font-holder">
<<?php echo einar_core_escape_title_tag( $title_tag ); ?> <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
	<?php if (! empty( $link ) ) { ?>
		<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php } ?>
		<?php if ( 'yes' === $enable_appear ) { ?>
				<?php echo qode_framework_wp_kses_html( 'textarea', einar_core_get_split_title_text( $title ) ); ?>
			<?php } else { ?>
			<?php echo qode_framework_wp_kses_html( 'html', $title ); ?>
		<?php } ?>

		<?php
		if ( ! empty( $title_end_decoration ) && 'yes' === $title_end_decoration ) {
			if ( ! empty( $decoration_shape ) ) {
				$decoration = '';

				switch ( $decoration_shape ) :
					case 'arrow':
						$decoration = einar_core_get_svg_icon( 'decoration-arrow-big' );
						break;
					case 'circle':
						$decoration = einar_core_get_svg_icon( 'decoration-circle-big' );
						break;
					case 'circle-static':
						$decoration = einar_core_get_svg_icon( 'decoration-circle-big' );
						break;
				endswitch;

				echo '<span class="qodef-e-decoration" '.qode_framework_get_inline_style( $decoration_styles ).'>' . qode_framework_wp_kses_html( '', $decoration ) . '</span>';
			}
		}
		?>
	<?php if (! empty( $link ) ) { ?>
		</a>
	<?php } ?>
</<?php echo einar_core_escape_title_tag( $title_tag ); ?>>
</div>
