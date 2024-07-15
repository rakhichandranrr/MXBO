<?php
if ( ! empty( $image ) ) {
	$image_title = get_the_title( $image );
	$image_src   = wp_get_attachment_image_src( $image, 'full' );
	if ( is_array( $image_src ) ) {
		?>
		<div class="qodef-m-image">
			<?php
			$images_proportion   = isset( $images_proportion ) && ! empty( $images_proportion ) ? esc_attr( $images_proportion ) : 'full';
			$custom_image_width  = isset( $custom_image_width ) && '' !== $custom_image_width ? intval( $custom_image_width ) : 0;
			$custom_image_height = isset( $custom_image_height ) && '' !== $custom_image_height ? intval( $custom_image_height ) : 0;
			echo einar_core_get_list_shortcode_item_image( $images_proportion, $image, $custom_image_width, $custom_image_height );
			?>
		</div>
	<?php }
} ?>
