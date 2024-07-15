<div class="qodef-m-info clearfix">
	<?php if ( ! empty( $info_title ) ) { ?>
	<div class="qodef-m-headline">
		<<?php echo einar_core_escape_title_tag( $title_tag ); ?> class="qodef-m-title"><?php echo qode_framework_wp_kses_html( 'content', $info_title ); ?></<?php echo einar_core_escape_title_tag( $title_tag ); ?>>
	</div>
	<?php } ?>
	<div class="qodef-m-thumbnails-holder">
		<div class="qodef-grid-inner">
			<?php foreach ( $items as $image_item ) : ?>
				<div class="qodef-m-thumbnail">
					<?php einar_core_render_svg_icon( 'arrow-button-simple' ); ?>
					<span class="qodef-e-thumbnail-text">
						<?php echo esc_html( $image_item['thumbnail_text'] ); ?>
					</span>
					<?php
					if ( ! empty( $image_item['thumbnail_text_label'] ) ) {
						?>
						<span class="qodef-e-thumbnail-label"><?php echo esc_html( $image_item['thumbnail_text_label'] ); ?></span>
						<?php
					}
					?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php if ( ! empty( $info_description ) ) { ?>
	<div class="qodef-m-description">
		<p class="qodef-m-description-text">
			<?php echo esc_html( $info_description ); ?>
			<?php einar_core_render_svg_icon( 'decoration-circle-big' ); ?>
		</p>
	</div>
	<?php } ?>
</div>
