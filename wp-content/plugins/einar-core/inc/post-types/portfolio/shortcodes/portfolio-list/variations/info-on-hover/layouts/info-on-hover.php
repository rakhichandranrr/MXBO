<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ); ?>>
		<div class="qodef-e-media">
			<?php
            $portfolio_media = get_post_meta( get_the_ID(), 'qodef_portfolio_media', true );

            if ( ! empty( $portfolio_media ) && 'open-popup' === $info_on_hover_behavior ) {
                $params['info_on_hover_behavior'] = $info_on_hover_behavior;
                einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/media', '', $params );
            }

                einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/image', '', $params );
            ?>
		</div>
		<div class="qodef-e-content">
			<div class="qodef-e-text">
				<?php
				// Include post title
				einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/title', '', $params );
				?>
			</div>
		</div>
		<?php einar_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/link' ); ?>
	</div>
</article>
