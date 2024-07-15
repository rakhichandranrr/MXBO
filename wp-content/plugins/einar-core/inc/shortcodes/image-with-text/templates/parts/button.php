<?php

$button_params = array(
	'button_layout' => 'textual',
	'link'          => $button_link,
	'target'        => $button_target,
	'text'          => $button_text,
);

if ( class_exists( 'EinarCore_Button_Shortcode' ) && ! empty( $button_link ) && ! empty( $button_text ) ) {
	echo EinarCore_Button_Shortcode::call_shortcode( $button_params );
}
