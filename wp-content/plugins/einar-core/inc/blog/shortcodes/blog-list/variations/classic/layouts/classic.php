<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		einar_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/media', '', $params );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-top-holder">
				<div class="qodef-e-info">
					<?php
                    // Include post category info
                    einar_core_theme_template_part( 'blog', 'templates/parts/post-info/categories' );
					?>
				</div>
			</div>
            <div class="qodef-e-title-holder">
                <?php
                // Include post title
                einar_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params );
                ?>
            </div>
            <div class="qodef-e-date-holder">
                <?php
                // Include post date info
                einar_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
                ?>
            </div>
	</div>
</article>
