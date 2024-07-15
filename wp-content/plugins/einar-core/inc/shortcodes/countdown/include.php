<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/countdown/class-einarcore-countdown-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/countdown/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
