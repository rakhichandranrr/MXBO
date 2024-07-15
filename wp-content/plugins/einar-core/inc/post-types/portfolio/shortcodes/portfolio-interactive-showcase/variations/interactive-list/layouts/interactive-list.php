<?php
$styles = array();
if ( ! empty( $interactive_list_content_margin_top ) ) {
	$margin_top = qode_framework_string_ends_with_space_units( $interactive_list_content_margin_top ) ? $interactive_list_content_margin_top : intval( $interactive_list_content_margin_top ) . 'px';
	$styles[]   = 'margin-top:' . $margin_top;
}
?>
<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ); ?>>
		<div class="qodef-e-content" <?php qode_framework_inline_style( $styles ); ?>>
			<div class="qodef-e-text">
				<?php einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'post-info/title', '', $params ); ?>

				<?php einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'post-info/read-more', '', $params ); ?>
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
		<div class="qodef-e-follow-content">
			<?php einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'post-info/image-follow', '', $params ); ?>
			<span class="qodef-overlay-holder">
				<span class="qodef-overlay-track"></span>
				<span class="qodef-overlay-track"></span>
				<span class="qodef-overlay-track"></span>
				<span class="qodef-overlay-track"></span>
			</span>
		</div>
	</div>
	<?php einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-showcase', 'post-info/link', '', $params ); ?>
</article>
