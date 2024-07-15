<?php
if ( isset( $media ) && ! empty( $media ) && is_array( wp_get_attachment_image_src( $media ) ) ) {
	$image_title = get_the_title( $media );
	$image_src   = wp_get_attachment_image_src( $media, 'full' );

    $classes         = array();
    $classes[]       = 'qodef-popup-item';

    if(is_singular('portfolio-item')) {
        $classes[]       = 'qodef-grid-item';
    }

	?>
	<a itemprop="image" <?php  qode_framework_class_attribute(implode(' ', $classes));?> href="<?php echo esc_url( $image_src[0] ); ?>" data-type="image" title="<?php echo esc_attr( $image_title ); ?>">
		<?php echo wp_get_attachment_image( $media, 'full' ); ?>
	</a>
<?php } ?>
