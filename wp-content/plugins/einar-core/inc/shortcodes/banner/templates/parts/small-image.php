<?php if ( ! empty( $small_image ) ) { ?>
	<div class="qodef-m-small-image">
		<?php echo wp_get_attachment_image( $small_image, 'full' ); ?>
	</div>
	<?php
}
