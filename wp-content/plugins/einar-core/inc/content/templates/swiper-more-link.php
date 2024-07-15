<?php if ( ! empty( $slider_more_link ) ) { ?>
	<div class="slider-more-link">
		<?php
		$button_params = array(
			'link'          => $slider_more_link,
			'target'        => $slider_more_target,
			'button_layout' => 'textual',
			'text'          => $slider_more_text,
		);

		echo EinarCore_Button_Shortcode::call_shortcode( $button_params );
		?>
	</div>
<?php } ?>
