<?php
$additional_info_enabled  = einar_get_post_value_through_levels( 'qodef_blog_list_enable_additional_info' ) !== 'no';
?>

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
                    einar_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => 'h2' ) );
                ?>
            </div>
        </div>
		<?php
		// Include post media
		einar_template_part( 'blog', 'templates/parts/post-info/media' );
		?>

        <?php  if ($additional_info_enabled && einar_is_installed('core')) { ?>
            <div class="qodef-e-content">
                <div class="qodef-e-text">
                    <?php
                    // Include post excerpt
                    einar_template_part('blog', 'templates/parts/post-info/excerpt');

                    // Hook to include additional content after blog single content
                    do_action( 'einar_action_after_blog_single_content' );
                    ?>
                </div>
                <div class="qodef-e-bottom-holder">
                    <div class="qodef-e-left">
                        <?php
                        // Include post author info
                        einar_template_part('blog', 'templates/parts/post-info/author');

                        // Include post comments info
                        einar_template_part('blog', 'templates/parts/post-info/comments');
                        ?>
                    </div>
                    <div class="qodef-e-right qodef-e-info">
                        <?php
                        // Include post read more
                        einar_template_part( 'blog', 'templates/parts/post-info/tags' );
                        ?>
                    </div>
                </div>
                <div class="qodef-e-read-more-holder">
                    <?php
                    // Include post read more
                    einar_template_part('blog', 'templates/parts/post-info/read-more');
                    ?>
                </div>
            </div>
        <?php }
        // Include info for unit test
        else if (! einar_is_installed('core')) { ?>
		<div class="qodef-e-content">
			<div class="qodef-e-text">
				<?php
                // Include post excerpt
                einar_template_part('blog', 'templates/parts/post-info/excerpt');

				// Hook to include additional content after blog single content
				do_action( 'einar_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-bottom-holder">
				<div class="qodef-e-left">
					<?php
                        // Include post author info
                        einar_template_part('blog', 'templates/parts/post-info/author');

                        // Include post comments info
                        einar_template_part('blog', 'templates/parts/post-info/comments');
					?>
				</div>
				<div class="qodef-e-right qodef-e-info">
					<?php
                        // Include post read more
                        einar_template_part( 'blog', 'templates/parts/post-info/tags' );
					?>
				</div>
			</div>
            <div class="qodef-e-read-more-holder">
                <?php
                    // Include post read more
                    einar_template_part('blog', 'templates/parts/post-info/read-more');
                ?>
            </div>
		</div>
<?php } ?>
	</div>
</article>
