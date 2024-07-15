<?php

class EinarCore_Instagram_List_Shortcode_Elementor extends EinarCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'einar_core_instagram_list' );

		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'instagram' ) ) {
	einar_core_register_new_elementor_widget( new EinarCore_Instagram_List_Shortcode_Elementor() );
}
