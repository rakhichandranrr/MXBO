<?php

include_once EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-on-hover/hover-animations/hover-animations.php';

foreach ( glob( EINAR_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-on-hover/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}
