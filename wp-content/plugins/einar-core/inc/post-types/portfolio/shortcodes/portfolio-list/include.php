<?php

include_once EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/helper.php';
include_once EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/class-einarcore-portfolio-list-shortcode.php';

foreach ( glob( EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
