<div class="qodef-simple-tabbed-header-wrapper">
	<?php

	// Include logo
	einar_core_get_header_logo_image();

	// Include main navigation
	einar_core_template_part( 'header/layouts/simple-tabbed', 'templates/parts/navigation' );

	// Include widget area one
	einar_core_get_header_widget_area();

	$enable_fullscreen_menu = einar_core_get_post_value_through_levels( 'qodef_simple_tabbed_header_enable_fullscreen_menu' );

	if ( ! empty( $enable_fullscreen_menu ) && 'yes' === $enable_fullscreen_menu ) {
		// Include menu opener.
		einar_core_get_opener_icon_html(
			array(
				'option_name'  => 'fullscreen_menu',
				'custom_class' => 'qodef-fullscreen-menu-opener',
			),
			true
		);
	}
	?>
</div>
