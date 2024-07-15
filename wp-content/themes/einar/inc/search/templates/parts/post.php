<article <?php post_class( 'qodef-search-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post title
		einar_template_part( 'search', 'templates/parts/post-info/image' );
		?>
		<div class="qodef-e-content">
			<?php
			// Include post title
			einar_template_part( 'search', 'templates/parts/post-info/title' );

			// Include post excerpt
			einar_template_part( 'search', 'templates/parts/post-info/excerpt' );
			?>
		</div>
	</div>
</article>
