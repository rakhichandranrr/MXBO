<?php

include_once EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/unequal/hover-animations/hover-animations.php';

foreach ( glob( EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/unequal/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}
