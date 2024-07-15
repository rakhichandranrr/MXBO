<?php if ( ! empty( $show_fixed_text ) && 'yes' === $show_fixed_text && ( ! empty( $fixed_text_top ) || ! empty( $fixed_text_bottom ) ) ) { ?>
	<div class="qodef-slider-fixed-text-holder">
		<?php if ( ! empty( $fixed_text_top ) ) { ?>
			<h6 class="qodef-slider-fixed-text-top"><?php echo qode_framework_wp_kses_html( 'content', $fixed_text_top ); ?></h6>
		<?php } ?>
		<?php if ( ! empty( $fixed_text_bottom ) ) { ?>
			<h6 class="qodef-slider-fixed-text-bottom"><?php echo qode_framework_wp_kses_html( 'content', $fixed_text_bottom ); ?></h6>
		<?php } ?>
	</div>
<?php } ?>
