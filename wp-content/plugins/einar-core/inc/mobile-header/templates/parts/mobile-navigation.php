<?php if ( has_nav_menu( 'mobile-navigation' ) || has_nav_menu( 'main-navigation' ) ) { ?>
	<nav class="qodef-mobile-header-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Mobile Menu', 'einar-core' ); ?>">
		<?php
		// Set main navigation menu as mobile if mobile navigation is not set
		$theme_location = has_nav_menu( 'mobile-navigation' ) ? 'mobile-navigation' : 'main-navigation';

		wp_nav_menu(
			array(
				'theme_location' => $theme_location,
				'container'      => '',
				'menu_class'     => 'yes' === einar_core_get_post_value_through_levels( 'qodef_mobile_header_in_grid' ) ? 'qodef-content-grid' : '',
				'link_before'    => '<span class="qodef-menu-item-text">',
				'link_after'     => '</span>',
				'walker'         => new EinarCoreRootMainMenuWalker(),
				'menu_area'      => 'mobile',
			)
		);
		?>
	</nav>
<?php } ?>
