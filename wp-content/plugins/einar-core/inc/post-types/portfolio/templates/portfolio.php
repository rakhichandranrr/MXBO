<div class="qodef-grid-item <?php echo esc_attr( einar_core_get_page_content_sidebar_classes() ); ?>">
	<div class="qodef-portfolio qodef-m <?php echo esc_attr( einar_core_get_portfolio_holder_classes() ); ?>">
		<?php
		// Include portfolio posts loop
		einar_core_template_part( 'post-types/portfolio', 'templates/parts/loop' );
		?>
	</div>
</div>
