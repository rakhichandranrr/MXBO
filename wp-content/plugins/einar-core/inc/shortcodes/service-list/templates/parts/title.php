<?php if ( ! empty( $item_title ) ) { ?>
	<h3 class="qodef-e-title" <?php qode_framework_inline_style( $title_styles ); ?>>
	    <?php if ( ! empty( $link ) ) { ?>
	        <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
		<?php } ?>
        <?php echo esc_html( $item_title ); ?>
		<?php if ( ! empty( $link ) ) { ?>
			</a>
	    <?php } ?>
	</h3>
<?php } ?>
