<?php
$title_tag     = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h2';
$portfolio_url = einar_core_get_portfolio_list_item_url( get_the_ID() );
?>
<<?php echo einar_core_escape_title_tag( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title" <?php qode_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
	<a itemprop="url" class="qodef-e-title-link" href="<?php echo esc_url( $portfolio_url['link'] ); ?>" target="<?php echo esc_attr( $portfolio_url['target'] ); ?>">
		<?php the_title(); ?>
	</a>
</<?php echo einar_core_escape_title_tag( $title_tag ); ?>>
