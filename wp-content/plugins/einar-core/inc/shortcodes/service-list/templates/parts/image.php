<?php if ( ! empty( $params['image'] ) ) : ?>
	<div class="qodef-m-image">
		<?php echo wp_get_attachment_image( $params['image'], 'full' ); ?>
	</div>
<?php endif; ?>
