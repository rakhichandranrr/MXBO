<?php
$title_tag     = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h3';
$portfolio_list_image = get_post_meta( get_the_ID(), 'qodef_portfolio_list_image', true );
$has_image            = ! empty( $portfolio_list_image ) || has_post_thumbnail();

if ( $has_image ) {
	$image_dimension = isset( $image_dimension ) && ! empty( $image_dimension ) && 'custom' !== $image_dimension ? esc_attr( $image_dimension['size'] ) : 'full';
	$custom_image_width  = isset( $custom_image_width ) && '' !== $custom_image_width ? intval( $custom_image_width ) : 0;
	$custom_image_height = isset( $custom_image_height ) && '' !== $custom_image_height ? intval( $custom_image_height ) : 0;
	$image_url       = einar_core_get_list_shortcode_item_image_url( $image_dimension, $portfolio_list_image );
	$style           = ! empty( $image_url ) ? 'background-image: url( ' . esc_url( $image_url ) . ')' : '';
	$data_images     = ! empty( $image_url ) ? esc_url( $image_url ) : '';
	?>
	<div class="qodef-e-follow-image" data-images="<?php esc_html_e( $data_images ); ?>" data-images-count="<?php esc_html_e( 1 ); ?>">
		<?php echo einar_core_get_list_shortcode_item_image( $image_dimension, $portfolio_list_image, $custom_image_width, $custom_image_height ); ?>
		<div class="qodef-e-follow-title">
			<?php the_title(); ?>
		</div>
	</div>
<?php } ?>
