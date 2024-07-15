<?php if ( ! empty( $text_field ) ) : ?>
	<?php echo '<' . einar_core_escape_title_tag( $text_tag ); ?> class="qodef-m-text" <?php qode_framework_inline_style( $text_styles ); ?>>
		<?php echo esc_html( $text_field ); ?>
	<?php echo '</' . einar_core_escape_title_tag( $text_tag ); ?>>
<?php endif; ?>
