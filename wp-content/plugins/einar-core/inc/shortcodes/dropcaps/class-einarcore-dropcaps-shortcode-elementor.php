<?php

class EinarCore_Dropcaps_Shortcode_Elementor extends EinarCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'einar_core_dropcaps' );

		parent::__construct( $data, $args );
	}
}

einar_core_register_new_elementor_widget( new EinarCore_Dropcaps_Shortcode_Elementor() );
