<?php if ( ! empty( $link ) ) { ?>
    <div class="qodef-e-button">
        <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
            <?php einar_core_render_svg_icon( 'arrow-right' ); ?>
        </a>
    </div>
<?php } ?>
