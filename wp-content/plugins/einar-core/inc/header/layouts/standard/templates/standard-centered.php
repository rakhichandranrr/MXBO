<div class="qodef-header-wrapper">
	<div class="qodef-header-logo">
		<?php
		// Include logo
		einar_core_get_header_logo_image();
		?>
	</div>
	<?php
	// Include main navigation
	einar_core_template_part( 'header', 'templates/parts/navigation' );

	// Include widget area one
	einar_core_get_header_widget_area();
	?>
</div>
