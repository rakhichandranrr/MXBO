<?php
// Load title image template
einar_core_get_page_title_image();
?>
<div class="qodef-m-content <?php echo esc_attr( einar_core_get_page_title_content_classes() ); ?>">
	<<?php echo einar_core_escape_title_tag( $title_tag ); ?> class="qodef-m-title entry-title">
		<?php
		if ( qode_framework_is_installed( 'theme' ) ) {
			echo esc_html( einar_get_page_title_text() );
		} else {
			echo get_option( 'blogname' );
		}
		?>
	</<?php echo einar_core_escape_title_tag( $title_tag ); ?>>
	<?php
	// Load subtitle template
	einar_core_template_part( 'title/layouts/standard', 'templates/parts/subtitle', '', einar_core_get_standard_title_layout_subtitle_text() );
	?>
</div>
