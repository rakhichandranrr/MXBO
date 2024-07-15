<?php if ( ! empty( $price ) ) { ?>
	<div class="qodef-m-price">
		<div class="qodef-m-price-wrapper" <?php qode_framework_inline_style( $price_styles ); ?>>
			<h4 class="qodef-m-price-value"><?php echo esc_html( $price ); ?></h4>
			<?php if ( ! empty( $currency ) ) { ?>
				<h4 class="qodef-m-price-currency" <?php qode_framework_inline_style( $currency_styles ); ?>><?php echo esc_html( $currency ); ?></h4>
			<?php } ?>
		</div>
	</div>
<?php } ?>
