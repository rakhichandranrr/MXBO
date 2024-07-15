<?php

include_once EINAR_CORE_SHORTCODES_PATH . '/button/class-einarcore-button-shortcode.php';

foreach ( glob( EINAR_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
