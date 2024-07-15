<?php
if ( ! empty( $counter_image ) ) : ?>
	<div class="qodef-e-image">
		<?php echo wp_get_attachment_image( $counter_image, 'full' ); ?>
	</div>
	<?php
endif;
