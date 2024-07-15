<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?> <?php qode_framework_inline_attr( $data_attr, 'data-options' ); ?>>
	<?php
	// Include global filter from theme
	einar_core_theme_template_part( 'filter', 'templates/filter', '', $params );
	?>
	<div class="qodef-grid-inner">
		<?php
		// Include global masonry template from theme
		einar_core_theme_template_part( 'masonry', 'templates/sizer-gutter', '', $params['behavior'] );

		// Include items
		einar_core_template_part( 'blog/shortcodes/blog-list', 'templates/loop', '', $params );
		?>
	</div>
	<?php
	// Include global pagination from theme
	einar_core_theme_template_part( 'pagination', 'templates/pagination', $params['pagination_type'], $params );
	?>
</div>
