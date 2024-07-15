<?php

if ( ! function_exists( 'einar_core_include_portfolio_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function einar_core_include_portfolio_single_post_navigation_template() {
		einar_core_template_part( 'post-types/portfolio', 'templates/single/single-navigation/templates/single-navigation' );
	}

	add_action( 'einar_core_action_after_portfolio_single_item', 'einar_core_include_portfolio_single_post_navigation_template' );
}
