<?php

include_once EINAR_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/class-einarcore-testimonials-list-shortcode.php';

foreach ( glob( EINAR_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
