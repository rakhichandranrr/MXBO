<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
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
                einar_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => 'h1' ) );
                ?>
            </div>
        </div>
		<?php
		// Include post media
		einar_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-text">
				<?php

				// Include post content
				the_content();

				// Hook to include additional content after blog single content
				do_action( 'einar_action_after_blog_single_content' );
				?>
			</div>
            <div class="qodef-e-bottom-holder">
                <div class="qodef-e-left qodef-e-info">
                    <?php
                    // Include post tags info
                    einar_template_part( 'blog', 'templates/parts/post-info/tags' );
                    ?>
                </div>
                <div class="qodef-e-right qodef-e-info">
                    <?php
                    // Include post tags info
                    einar_template_part( 'blog', 'templates/parts/post-info/social-share' );
                    ?>
                </div>
            </div>
		</div>
	</div>
</article>
