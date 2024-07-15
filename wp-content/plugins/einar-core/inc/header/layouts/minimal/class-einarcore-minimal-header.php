<?php

class EinarCore_Minimal_Header extends EinarCore_Header {
	private static $instance;

	public function __construct() {
		$header_menu_position = $this->get_menu_position();

		$this->set_layout( 'minimal' );
		$this->set_search_layout( 'fullscreen' );
		$this->default_header_height = 82;

		add_action( 'einar_action_before_wrapper_close_tag', array( $this, 'fullscreen_menu_template' ) );

		add_filter( 'body_class', array( $this, 'add_body_classes' ) );

		parent::__construct();
	}

	/**
	 * @return EinarCore_Minimal_Header
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function get_menu_position() {
		return einar_core_get_post_value_through_levels( 'qodef_minimal_header_logo_position' );
	}

	function add_body_classes( $classes ) {
		$header_menu_position = $this->get_menu_position();

		$classes[] = ! empty( $header_menu_position ) ? 'qodef-header-minimal-logo--' . $header_menu_position : '';

		return $classes;
	}

	function fullscreen_menu_template() {
		$parameters = array(
			'fullscreen_menu_in_grid' => 'yes' === einar_core_get_post_value_through_levels( 'qodef_fullscreen_menu_in_grid' ),
		);

		einar_core_template_part( 'fullscreen-menu', 'templates/full-screen-menu', '', $parameters );
	}
}
