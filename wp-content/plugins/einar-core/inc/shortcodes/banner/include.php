<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/banner/class-einarcore-banner-shortcode.php';

foreach ( glob( EINAR_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
