<div class="qodef-e-media">
	<?php
	switch ( get_post_format() ) {
		case 'gallery':
			einar_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			einar_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			einar_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			einar_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	}
	?>
</div>
