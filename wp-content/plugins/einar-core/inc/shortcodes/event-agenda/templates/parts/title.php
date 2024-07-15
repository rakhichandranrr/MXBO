<?php if ( ! empty( $item_title ) ) { ?>
	<h5 class="qodef-e-title">
		<?php if ( ! empty( $link ) ) { ?>
		<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
			<?php } ?>
			<?php echo esc_html( $item_title ); ?>
			<?php if ( ! empty( $link ) ) { ?>
		</a>
	<?php } ?>
	</h5>
<?php } ?>
