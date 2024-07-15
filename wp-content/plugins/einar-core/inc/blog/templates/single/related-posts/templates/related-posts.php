<?php
$post_id       = get_the_ID();
$is_enabled    = einar_core_get_post_value_through_levels( 'qodef_blog_single_enable_related_posts' );
$related_posts = einar_core_get_custom_post_type_related_posts( $post_id, einar_core_get_blog_single_post_taxonomies( $post_id ) );

if ( 'yes' === $is_enabled && ! empty( $related_posts ) && class_exists( 'EinarCore_Blog_List_Shortcode' ) ) { ?>
	<div id="qodef-related-posts">
        <h4 class="qodef-related-posts-label">
            <?php esc_html_e("Related Articles", 'einar-core'); ?>
        </h4>
		<?php
		$params = apply_filters(
			'einar_core_filter_blog_single_related_posts_params',
			array(
				'columns'           => '2',
				'posts_per_page'    => 2,
				'additional_params' => 'id',
				'post_ids'          => $related_posts['items'],
				'title_tag'         => 'h5',
				'excerpt_length'    => '100',
                'layout'            => 'classic',
			)
		);

		echo EinarCore_Blog_List_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
