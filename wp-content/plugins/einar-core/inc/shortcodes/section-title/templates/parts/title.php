<?php if ( ! empty( $title ) ) { ?>
	<<?php echo einar_core_escape_title_tag( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
		<?php if ( ! empty( $title_link ) ) : ?>
			<a itemprop="url" href="<?php echo esc_url( $title_link ); ?>" target="<?php echo esc_attr( $title_target ); ?>">
		<?php endif; ?>
			<?php echo qode_framework_wp_kses_html( 'content', $title ); ?>
		<?php if ( ! empty( $title_link ) ) : ?>
			</a>
		<?php endif; ?>
	</<?php echo einar_core_escape_title_tag( $title_tag ); ?>>
<?php } ?>
