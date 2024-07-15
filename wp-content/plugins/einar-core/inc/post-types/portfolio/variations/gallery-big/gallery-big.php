<?php

if ( ! function_exists( 'einar_core_add_portfolio_single_variation_gallery_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function einar_core_add_portfolio_single_variation_gallery_big( $variations ) {
		$variations['gallery-big'] = esc_html__( 'Gallery - Big', 'einar-core' );

		return $variations;
	}

	add_filter( 'einar_core_filter_portfolio_single_layout_options', 'einar_core_add_portfolio_single_variation_gallery_big' );
}

if ( ! function_exists( 'einar_core_portfolio_gallery_big_image' ) ) {
    /**
     * Function that load media part template
     *
     */
    function einar_core_portfolio_gallery_big_image() {
        $params   = array ();
        $item_layout = apply_filters( 'einar_core_filter_portfolio_single_layout', '' );

        if ( is_singular( 'portfolio-item' ) && 'gallery-big' === $item_layout ) {

            einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/image-background' );
        }
    }

    add_action( 'einar_action_before_page_inner', 'einar_core_portfolio_gallery_big_image' );
}
