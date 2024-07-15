<?php if ( has_nav_menu( 'main-navigation' ) ) :
	$menu = einar_core_get_post_value_through_levels( 'qodef_simple_tabbed_header_menu' );
	$menu = ! empty( $menu ) ? $menu : '';
	?>
	<nav class="qodef-header-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'einar-core' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'main-navigation',
				'menu'           => $menu,
				'container'      => '',
				'link_before'    => '<span class="qodef-menu-item-text">',
				'link_after'     => '</span>',
				'walker'         => new EinarCoreRootMainMenuWalker(),
			)
		);
		?>
	</nav>
<?php endif; ?>
