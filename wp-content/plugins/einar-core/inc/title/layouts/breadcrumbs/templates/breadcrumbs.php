<?php
// Load title image template
einar_core_get_page_title_image();
?>
<div class="qodef-m-content <?php echo esc_attr( einar_core_get_page_title_content_classes() ); ?>">
	<?php
	// Load breadcrumbs template
	einar_core_breadcrumbs();
	?>
</div>
