<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ); ?>>
		<div class="qodef-e-content-holder">
			<div class="qodef-e-content">
				<div class="qodef-e-text">
					<?php einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'post-info/title', '', $params ); ?>
				</div>
				<div class="qodef-e-bottom-holder">
					<div class="qodef-e-categories">
						<?php
						// Include portfolio category info
						einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'post-info/categories', '', $params );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
