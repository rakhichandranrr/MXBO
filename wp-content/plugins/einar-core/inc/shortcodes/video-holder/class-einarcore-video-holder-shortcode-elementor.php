<?php

class EinarCoreElementorVideoHolder extends EinarCore_Elementor_Widget_Base {
	
	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'einar_core_video_holder' );
		
		parent::__construct( $data, $args );
	}
}

einar_core_register_new_elementor_widget( new EinarCoreElementorVideoHolder() );