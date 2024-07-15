<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/custom-font/class-einarcore-custom-font-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
