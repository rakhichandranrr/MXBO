<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/icon-with-text/class-einarcore-icon-with-text-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/icon-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
