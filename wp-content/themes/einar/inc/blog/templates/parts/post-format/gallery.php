<?php
$gallery_meta = get_post_meta( get_the_ID(), 'qodef_post_format_gallery_images', true );
$data = array();
$data['paginationType']  = 'fraction';

if ( ! empty( $gallery_meta ) ) { ?>
	<div class="qodef-e-media-gallery qodef-swiper-container" <?php  qode_framework_inline_attr( json_encode( $data ), 'data-options' )?>>
		<div class="swiper-wrapper">
			<?php
			$gallery_images = explode( ',', $gallery_meta );

			foreach ( $gallery_images as $image_id ) {
				?>
				<div class="qodef-e-media-gallery-item swiper-slide">
					<?php if ( ! is_single() ) { ?>
						<a itemprop="url" href="<?php the_permalink(); ?>">
					<?php } ?>
						<?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
					<?php if ( ! is_single() ) { ?>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<div class="swiper-button-prev"><?php einar_render_svg_icon( 'slider-arrow-left' ); ?></div>
		<div class="swiper-button-next"><?php einar_render_svg_icon( 'slider-arrow-right' ); ?></div>
        <div class="swiper-pagination"></div>
	</div>
<?php } else {
	// Include featured image
	einar_template_part( 'blog', 'templates/parts/post-info/image' );
} ?>
