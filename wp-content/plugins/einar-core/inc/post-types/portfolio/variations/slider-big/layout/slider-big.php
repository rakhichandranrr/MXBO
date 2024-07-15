<?php
// Hook to include additional content before portfolio single item
do_action( 'einar_core_action_before_portfolio_single_item' );
?>
	<article <?php post_class( 'qodef-portfolio-single-item qodef-variations--big qodef-e' ); ?>>
		<div class="qodef-e-inner">
			<?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/title' ); ?>
			<div class="qodef-e-big-slider-holder">
				<div class="qodef-media qodef-swiper-container qodef--slider">
					<div class="swiper-wrapper">
						<?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/media', 'slider' ); ?>
					</div>
					<?php
					einar_core_template_part(
						'content',
						'templates/swiper-nav',
						'',
						array(
							'slider_navigation' => 'yes',
							'unique'            => rand( 0, 1000 ),
						)
					);
					?>
				</div>
			</div>
			<div class="qodef-e-content qodef-grid qodef-layout--template qodef-grid-template--9-3 <?php echo einar_core_get_grid_gutter_classes(); ?>" <?php echo einar_core_get_grid_gutter_styles(); ?>>
				<div class="qodef-grid-inner">
					<div class="qodef-grid-item qodef-col--content">
						<?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
					</div>
					<div class="qodef-grid-item qodef-col--sidebar qodef-portfolio-info">
						<?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
						<?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
						<?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/tags' ); ?>
						<?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/social-share' ); ?>
					</div>
				</div>
			</div>
			<div class="qodef-media-gallery">
				<?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/media', 'gallery-below-slider' ); ?>
			</div>
		</div>
	</article>
<?php
// Hook to include additional content after portfolio single item
do_action( 'einar_core_action_after_portfolio_single_item' );
?>
