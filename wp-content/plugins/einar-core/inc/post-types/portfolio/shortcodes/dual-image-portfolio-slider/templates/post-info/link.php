<?php
$portfolio_url = einar_core_get_dual_image_portfolio_slider_item_url( get_the_ID() );
?>
<a itemprop="url" class="qodef-e-post-link" href="<?php echo esc_url( $portfolio_url['link'] ); ?>" target="<?php echo esc_attr( $portfolio_url['target'] ); ?>"></a>
