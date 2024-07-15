<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attrs( $data_attrs ); ?>>
	<span class="qodef-m-date">
        <div class="qode-m-countdown-weeks-holder">
            <div class="qodef-m-image">
                <?php echo wp_get_attachment_image( $week_image, 'full' ); ?>
            </div>
            <span class="qodef-digit-wrapper qodef-weeks">
                <span class="qodef-digit">00</span>
                <span class="qodef-label"><?php esc_html_e( 'Weeks', 'einar-core' ); ?></span>
		    </span>
        </div>

        <div class="qode-m-countdown-days-holder">
            <div class="qodef-m-image">
                <?php echo wp_get_attachment_image( $day_image, 'full' ); ?>
            </div>
            <span class="qodef-digit-wrapper qodef-days">
                <span class="qodef-digit">00</span>
                <span class="qodef-label"><?php esc_html_e( 'Days', 'einar-core' ); ?></span>
            </span>
        </div>

        <div class="qode-m-countdown-hours-holder">
             <div class="qodef-m-image">
                <?php echo wp_get_attachment_image( $hour_image, 'full' ); ?>
            </div>
            <span class="qodef-digit-wrapper qodef-hours">
                <span class="qodef-digit">00</span>
                <span class="qodef-label"><?php esc_html_e( 'Hours', 'einar-core' ); ?></span>
            </span>
        </div>

        <div class="qode-m-countdown-minutes-holder">
            <div class="qodef-m-image">
                <?php echo wp_get_attachment_image( $minute_image, 'full' ); ?>
            </div>
            <span class="qodef-digit-wrapper qodef-minutes">
                <span class="qodef-digit">00</span>
                <span class="qodef-label"><?php esc_html_e( 'Minutes', 'einar-core' ); ?></span>
            </span>
        </div>


        <div class="qode-m-countdown-seconds-holder">
            <div class="qodef-m-image">
                <?php echo wp_get_attachment_image( $second_image, 'full' ); ?>
            </div>
            <span class="qodef-digit-wrapper qodef-seconds">
                <span class="qodef-digit">00</span>
                <span class="qodef-label"><?php esc_html_e( 'Seconds', 'einar-core' ); ?></span>
            </span>
        </div>

	</span>
</div>
