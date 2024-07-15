<?php

include_once EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/dual-image-portfolio-slider/helper.php';
include_once EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/dual-image-portfolio-slider/class-einarcore-dual-image-portfolio-slider-shortcode.php';

foreach ( glob( EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/dual-image-portfolio-slider/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
