<div class="qodef-e-tags-holder">
    <?php
    $tags = get_the_tags();

    if ( $tags ) {
        the_tags( '', ' ' ); ?>
    <?php } ?>
</div>
