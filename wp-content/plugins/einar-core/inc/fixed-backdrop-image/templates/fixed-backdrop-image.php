<?php
$fixed_backdrop_image = einar_core_get_post_value_through_levels( 'qodef_fixed_backdrop_image' );
$fixed_backdrop_image_animation = einar_core_get_post_value_through_levels( 'qodef_fixed_backdrop_image_animation' );
$fixed_backdrop_image_control = einar_core_get_post_value_through_levels( 'qodef_fixed_backdrop_image_control' );

function get_holder_classes( $animation, $control) {
	$holder_classes[] = ( 'yes' === $animation ) ? 'qodef--rotate' : '';
	$holder_classes[] = ( 'yes' === $control ) ? 'qodef-cursor-item' : '';

	return implode( ' ', $holder_classes );
}

$holder_classes = get_holder_classes($fixed_backdrop_image_animation, $fixed_backdrop_image_control);

?>
<div id="qodef-fixed-backdrop-image-holder" <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-fixed-backdrop-image-inner">
		<?php
            echo wp_get_attachment_image($fixed_backdrop_image, 'full');
        ?>
	</div>
</div>
