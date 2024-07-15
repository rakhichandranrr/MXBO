<?php

if ( ! function_exists( 'einar_core_include_portfolio_single_related_posts_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function einar_core_include_portfolio_single_related_posts_template() {
		einar_core_template_part( 'post-types/portfolio', 'templates/single/related-posts/templates/related-posts' );
	}

	add_action( 'einar_core_action_after_portfolio_single_item', 'einar_core_include_portfolio_single_related_posts_template', 20 ); // permission 20 is set to define template position
}
