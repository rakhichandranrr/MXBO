<?php

class EinarCore_Simple_Tabbed_Header extends EinarCore_Header {
	private static $instance;

	public function __construct() {
		$this->set_layout( 'simple-tabbed' );
        $this->set_search_layout( 'fullscreen' );
		$this->default_header_height = 81;

		add_action( 'einar_action_before_wrapper_close_tag', array( $this, 'fullscreen_menu_template_simple_tabbed_header' ) );

		parent::__construct();
	}

	/**
	 * @return EinarCore_Simple_Tabbed_Header
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function fullscreen_menu_template_simple_tabbed_header() {
		$parameters = array(
			'fullscreen_menu_in_grid' => 'yes' === einar_core_get_post_value_through_levels( 'qodef_fullscreen_menu_in_grid' ),
		);

		$enable_fullscreen_menu = einar_core_get_post_value_through_levels( 'qodef_simple_tabbed_header_enable_fullscreen_menu' );

		if ( ! empty( $enable_fullscreen_menu ) && 'yes' === $enable_fullscreen_menu ) {
			einar_core_template_part( 'fullscreen-menu', 'templates/full-screen-menu', '', $parameters );
		}
	}
}
