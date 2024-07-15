<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $data_attr, 'data-options' ); ?> <?php qode_framework_inline_style( $styles ); ?>>
	<?php
	// Include global filter from theme
	einar_core_theme_template_part( 'filter', 'templates/filter', '', $params );
	?>
	<div class="qodef-m-items">
		<?php
		// Include global masonry template from theme
		einar_core_theme_template_part( 'masonry', 'templates/sizer-gutter', '', $params['behavior'] );

		// Include items
		einar_core_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'templates/loop', '', $params );
		?>
	</div>
	<?php
	// Include more link
		einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'post-info/more-link', '', $params );
	?>
</div>
