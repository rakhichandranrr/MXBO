<?php
// Hook to include additional content before page content holder
do_action( 'einar_action_before_page_content_holder' );
?>
<main id="qodef-page-content" class="qodef-grid qodef-layout--template <?php echo esc_attr( einar_get_page_grid_sidebar_classes() ); ?> <?php echo esc_attr( einar_get_grid_gutter_classes() ); ?>" <?php echo einar_get_grid_gutter_styles(); ?> role="main">
	<div class="qodef-grid-inner">
		<?php
		// Hook to include additional content before blog and sidebar
		do_action( 'einar_action_before_blog_sidebar' );

		// Include blog template
		echo apply_filters( 'einar_filter_blog_template', einar_get_template_part( 'blog', 'templates/blog' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		// Include page content sidebar
		einar_template_part( 'sidebar', 'templates/sidebar' );
		?>
	</div>
</main>
<?php
// Hook to include additional content after main page content holder
do_action( 'einar_action_after_page_content_holder' );
?>