<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-wrapper-inner">
		<div class="qodef-e-top-holder">
			<?php if ( ! empty( $heading_one ) || ! empty( $heading_two ) || ! empty( $heading_three ) || ! empty( $heading_four ) ) : ?>
				<span class="qodef-e-heading-text">
					<?php echo esc_html( $heading_one ); ?>
				</span>
				<span class="qodef-e-heading-text">
					<?php echo esc_html( $heading_two ); ?>
				</span>
				<span class="qodef-e-heading-text">
					<?php echo esc_html( $heading_three ); ?>
				</span>
				<span class="qodef-e-heading-text">
					<?php echo esc_html( $heading_four ); ?>
				</span>
			<?php endif; ?>
		</div>
		<?php
		if ( ! empty( $items ) ) {
			foreach ( $items as $item ) {
				$params['item_title'] = $item['item_title'];
				$params['time']       = $item['time'];
				$params['location']   = $item['location'];
				$params['speaker']    = $item['speaker'];
				$params['link']       = $item['link'];
				?>
				<div class="qodef-e">
					<div class="qodef-e-inner">
						<?php einar_core_template_part( 'shortcodes/event-agenda', 'templates/parts/title', '', $params ); ?>
						<?php einar_core_template_part( 'shortcodes/event-agenda', 'templates/parts/time', '', $params ); ?>
						<?php einar_core_template_part( 'shortcodes/event-agenda', 'templates/parts/location', '', $params ); ?>
						<?php einar_core_template_part( 'shortcodes/event-agenda', 'templates/parts/speaker', '', $params ); ?>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
</div>
