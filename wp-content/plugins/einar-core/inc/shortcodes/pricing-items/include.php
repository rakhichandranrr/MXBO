<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/pricing-items/class-einarcore-pricing-items-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/pricing-items/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
