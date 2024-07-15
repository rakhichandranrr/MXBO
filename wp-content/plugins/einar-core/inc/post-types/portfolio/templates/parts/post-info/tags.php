<?php
$categories = wp_get_post_terms( get_the_ID(), 'portfolio-tag' );

if ( ! empty( $categories ) ) { ?>
	<div class="qodef-e qodef-info--tag">
		<h6 class="qodef-e-label"><?php esc_html_e( 'Tags: ', 'einar-core' ); ?></h6>
		<div class="qodef-e-tag">
			<?php echo get_the_term_list( get_the_ID(), 'portfolio-tag', '', '' ); ?>
		</div>
	</div>
<?php } ?>
