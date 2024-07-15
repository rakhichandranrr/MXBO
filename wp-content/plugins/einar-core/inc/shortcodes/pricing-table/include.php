<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/pricing-table/class-einarcore-pricing-table-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/pricing-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
