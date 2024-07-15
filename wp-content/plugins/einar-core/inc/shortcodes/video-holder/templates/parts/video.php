<?php if ( ! empty( $video_source ) ) : ?>

<?php
if ( ! empty( $video_poster ) ) :
	$img_attributes = wp_get_attachment_image_src( $video_poster, 'full' );
	$img_url = $img_attributes[0];
	$img_poster = '';
endif; ?>
    <div class="qodef-m-video">
        <video autoplay="autoplay" loop="loop" muted="muted" playsinline="" <?php if ( ! empty( $img_url ) ) : echo 'poster="' . esc_url( $img_url ) . '"';  endif; ?>>
            <source src="<?php echo esc_url($video_source); ?>">
        </video>
    </div>
<?php endif; ?>
