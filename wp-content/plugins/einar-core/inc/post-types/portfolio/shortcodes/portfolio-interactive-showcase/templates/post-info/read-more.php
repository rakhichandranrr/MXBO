<?php if ( ! post_password_required() && class_exists( 'EinarCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-e-read-more">
		<?php

		$button_params = array(
			'button_layout' => 'only-arrow',
			'link'          => get_the_permalink(),
		);

		echo EinarCore_Button_Shortcode::call_shortcode( $button_params );
		?>
	</div>
<?php } ?>
