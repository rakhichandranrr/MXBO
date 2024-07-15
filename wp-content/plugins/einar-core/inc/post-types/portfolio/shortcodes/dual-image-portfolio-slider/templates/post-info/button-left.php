<?php if ( ! empty( $button_left_link ) && ! empty( $button_left_text ) && class_exists( 'EinarCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-e-button-left">
		<?php
		$button_params = array(
			'button_layout'     => 'textual',
			'size'              => 'full',
			'show_button_arrow' => 'yes',
			'link'              => $button_left_link,
			'text'              => $button_left_text,
			'target'            => $button_left_target,
		);

		echo EinarCore_Button_Shortcode::call_shortcode( $button_params );
		?>
	</div>
<?php } ?>
