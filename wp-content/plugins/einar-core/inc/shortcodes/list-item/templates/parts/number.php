<?php if ( ! empty( $number ) ) { ?>
    <div class="qodef-m-number-wrapper">
        <span class="qodef-m-number" <?php qode_framework_inline_style( $number_styles ); ?> <?php echo esc_attr( $animation_data ); ?>><?php echo esc_html( $number ); ?></span>
    </div>
<?php } ?>
