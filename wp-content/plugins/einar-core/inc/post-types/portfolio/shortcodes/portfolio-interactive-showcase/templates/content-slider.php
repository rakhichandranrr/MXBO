<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $data_attr, 'data-options' ); ?>>
	<div class="qodef-slider-top">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php
				// Include items
				einar_core_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'templates/loop', '', $params );
				?>
			</div>
		</div>
	</div>
	<div class="qodef-slider-image">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php
				// Include items
				einar_core_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'templates/loop-images', '', $params );
				?>
			</div>
		</div>
	</div>
	<?php
	// Include more link
	einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'post-info/more-link', '', $params );

	// Include fixed text
	einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'post-info/fixed-text', '', $params );
	?>
</div>
