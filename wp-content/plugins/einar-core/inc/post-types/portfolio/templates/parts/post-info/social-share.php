<?php
$social_share_enabled = 'yes' === einar_core_get_post_value_through_levels( 'qodef_portfolio_enable_social_share' );
$social_share_layout  = einar_core_get_post_value_through_levels( 'qodef_social_share_layout' );

if ( class_exists( 'EinarCore_Social_Share_Shortcode' ) && $social_share_enabled ) { ?>
	<div class="qodef-e qodef-info--social-share">
		<?php
		$params = array(
			'title'  => esc_html__( 'Share:', 'einar-core' ),
			'layout' => $social_share_layout,
		);

		echo EinarCore_Social_Share_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
