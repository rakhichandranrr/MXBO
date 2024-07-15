<?php if ( einar_is_footer_logo_area_enabled() ) { ?>
	<div id="qodef-page-footer-logo-area">
		<div id="qodef-page-footer-logo-area-inner" class="<?php echo esc_attr( einar_get_footer_logo_area_classes() ); ?>">
			<div class="<?php echo esc_attr( einar_get_footer_logo_area_columns_classes() ); ?>">
				<div class="qodef-grid-inner">
					<?php for ( $i = 1; $i <= intval( einar_get_page_footer_sidebars_config_by_key( 'footer_logo_sidebars_number' ) ); $i ++ ) { ?>
						<div class="qodef-grid-item">
							<?php
							$footer_logo_main  = einar_get_post_value_through_levels( 'qodef_footer_logo_main' );
							$footer_logo_dark  = einar_get_post_value_through_levels( 'qodef_footer_logo_dark' );
							$footer_logo_light = einar_get_post_value_through_levels( 'qodef_footer_logo_light' );
							?>

							<?php if ( ! empty( $footer_logo_main ) || ! empty( $footer_logo_dark ) || ! empty( $footer_logo_light ) ) { ?>
							<a itemprop="url" class="qodef-footer-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php } ?>
								<?php
								if ( ! empty( $footer_logo_main ) ) :
									echo wp_get_attachment_image( $footer_logo_main, 'full', false, array( 'class' => 'qodef-footer-logo-image qodef--main' ) );
								endif;
								?>
								<?php
								if ( ! empty( $footer_logo_dark ) ) :
									echo wp_get_attachment_image( $footer_logo_dark, 'full', false, array( 'class' => 'qodef-footer-logo-image qodef--dark' ) );
								endif;
								?>
								<?php
								if ( ! empty( $footer_logo_light ) ) :
									echo wp_get_attachment_image( $footer_logo_light, 'full', false, array( 'class' => 'qodef-footer-logo-image qodef--light' ) );
								endif;
								?>
							<?php if ( ! empty( $footer_logo_main ) || ! empty( $footer_logo_dark ) || ! empty( $footer_logo_light ) ) { ?>
							</a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
