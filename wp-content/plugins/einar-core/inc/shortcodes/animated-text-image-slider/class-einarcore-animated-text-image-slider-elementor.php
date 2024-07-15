<?php

class EinarCore_Animated_Text_Image_Slider_Shortcode_Elementor extends EinarCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'einar_core_animated_text_image_slider' );
		
		parent::__construct( $data, $args );
	}
}

einar_core_register_new_elementor_widget( new EinarCore_Animated_Text_Image_Slider_Shortcode_Elementor() );
