<?php if ( ! empty( $button_right_link ) && ! empty( $button_right_text ) && class_exists( 'EinarCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-e-button-right">
		<?php
		$button_params = array(
			'button_layout'     => 'textual',
			'size'              => 'full',
			'show_button_arrow' => 'yes',
			'link'              => $button_right_link,
			'text'              => $button_right_text,
			'target'            => $button_right_target,
		);

		echo EinarCore_Button_Shortcode::call_shortcode( $button_params );
		?>
	</div>
<?php } ?>
