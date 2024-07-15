<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $data_attr, 'data-options' ); ?> <?php qode_framework_inline_style( $styles ); ?>>
	<div class="qodef-slider-top">
		<div class="qodef-m-inner">
			<?php
			// Include items
			einar_core_template_part( 'post-types/portfolio/shortcodes/dual-image-portfolio-slider', 'templates/loop', '', $params );
			?>
		</div>
	</div>
	<div class="qodef-slider-image">
		<?php
		// Include items
		einar_core_template_part( 'post-types/portfolio/shortcodes/dual-image-portfolio-slider', 'templates/loop-images', '', $params );
		?>
	</div>
	<?php
	// Include fixed text
	einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/dual-image-portfolio-slider', 'post-info/fixed-text', '', $params );

	// Include button left
	einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/dual-image-portfolio-slider', 'post-info/button-left', '', $params );

	// Include button right
	einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/dual-image-portfolio-slider', 'post-info/button-right', '', $params );

	// Include copyright text
	einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/dual-image-portfolio-slider', 'post-info/copyright-text', '', $params );
	?>
</div>
