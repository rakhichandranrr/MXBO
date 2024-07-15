<div id="qodef-fullscreen-area">
	<div class="qodef-content-container">
		<?php if ( $fullscreen_menu_in_grid ) { ?>
		<div class="qodef-content-grid">
		<?php } ?>

			<div id="qodef-fullscreen-area-inner">
				<?php if ( has_nav_menu( 'fullscreen-menu-navigation' ) ) { ?>
					<nav class="qodef-fullscreen-menu" role="navigation" aria-label="<?php esc_attr_e( 'Full Screen Menu', 'einar-core' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'fullscreen-menu-navigation',
								'container'      => '',
								'link_before'    => '<span class="qodef-menu-item-text">',
								'link_after'     => '</span>',
								'walker'         => new EinarCoreRootMainMenuWalker(),
							)
						);
						?>
					</nav>
				<?php } ?>
				<?php
				// include widget area two
				einar_core_get_header_widget_area( 'two', 'header-widget-area', '', $enabled = true );
				?>
			</div>

		<?php if ( $fullscreen_menu_in_grid ) { ?>
		</div>
		<?php } ?>
	</div>
</div>
