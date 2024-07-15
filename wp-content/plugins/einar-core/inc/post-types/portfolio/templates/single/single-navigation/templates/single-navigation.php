<?php
$is_enabled = einar_core_get_post_value_through_levels( 'qodef_portfolio_enable_navigation' );

if ( 'yes' === $is_enabled ) {
	$through_same_category      = 'yes' === einar_core_get_post_value_through_levels( 'qodef_portfolio_navigation_through_same_category' );
	$navigation_only_next       = 'yes' === einar_core_get_post_value_through_levels( 'qodef_portfolio_navigation_only_next' );
	$navigation_only_next_class = '';

	if ( $navigation_only_next ) {
		$navigation_only_next_class = 'qodef--navigate-only-next';
	}
	?>
	<div id="qodef-single-portfolio-navigation" class="qodef-m <?php echo esc_attr( $navigation_only_next_class ); ?>">
		<div class="qodef-m-inner">
			<?php
			$post_navigation = array(
				'prev'      => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'See Past', 'einar-core' ) . '</span>',
					'icon'  => einar_core_get_svg_icon( 'portfolio-pagination-arrow-left', 'qodef-m-nav-icon' ),
				),
				'back-link' => array(),
				'next'      => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'See Next', 'einar-core' ) . '</span>',
					'icon'  => einar_core_get_svg_icon( 'portfolio-pagination-arrow-right', 'qodef-m-nav-icon' ),
				),
			);

			if ( $through_same_category ) {
				if ( '' !== get_adjacent_post( true, '', true, 'portfolio-category' ) ) {
					$post_navigation['prev']['post']      = get_adjacent_post( true, '', true, 'portfolio-category' );
					$post_navigation['prev']['thumbnail'] = get_the_post_thumbnail( $post_navigation['prev']['post'], $size = 'full' );
				}
				if ( '' !== get_adjacent_post( true, '', false, 'portfolio-category' ) ) {
					$post_navigation['next']['post']      = get_adjacent_post( true, '', false, 'portfolio-category' );
					$post_navigation['next']['thumbnail'] = get_the_post_thumbnail( $post_navigation['next']['post'], $size = 'full' );
				}
			} else {
				if ( '' !== get_adjacent_post( false, '', true ) ) {
					$post_navigation['prev']['post']      = get_adjacent_post( false, '', true );
					$post_navigation['prev']['thumbnail'] = get_the_post_thumbnail( $post_navigation['prev']['post'], $size = 'full' );
				}
				if ( '' !== get_adjacent_post( false, '', false ) ) {
					$post_navigation['next']['post']      = get_adjacent_post( false, '', false );
					$post_navigation['next']['thumbnail'] = get_the_post_thumbnail( $post_navigation['next']['post'], $size = 'full' );
				}
			}

			$back_to_link = get_post_meta( get_the_ID(), 'qodef_portfolio_single_back_to_link', true );
			if ( '' !== $back_to_link ) {
				$post_navigation['back-link'] = array(
					'post'    => true,
					'post_id' => $back_to_link,
					'label'   => '<span class="qodef-m-nav-label">' . esc_html__( 'Back to list', 'einar-core' ) . '</span>',
					'icon'    => einar_core_get_svg_icon( 'pagination-back-link', 'qodef-m-nav-icon' ),
				);
			}

			foreach ( $post_navigation as $key => $value ) {
				if ( isset( $post_navigation[ $key ]['post'] ) ) {
					$current_post = $value['post'];
					$post_id      = isset( $value['post_id'] ) && ! empty( $value['post_id'] ) ? $value['post_id'] : $current_post->ID;
					?>
					<a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
						<?php
						if ( ! empty( $value['icon'] ) ) {
							echo qode_framework_wp_kses_html( '', $value['icon'] );
						}

						if ( ! empty( $value['label'] ) ) {
							echo wp_kses( $value['label'], array( 'span' => array( 'class' => true ) ) );
						}
						?>
					</a>
					<?php
				}
			}
			?>
		</div>
		<?php if ( $navigation_only_next ) : ?>
			<div class="qodef-m-image">
				<?php
				foreach ( $post_navigation as $key => $value ) {
					if ( isset( $post_navigation[ $key ]['post'] ) ) {
						$current_post = $value['post'];
						$post_id      = isset( $value['post_id'] ) && ! empty( $value['post_id'] ) ? $value['post_id'] : $current_post->ID;
						?>
						<?php if ( 'next' === $key ) : ?>
						<a itemprop="url" class="qodef-m-nav-image qodef--<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
							<?php echo einar_core_get_formated_output( $post_navigation[ $key ]['thumbnail'] ); ?>
						</a>
						<?php endif; ?>
						<?php
					}
				}
				?>
			</div>
		<?php endif; ?>
	</div>
<?php } ?>
