<?php if ( ! empty( $read_more_link ) && ! empty( $read_more_text ) && class_exists( 'EinarCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-e-more-link">
		<?php
		$button_params = array(
			'button_layout'     => 'outlined',
			'size'              => 'full',
			'show_button_arrow' => 'yes',
			'link'              => $read_more_link,
			'text'              => $read_more_text,
			'target'            => $read_more_target,
		);

		echo EinarCore_Button_Shortcode::call_shortcode( $button_params );
		?>
	</div>
<?php } ?>
