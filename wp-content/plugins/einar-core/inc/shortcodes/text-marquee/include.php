<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/text-marquee/class-einarcore-text-marquee-shortcode.php';

foreach ( glob( EINAR_CORE_INC_PATH . '/shortcodes/text-marquee/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
