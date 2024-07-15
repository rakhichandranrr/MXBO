<?php if ( is_array( $post_ratings ) && count( $post_ratings ) ) {
	$average_rating_total = intval( round( einar_core_get_total_average_rating( $post_ratings ) ) );
	?>
	<div class="qodef-reviews-list-info qodef-reviews-average-count">
		<span class="qodef-reviews-number">
			<?php echo esc_html( $rating_number ); ?>
		</span>
		<span class="qodef-reviews-label">
			<?php echo esc_html( $rating_label ); ?>
		</span>
		<span class="qodef-stars">
			<span class="qodef-stars-wrapper-inner">
				<span class="qodef-stars-items">
					<?php
					for ( $i = 1; $i <= 5; $i ++ ) {
						if ( $average_rating_total >= $i ) {
							echo einar_core_get_svg_icon( 'star', 'qodef-active' );
						} else {
							echo einar_core_get_svg_icon( 'star', 'qodef-inactive' );
						}
					}
					?>
				</span>
	        </span>
		</span>
	</div>
<?php } ?>
