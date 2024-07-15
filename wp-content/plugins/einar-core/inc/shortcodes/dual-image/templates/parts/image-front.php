<?php
if ( ! empty( $front_image ) ) {
	$image_title = get_the_title( $front_image );
	$image_src   = wp_get_attachment_image_src( $front_image, 'full' );
	if ( is_array( $image_src ) ) {
		?>
	<div class="qodef-m-image-front-holder">
		<div class="qodef-m-image-front">
			<?php
			$images_proportion   = isset( $images_proportion ) && ! empty( $images_proportion ) ? esc_attr( $images_proportion ) : 'full';
			echo einar_core_get_list_shortcode_item_image( $images_proportion, $front_image );
			?>
		</div>
	</div>
	<?php }
} ?>
