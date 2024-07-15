<?php

class EinarCore_Interactive_Banners_Shortcode_Elementor extends EinarCore_Elementor_Widget_Base {

	function __construct( array $data = array(), $args = null ) {
		$this->set_shortcode_slug( 'einar_core_interactive_banners' );

		parent::__construct( $data, $args );
	}
}

einar_core_register_new_elementor_widget( new EinarCore_Interactive_Banners_Shortcode_Elementor() );
