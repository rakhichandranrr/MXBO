<?php if ( ! empty( $info_text ) ) { ?>
	<<?php echo einar_core_escape_title_tag( $text_tag ); ?> class="qodef-m-info-text" <?php qode_framework_inline_style( $text_styles ); ?>>
		<?php echo esc_html( $info_text ); ?>
	</<?php echo einar_core_escape_title_tag( $text_tag ); ?>>
<?php } ?>
