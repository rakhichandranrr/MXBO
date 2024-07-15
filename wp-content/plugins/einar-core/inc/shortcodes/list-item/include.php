<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/list-item/class-einarcore-list-item-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/list-item/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
