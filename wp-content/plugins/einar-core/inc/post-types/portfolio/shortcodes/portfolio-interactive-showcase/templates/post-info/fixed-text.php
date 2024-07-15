<?php
if ( ! empty( $fixed_text_one ) || ! empty( $fixed_text_two ) ) { ?>
	<div class="qodef-e-fixed-content">
		<?php
		if ( ! empty( $fixed_text_one ) ) {
			?>
			<h6 class="qodef-fixed-text-one"><?php echo wp_kses_post( $fixed_text_one ); ?></h6>
		<?php } ?>
		<?php
		if ( ! empty( $fixed_text_two ) ) {
			?>
			<h6 class="qodef-fixed-text-two">
				<?php if ( ! empty( $fixed_text_two_link ) ) : ?>
					<a itemprop="url" href="<?php echo esc_url( $fixed_text_two_link ); ?>" target="<?php echo esc_attr( $fixed_text_two_target ); ?>">
				<?php endif; ?>
						<?php echo wp_kses_post( $fixed_text_two ); ?>
				<?php if ( ! empty( $fixed_text_two_link ) ) : ?>
					</a>
				<?php endif; ?>
			</h6>
		<?php } ?>
	</div>
	<?php
}
