<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attrs( $data_attrs ); ?>>
	<?php
	if ( count( $image_params ) ) {
		einar_core_template_part( 'shortcodes/image-with-text', 'templates/parts/image', '', $params );
	}
	?>
	<div class="qodef-m-content">
		<?php einar_core_template_part( 'shortcodes/image-with-text', 'templates/parts/title', '', $params ); ?>
		<?php einar_core_template_part( 'shortcodes/image-with-text', 'templates/parts/text', '', $params ); ?>
		<?php einar_core_template_part( 'shortcodes/image-with-text', 'templates/parts/button', '', $params ); ?>
	</div>
</div>
