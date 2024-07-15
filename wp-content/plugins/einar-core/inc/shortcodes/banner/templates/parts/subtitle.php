<?php if ( ! empty( $subtitle ) ) : ?>
	<?php echo '<' . einar_core_escape_title_tag( $subtitle_tag ); ?> class="qodef-m-subtitle" <?php qode_framework_inline_style( $subtitle_styles ); ?>>
		<?php echo esc_html( $subtitle ); ?>
	<?php echo '</' . einar_core_escape_title_tag( $subtitle_tag ); ?>>
<?php endif; ?>
