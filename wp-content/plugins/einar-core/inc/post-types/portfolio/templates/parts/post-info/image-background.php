<?php if ( has_post_thumbnail() ) : ?>
    <div class="qodef-img-holder">
        <div class="qodef-img-wrapper">
			<?php the_post_thumbnail( 'full' ); ?>
        </div>
        <div class="qodef-title-image-holder">
            <?php einar_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/title' ); ?>
        </div>
    </div>
<?php endif; ?>