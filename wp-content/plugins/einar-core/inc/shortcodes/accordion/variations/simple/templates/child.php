<<?php echo einar_core_escape_title_tag( $title_tag ); ?> class="qodef-accordion-title">
	<span class="qodef-tab-title"><?php echo esc_html( $title ); ?></span>
	<span class="qodef-accordion-mark">
		<span class="qodef-icon--plus">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="63" viewBox="0 0 13 13"><rect y="5" width="13" height="3"/><rect x="5" width="3" height="13"/></svg>
        </span>
		<span class="qodef-icon--minus">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="63" viewBox="0 0 13 3"><rect width="13" height="3"/></svg>
        </span>
	</span>
</<?php echo einar_core_escape_title_tag( $title_tag ); ?>>
<div class="qodef-accordion-content">
	<div class="qodef-accordion-content-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>
