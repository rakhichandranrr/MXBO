<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
	<div class="qodef-m-content">
		<div class="qodef-m-content-inner">
			<?php einar_core_template_part( 'shortcodes/banner', 'templates/parts/title', '', $params ); ?>
			<?php einar_core_template_part( 'shortcodes/banner', 'templates/parts/button', '', $params ); ?>

			<div class="qodef-m-bottom-content">
				<?php einar_core_template_part( 'shortcodes/banner', 'templates/parts/subtitle', '', $params ); ?>
				<?php einar_core_template_part( 'shortcodes/banner', 'templates/parts/small-image', '', $params ); ?>
			</div>
		</div>
	</div>
</div>
