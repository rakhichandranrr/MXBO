<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/image-with-text/class-einarcore-image-with-text-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/image-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
