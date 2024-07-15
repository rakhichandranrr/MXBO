<?php if ( ! empty( $button_params ) && ! empty( $button_params['link'] ) && class_exists( 'EinarCore_Button_Shortcode' ) ) { ?>
	<?php echo EinarCore_Button_Shortcode::call_shortcode( $button_params ); ?>
	<?php
}
