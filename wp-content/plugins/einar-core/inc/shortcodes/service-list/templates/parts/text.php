<?php if ( ! empty( $text_1 ) || ! empty( $text_2 ) ) { ?>
    <div class="qodef-e-text-holder">
        <?php if ( ! empty( $text_1 ) ) : ?>
            <span class="qodef-e-text-one">
                <?php echo esc_html( $text_1 ); ?>
            </span>
        <?php endif; ?>
        <?php if ( ! empty( $text_2 ) ) : ?>
            <span class="qodef-e-text-two">
                <?php echo esc_html( $text_2 ); ?>
            </span>
        <?php endif; ?>
    </div>
<?php } ?>
