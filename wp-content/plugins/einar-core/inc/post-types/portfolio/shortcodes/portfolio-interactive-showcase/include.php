<?php

include_once EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-interactive-showcase/helper.php';
include_once EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-interactive-showcase/class-einarcore-portfolio-interactive-showcase-shortcode.php';

foreach ( glob( EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-interactive-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
