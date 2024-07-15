<?php
$image        = einar_core_get_post_value_through_levels( 'qodef_spinner_image' );
$image_src    = wp_get_attachment_image_src( $image, 'full' );
$image2       = einar_core_get_post_value_through_levels( 'qodef_spinner_image_2' );
$image2_src   = wp_get_attachment_image_src( $image2, 'full' );
$spinner_text = einar_core_get_post_value_through_levels( 'qodef_page_spinner_text' );
$text_chunks  = einar_core_spinner_get_split_chunks( $spinner_text );

?>
<div class="qodef-m-predefined">
	<div class="qodef-m-top">
		<div class="qodef-m-left">
			<div class="qodef-m-text">
				<?php if ( ! empty( $text_chunks ) ) : ?>
					<?php echo qode_framework_wp_kses_html( 'textarea', einar_core_spinner_get_split_chars( $text_chunks[0] ) ); ?>
				<?php endif; ?>
			</div>
			<?php if ( ! empty( $image ) ) : ?>
				<div class="qodef-media">
					<img itemprop="image" src="<?php echo esc_url( $image_src[0] ); ?>"
					     width="<?php echo round( $image_src[1] / 2 ); ?>"
					     height="<?php echo round( $image_src[2] / 2 ); ?>"
					     alt="<?php echo esc_attr( $image_src[3] ); ?>"/>
					<span class="qodef-overlay-holder">
						<span class="qodef-overlay-track">
							<span class="qodef-overlay-track-inner"></span>
						</span>
						<span class="qodef-overlay-track">
							<span class="qodef-overlay-track-inner"></span>
						</span>
						<span class="qodef-overlay-track">
							<span class="qodef-overlay-track-inner"></span>
						</span>
						<span class="qodef-overlay-track">
							<span class="qodef-overlay-track-inner"></span>
						</span>
					</span>
				</div>
			<?php endif; ?>
		</div>
		<div class="qodef-m-right">
			<div class="qodef-m-text">
				<?php if ( ! empty( $text_chunks ) ) : ?>
					<?php echo qode_framework_wp_kses_html( 'textarea', einar_core_spinner_get_split_chars( $text_chunks[1] ) ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="qodef-m-bottom">
		<div class="qodef-m-left">
			<div class="qodef-m-text">
				<?php if ( ! empty( $text_chunks ) ) : ?>
					<?php echo qode_framework_wp_kses_html( 'textarea', einar_core_spinner_get_split_chars( $text_chunks[2] ) ); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="qodef-m-right">
			<?php if ( ! empty( $image2 ) ) : ?>
				<div class="qodef-media">
					<img itemprop="image" src="<?php echo esc_url( $image2_src[0] ); ?>"
					     width="<?php echo round( $image2_src[1] / 2 ); ?>"
					     height="<?php echo round( $image2_src[2] / 2 ); ?>"
					     alt="<?php echo esc_attr( $image2_src[3] ); ?>"/>
					<span class="qodef-overlay-holder">
						<span class="qodef-overlay-track">
							<span class="qodef-overlay-track-inner"></span>
						</span>
						<span class="qodef-overlay-track">
							<span class="qodef-overlay-track-inner"></span>
						</span>
						<span class="qodef-overlay-track">
							<span class="qodef-overlay-track-inner"></span>
						</span>
						<span class="qodef-overlay-track">
							<span class="qodef-overlay-track-inner"></span>
						</span>
					</span>
				</div>
			<?php endif; ?>
			<div class="qodef-m-text">
				<?php if ( ! empty( $text_chunks ) ) : ?>
					<?php echo qode_framework_wp_kses_html( 'textarea', einar_core_spinner_get_split_chars( $text_chunks[3] ) ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="qodef-centred-text">
		<h5 class="qodef-m-text">
			<?php if ( ! empty( $text_chunks ) ) : ?>
				<span class="qodef-top-left">
					<?php echo qode_framework_wp_kses_html( 'textarea', einar_core_spinner_get_split_chars( $text_chunks[0] ) ); ?>
				</span>
				<span class="qodef-top-right">
					<?php echo qode_framework_wp_kses_html( 'textarea', einar_core_spinner_get_split_chars( $text_chunks[1] ) ); ?>
				</span>
				<span class="qodef-bottom-left">
					<?php echo qode_framework_wp_kses_html( 'textarea', einar_core_spinner_get_split_chars( $text_chunks[2] ) ); ?>
				</span>
				<span class="qodef-bottom-right">
					<?php echo qode_framework_wp_kses_html( 'textarea', einar_core_spinner_get_split_chars( $text_chunks[3] ) ); ?>
				</span>
			<?php endif; ?>
		</h5>
	</div>
	<div class="qodef-progress">
		<div class="qodef-m-spinner-number-holder">
			<span class="qodef-m-spinner-number">0</span>
		</div>
		<span class="qodef-m-spinner-text">
			<?php echo esc_html__( 'Loading', 'einar-core' ); ?>
		</span>
	</div>
</div>
