<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/tabs/class-einarcore-tab-shortcode.php';
include_once EINAR_CORE_SHORTCODES_PATH . '/tabs/class-einarcore-tab-child-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/tabs/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
