<?php
$dual_image_slider_left  = get_post_meta( get_the_ID(), 'qodef_portfolio_dual_image_slider_left', true );
$dual_image_slider_right = get_post_meta( get_the_ID(), 'qodef_portfolio_dual_image_slider_right', true );
$has_image               = ! empty( $dual_image_slider_left ) || has_post_thumbnail();

if ( $has_image ) {
	$image_dimension = isset( $image_dimension ) && ! empty( $image_dimension ) && 'custom' !== $image_dimension ? esc_attr( $image_dimension['size'] ) : 'full';
	$image_url       = einar_core_get_list_shortcode_item_image_url( $image_dimension, $dual_image_slider_left );
	?>
	<div class="qodef-e-media-image">
		<?php echo einar_core_get_list_shortcode_item_image( $image_dimension, $dual_image_slider_left ); ?>
		<?php echo einar_core_get_list_shortcode_item_image( $image_dimension, $dual_image_slider_right ); ?>
	</div>
<?php } ?>
