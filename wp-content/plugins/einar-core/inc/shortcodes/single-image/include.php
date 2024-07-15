<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/single-image/class-einarcore-single-image-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/single-image/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
