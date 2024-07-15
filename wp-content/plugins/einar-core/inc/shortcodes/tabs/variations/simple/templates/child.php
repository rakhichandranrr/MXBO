<div class="qodef-tabs-content" id="qodef-tab-<?php echo sanitize_title( $tab_title ); ?>">
	<?php
	if ( empty( $content ) && qode_framework_is_installed( 'elementor' ) ) {
		$content = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $predefined_elementor_template );
	}

	echo do_shortcode( $content );
	?>
</div>
