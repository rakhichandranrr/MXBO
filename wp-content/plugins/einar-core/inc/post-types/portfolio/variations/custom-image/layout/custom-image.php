<?php
// Hook to include additional content before portfolio single item
do_action( 'einar_core_action_before_portfolio_single_item' );
?>
	<article <?php post_class( 'qodef-portfolio-single-item qodef-variations--custom-image qodef-e' ); ?>>
		<div class="qodef-e-inner">
			<div class="qodef-e-content qodef-grid qodef-layout--template qodef-grid-template--6-6 <?php echo einar_core_get_grid_gutter_classes(); ?>">
                <div class="qodef-grid-inner">
                    <div class="qodef-grid-item qodef-e-featured-holder">
                        <?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/image' ); ?>
                    </div>
                    <div class="qodef-grid-item qodef-custom-portfolio-info-holder">
                        <div class="qodef-e-title-holder">
                            <?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/title' ); ?>
                        </div>
                        <div class="qodef-e-description-holder">
                            <?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/description' ); ?>
                        </div>
                        <div class="qodef-additional-info qodef-portfolio-info">
                            <?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
                            <?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
                            <?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/tags' ); ?>
                        </div>
                    </div>
                </div>
			</div>
		</div>
        <div class="qodef-portfolio-additional-content">
            <?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
        </div>
	</article>
<?php
// Hook to include additional content after portfolio single item
do_action( 'einar_core_action_after_portfolio_single_item' );
?>
