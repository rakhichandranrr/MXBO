<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/accordion/class-einarcore-accordion-shortcode.php';
include_once EINAR_CORE_SHORTCODES_PATH . '/accordion/class-einarcore-accordion-child-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/accordion/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
