<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/counter/class-einarcore-counter-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/counter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
