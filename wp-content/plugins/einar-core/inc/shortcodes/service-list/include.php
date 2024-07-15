<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/service-list/class-einarcore-service-list-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/service-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
