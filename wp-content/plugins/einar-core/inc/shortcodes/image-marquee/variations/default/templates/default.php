<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-content qodef--desktop" <?php qode_framework_inline_style( $content_styles ); ?>>
		<div class="qodef-m-image qodef-image--original" <?php qode_framework_inline_style( $image_styles ); ?>>
			<?php foreach ( $items as $item ) { ?>
				<?php
				if ( ! empty( $item['item_image_link'] ) ) :
					?>
					<a itemprop="url" href="<?php echo esc_url( $item['item_image_link'] ); ?>" target="<?php echo esc_attr( $item['item_image_link_target'] ); ?>">
				<?php endif; ?>
						<?php echo wp_get_attachment_image( $item['item_image'], 'full' ); ?>
				<?php
				if ( ! empty( $item['item_image_link'] ) ) :
					?>
					</a>
				<?php endif; ?>
			<?php } ?>
		</div>
		<div class="qodef-m-image qodef-image--copy" <?php qode_framework_inline_style( $copy_image_styles ); ?>>
			<?php foreach ( $items as $item ) { ?>
				<?php
				if ( ! empty( $item['item_image_link'] ) ) :
					?>
					<a itemprop="url" href="<?php echo esc_url( $item['item_image_link'] ); ?>" target="<?php echo esc_attr( $item['item_image_link_target'] ); ?>">
				<?php endif; ?>
						<?php echo wp_get_attachment_image( $item['item_image'], 'full' ); ?>
				<?php
				if ( ! empty( $item['item_image_link'] ) ) :
					?>
					</a>
				<?php endif; ?>
			<?php } ?>
		</div>
	</div>
	<div class="qodef-m-content qodef--mobile" <?php qode_framework_inline_style( $mobile_content_styles ); ?>>
		<div class="qodef-m-image qodef-image--original" <?php qode_framework_inline_style( $mobile_image_styles ); ?>>
			<?php foreach ( $items as $item ) { ?>
				<?php
				if ( ! empty( $item['item_image_link'] ) ) :
					?>
					<a itemprop="url" href="<?php echo esc_url( $item['item_image_link'] ); ?>" target="<?php echo esc_attr( $item['item_image_link_target'] ); ?>">
				<?php endif; ?>
						<?php echo wp_get_attachment_image( $item['item_image'], 'full' ); ?>
				<?php
				if ( ! empty( $item['item_image_link'] ) ) :
					?>
					</a>
				<?php endif; ?>
			<?php } ?>
		</div>
		<div class="qodef-m-image qodef-image--copy" <?php qode_framework_inline_style( $mobile_copy_image_styles ); ?>>
			<?php foreach ( $items as $item ) { ?>
				<?php
				if ( ! empty( $item['item_image_link'] ) ) :
					?>
					<a itemprop="url" href="<?php echo esc_url( $item['item_image_link'] ); ?>" target="<?php echo esc_attr( $item['item_image_link_target'] ); ?>">
				<?php endif; ?>
						<?php echo wp_get_attachment_image( $item['item_image'], 'full' ); ?>
				<?php
				if ( ! empty( $item['item_image_link'] ) ) :
					?>
					</a>
				<?php endif; ?>
			<?php } ?>
		</div>
	</div>
</div>
