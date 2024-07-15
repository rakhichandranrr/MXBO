<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
        <div class="qodef-e-top-holder">
            <div class="qodef-e-info">
                <?php
                // Include post category info
                einar_template_part( 'blog', 'templates/parts/post-info/categories' );

                // Include post date info
                einar_template_part( 'blog', 'templates/parts/post-info/date' );
                ?>
            </div>
            <div class="qodef-e-title-holder">
                <?php
                // Include post title
                einar_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => 'h2' ) );
                ?>
            </div>
        </div>
		<?php
		// Include post media
		einar_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/media', '', $params );
		?>
	</div>
</article>
