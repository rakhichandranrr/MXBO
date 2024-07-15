<?php
$is_enabled = einar_core_get_post_value_through_levels( 'qodef_blog_single_enable_single_post_navigation' );

if ( 'yes' === $is_enabled ) {
    $through_same_category = 'yes' === einar_core_get_post_value_through_levels( 'qodef_blog_single_post_navigation_through_same_category' );
    ?>
    <div id="qodef-single-post-navigation" class="qodef-m">
        <div class="qodef-m-inner">
            <?php
            $post_navigation = array(
                'prev' => array(
                    'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Previous post', 'einar-core' ) . '</span>',
                ),
                'next' => array(
                    'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Next post', 'einar-core' ) . '</span>',
                ),
            );

            if ( $through_same_category ) {
                if ( '' !== get_previous_post( true ) ) {
                    $post_navigation['prev']['post'] = get_previous_post( true );
                    $post_navigation['prev']['title'] = get_the_title( get_previous_post() );
                }
                if ( '' !== get_next_post( true ) ) {
                    $post_navigation['next']['post'] = get_next_post( true );
                    $post_navigation['next']['title'] = get_the_title( get_next_post() );
                }
            } else {
                if ( '' !== get_previous_post() ) {
                    $post_navigation['prev']['post'] = get_previous_post();
                    $post_navigation['prev']['title'] = get_the_title( get_previous_post() );
                }
                if ( '' !== get_next_post() ) {
                    $post_navigation['next']['post'] = get_next_post();
                    $post_navigation['next']['title'] = get_the_title( get_next_post() );
                }
            }

            /* Single navigation section - RENDERING */
            foreach ( array( 'prev', 'next' ) as $nav_type ) {
                if ( isset( $post_navigation[ $nav_type ]['post'] ) ) {
                    if ( 'prev' === $nav_type ) {
                        ?>
                        <span class="qodef-blog-single-<?php echo esc_attr( $nav_type ); ?>">
							<span class="qodef-m-pagination-title-holder">
								<span class="qodef-m-nav-label">
									<a href="<?php echo get_permalink( $post_navigation[ $nav_type ]['post']->ID ); ?>" itemprop="url">
										<?php einar_core_render_svg_icon( 'arrow-button-simple' ); ?>
										<?php echo einar_core_get_formated_output( $post_navigation[ $nav_type ]['label'] ); ?>
									</a>
								</span>
								<p class="qodef-m-pagination-title">
									<a href="<?php echo get_permalink( $post_navigation[ $nav_type ]['post']->ID ); ?>" itemprop="url">
										<?php echo einar_core_get_formated_output( $post_navigation[ $nav_type ]['title'] ); ?>
									</a>
								</p>
							</span>
						</span>
                        <?php
                    } elseif ( 'next' === $nav_type ) {
                        ?>
                        <span class="qodef-blog-single-<?php echo esc_attr( $nav_type ); ?>">
							<span class="qodef-m-pagination-title-holder">
								<span class="qodef-m-nav-label">
									<a href="<?php echo get_permalink( $post_navigation[ $nav_type ]['post']->ID ); ?>" itemprop="url">
										<?php einar_core_render_svg_icon( 'arrow-button-simple' ); ?>
										<?php echo einar_core_get_formated_output( $post_navigation[ $nav_type ]['label'] ); ?>
									</a>
								</span>
								<p class="qodef-m-pagination-title">
									<a href="<?php echo get_permalink( $post_navigation[ $nav_type ]['post']->ID ); ?>" itemprop="url">
										<?php echo einar_core_get_formated_output( $post_navigation[ $nav_type ]['title'] ); ?>
									</a>
								</p>
							</span>
						</span>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
<?php } ?>
