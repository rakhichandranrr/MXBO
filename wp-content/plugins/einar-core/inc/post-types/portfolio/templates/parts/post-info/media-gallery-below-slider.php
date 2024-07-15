<?php
$portfolio_media             = array();
$gallery_below_slider_images = get_post_meta( get_the_ID(), 'qodef_portfolio_gallery_below_slider', true );

$portfolio_media[0]['qodef_portfolio_media_type'] = 'gallery';
$portfolio_media[0]['qodef_portfolio_gallery']    = $gallery_below_slider_images;

$gallery_classes   = '';
$number_of_columns = einar_core_get_post_value_through_levels( 'qodef_portfolio_columns_number' );
$gallery_classes  .= ! empty( $number_of_columns ) ? ' qodef-col-num--' . $number_of_columns : ' qodef-col-num--3';

$space_between_items = einar_core_get_post_value_through_levels( 'qodef_portfolio_space_between_items' );
$gallery_classes    .= ! empty( $space_between_items ) ? ' qodef-gutter--' . $space_between_items : ' qodef-gutter--tiny';

$vertical_space_between_items = einar_core_get_post_value_through_levels( 'qodef_portfolio_vertical_space_between_items' );
$gallery_classes             .= ! empty( $vertical_space_between_items ) ? ' qodef-vertical-gutter--' . $vertical_space_between_items : ' qodef-vertical-gutter--tiny';

$gallery_styles = einar_core_get_gutter_custom_styles( 'qodef_portfolio_space_between_items_', 'qodef_portfolio_vertical_space_between_items_', array(), true );

if ( ! empty( $portfolio_media ) ) { ?>
	<div class="qodef-e qodef-grid qodef-layout--columns qodef-responsive--predefined <?php echo esc_attr( $gallery_classes ); ?>" <?php qode_framework_inline_style( $gallery_styles ); ?>>
		<div class="qodef-grid-inner qodef-magnific-popup qodef-popup-gallery">
			<?php
			foreach ( $portfolio_media as $media ) {
				$type       = $media['qodef_portfolio_media_type'];
				$media_name = 'qodef_portfolio_' . $type;

				$params               = array();
				$params['media_type'] = 'gallery';
				$params['media']      = $media[ $media_name ];

				einar_core_template_part( 'post-types/portfolio', 'templates/parts/media/media', $type, $params );
			}
			?>
		</div>
	</div>
<?php } ?>
