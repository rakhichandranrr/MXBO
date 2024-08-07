<?php if ( ! empty( $title ) ) { ?>
	<<?php echo einar_core_escape_title_tag( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
		<?php if ( ! empty( $link ) ) : ?>
			<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
		<?php endif; ?>
			<?php echo esc_html( $title ); ?>
		<?php if ( ! empty( $link ) ) : ?>
			</a>
		<?php endif; ?>
	</<?php echo einar_core_escape_title_tag( $title_tag ); ?>>
<?php } ?>
