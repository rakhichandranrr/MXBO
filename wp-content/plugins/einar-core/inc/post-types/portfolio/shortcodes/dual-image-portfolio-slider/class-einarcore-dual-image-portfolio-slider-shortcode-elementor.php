<?php

class EinarCore_Dual_Image_Portfolio_Slider_Shortcode_Elementor extends EinarCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'einar_core_dual_image_portfolio_slider' );

		parent::__construct( $data, $args );
	}
}

einar_core_register_new_elementor_widget( new EinarCore_Dual_Image_Portfolio_Slider_Shortcode_Elementor() );
