<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/dual-image/class-einarcore-dual-image-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/dual-image/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
