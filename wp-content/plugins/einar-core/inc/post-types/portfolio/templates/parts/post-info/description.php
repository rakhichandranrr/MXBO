<?php
$portfolio_description = get_post_meta( get_the_ID(), 'qodef_portfolio_description', true );

if ( ! empty( $portfolio_description ) ) {
    ?>
    <span class="qodef-portfolio-description">
        <?php
        echo esc_html($portfolio_description);
        ?>
    </span>
<?php } ?>
